<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerSupport;
use App\Models\CustomerSupportDetail;
use App\Notifications\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addTicket(Request $request)
    {
        $ticket = new CustomerSupport();
        $attachment = $request->file("con_file");
        //validate
        $this->validate($request, [
            'con_name' => 'required',
            'con_email' => 'required',
            'con_subject' => 'required',
            'con_message' => 'required',
        ]);
        $ticket_reply = "Tạo vé trợ giúp thành công vui lòng chờ nhân viên phản hồi";
        $ticket_reply_by = "created by user";
        try {
            if ($attachment) {
                $filepath = $attachment->storeAs('tickets', $attachment->getClientOriginalName(), 'public'); // Store the file in the 'tickets' directory in the 'public' disk with the original name
            } else {
                $filepath = NULL;
            }
            $ticket->addTicket($request->con_user_id, $request->con_subject, $request->con_message,$request->status,$filepath);
            $ticket_id = $ticket->getlastticetid()->ticket_id;
            $detailticket = new CustomerSupportDetail();
            $detailticket->addmessage($ticket_id, $ticket_reply, $filepath, $ticket_reply_by);
            //ai api
            return redirect()->back()->with('success', 'Tạo vé trợ giúp thành công')->with('ticket_id', $ticket_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function aigenerate($id)
    {
        set_time_limit(300);
        if (empty($id)) {
            return response()->json(['message' => 'Ticket ID is required'], 400);
        }

        // Fetch ticket details
        $detailticket = (new CustomerSupportDetail())->getdetail($id);
        // dd($detailticket);
        if (empty($detailticket)) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
        $ticket_content = $detailticket->first()->ticket_content;
        $aicheck = $detailticket->first()->ticket_ai_analyze;
        $user_id = $detailticket->first()->user_id;
        // if(isset($aicheck)) {
        //     return response()->json(['message' => 'AI already generated'], 400);
        // } else {
            $curl = curl_init();

            // Prepare data for the request
            $data = [
                'model' => 'STOWE-LLMv1',
                 "messages" => [
                        [
                        "role" => "system",
                        "content" => "You are an expert in emotional analysis for customer support. Every time a conversation is sent to you, analyze it thoroughly and respond in the language of the conversation (Vietnamese for non-English text). Your analysis must include the following four sections:

Summary of the topic: Briefly summarize the main subject of the text.
In-depth analysis: Analyze the emotional tone, nuances, and underlying messages of the conversation.
Advice: Provide practical guidance or suggestions tailored to the emotional context.
Conclusion: Conclude with an overall emotional assessment and key takeaways.
Additionally, if a conversation lacks clarity, you must acknowledge this and provide an alternative analysis based on observable patterns (e.g., repetitive characters may indicate frustration). Always explicitly state the emotional elements (e.g., stress, happiness, sadness, dishonesty) present in the conversation. If only one specific section is requested, focus on that section."
                      ],
                        [
                        "role" => "user",
                        "content" => $ticket_content
                        ]
                    ]

            ];
            // Set cURL options
            curl_setopt($curl, CURLOPT_URL, 'http://172.25.250.88:1234/v1/chat/completions');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
            ]);

            // Execute cURL request
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $message = $response['choices'][0]['message']['content'];
           if(isset($message)) {
            $ticket = new CustomerSupport() ;
            $ticket->updateAiAnalyze($id, $message);
            $curl = curl_init();
            $user = User::find($user_id);
            // Prepare data for the request
            $data = [
                'model' => 'STOWE-LLMv1',
                 "messages" => [
                        [
                        "role" => "system",
                        "content" => "You are now a support representative for a clothing shop named PCV Fashion. Your main responsibility is to respond to customers, offer helpful advice, and notify them that their ticket has been submitted and is awaiting further resolution by a human agent. Instead of directing customers to email support, inform them politely to wait for a response from a staff member. Always respond in the same language the customer uses.

When interacting with customers, ensure your responses are polite, professional, and empathetic, making customers feel acknowledged as they await further support.

Shop details for reference:

Shop Name: PCV Fashion
Category: Clothing Shop
Website: https://datn2025.stoweteam.dev/
FAQ: https://datn2025.stoweteam.dev/faq
Terms of Service: https://datn2025.stoweteam.dev/faq/tos
Return Policy: https://datn2025.stoweteam.dev/faq/return
If a request is unrelated to the clothing shop or not within your scope of support, respond in the following format with no further explanation:
rejected due to spam or unrelated content

Remember, you are a support representative for a clothing shop only, and should handle only cases related to PCV Fashion."
                      ],
                        [
                        "role" => "user",
                        "content" => $ticket_content
                        ]
                    ]

            ];
            // Set cURL options
            curl_setopt($curl, CURLOPT_URL, 'http://172.25.250.88:1234/v1/chat/completions');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
            ]);

            // Execute cURL request
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $message_ai = $response['choices'][0]['message']['content'];
            $user = User::find($user_id);
            $data = [
                'full_name' => $user->full_name,
                'ai_message' => $message_ai,
                'ticket_id' => $id
            ];
            $ticket_detail = new CustomerSupportDetail() ;
            $ticket_reply = $message_ai;
            $ticket_reply_by = "ai";
            $ticket_detail->addmessage($id, $ticket_reply, NULL, $ticket_reply_by);
            $user->notify(new Ticket($data));

           }

        //}

    }
    public function chatshow($id)
    {
        $detailticket = new CustomerSupportDetail();
        $detailticket = $detailticket->getdetail($id);
        $account = new User();
        $account = $account->getUser($detailticket->first()->user_id);
        return view('client::contents.ticket.chat', compact('detailticket', 'account'));
    }
    public function sentchat(Request $request){
        $ticket_attachment = NULL;
        $ticket_reply = $request->response;
        $ticket_reply_by = $request->reply_by;
        $ticket_id = $request->ticket_id;
        $ticket = new CustomerSupportDetail();
        $ticket = $ticket->addmessage($ticket_id, $ticket_reply, $ticket_attachment, $ticket_reply_by);
        if($ticket){
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Gửi phản hồi thất bại');
        }
    }
    }

