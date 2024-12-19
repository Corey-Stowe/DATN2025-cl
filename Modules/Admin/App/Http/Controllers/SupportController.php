<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomerSupport;
use App\Models\CustomerSupportDetail;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ResponeTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $listTicket = new CustomerSupport();
         $listTicket = $listTicket->listTicket();
         $countOpen = $listTicket->where('ticket_status', 1)->count();
         $countClose = $listTicket->where('ticket_status', 2)->count();
        $countSpam = $listTicket->where('ticket_status', 3)->count();
       // dd($listTicket);
         return view('admin::ticket.list', compact('listTicket', 'countOpen', 'countClose', 'countSpam'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listuser = new User();
        $listuser = $listuser->listUser();
        return view('admin::ticket.new', compact('listuser'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //validate
        $request->validate([
            'ma_kh' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);
        $user_id = $request->ma_kh;
        $ticket_title = $request->title;
        $ticket_content = $request->content;
        $ticket_category = $request->category;
        $ticket_ai_analyze = NULL;
        $ticket_attachment = NULL;
        $ticket_reply = "Tạo vé trợ giúp thành công vui lòng chờ khách hàng phản hồi";
        $ticket_reply_by = "ai";

        $ticket = new CustomerSupport();
           $ticket->addsystemticket($user_id, $ticket_title, $ticket_content, $ticket_category, $ticket_ai_analyze, $ticket_attachment);
           if($ticket){
            //get ticket_id
            $ticket_id = $ticket->getlastticetid()->ticket_id;

           // add message
            try{
                $detailticket = new CustomerSupportDetail();
                $detailticket->addmessage($ticket_id, $ticket_reply, $ticket_attachment, $ticket_reply_by);
                return redirect()->route('admin.ticket.index')->with('success', 'Tạo vé trợ giúp thành công');
            } catch (\Exception $e) {
               print_r($e->getMessage());
           }

        } else {
            return redirect()->back()->with('error', 'Tạo vé trợ giúp thất bại');
        }
}

    /**
     * Show the specified resource.
     */
    public function show($id,$user_id)
    {
       if($id){
        $detailticket = new CustomerSupportDetail();
        $detailticket = $detailticket->getdetail($id);
        $account = new User();
        $account = $account->getUser($user_id);
        //dd($account);
        $order = new Order();
        $order = $order->getlast5Orders($user_id);
        return view('admin::ticket.chat', compact('detailticket', 'account', 'order'));
       }
    }
    public function showOpen(){
        $listTicket = new CustomerSupport();
        $listTicket = $listTicket->listOpenTicket();
        $countOpen = $listTicket->where('ticket_status', 1)->count();
        $countClose = $listTicket->where('ticket_status', 2)->count();
       $countSpam = $listTicket->where('ticket_status', 3)->count();
        return view('admin::ticket.list', compact('listTicket', 'countOpen', 'countClose', 'countSpam'));
    }
    public function showSpam(){
        $listTicket = new CustomerSupport();
        $listTicket = $listTicket->listSpamTicket();
        $countOpen = $listTicket->where('ticket_status', 1)->count();
        $countClose = $listTicket->where('ticket_status', 2)->count();
       $countSpam = $listTicket->where('ticket_status', 3)->count();
        return view('admin::ticket.list', compact('listTicket', 'countOpen', 'countClose', 'countSpam'));
    }
    public function showClose(){
        $listTicket = new CustomerSupport();
        $listTicket = $listTicket->listCloseTicket();
        $countOpen = $listTicket->where('ticket_status', 1)->count();
        $countClose = $listTicket->where('ticket_status', 2)->count();
       $countSpam = $listTicket->where('ticket_status', 3)->count();
        return view('admin::ticket.list', compact('listTicket', 'countOpen', 'countClose', 'countSpam'));
    }

    public function updatemessage(Request $request){
        $ticket_attachment = NULL;
        $ticket_reply = $request->response;
        $ticket_reply_by = $request->reply_by;
        $ticket_id = $request->ticket_id;
        $ticket = new CustomerSupportDetail();
        $ticket = $ticket->addmessage($ticket_id, $ticket_reply, $ticket_attachment, $ticket_reply_by);
        if($ticket){
            if(isset($request->notify)){
                $user = User::find($request->user_id);
                $data = [
                    'full_name' => $user->full_name,
                    'message' =>  $ticket_reply,
                    'ticket_id' =>$ticket_id
                ];
                $user->notify(new ResponeTicket($data));
            }
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Gửi phản hồi thất bại');
        }
    }
    public function setComplete($id){
      if($id){
        $ticket = new CustomerSupport();
        $ticket = $ticket->setClosedticket($id);
        if($ticket){
            return redirect()->back()->with('success', 'Đóng vé trợ giúp thành công');
        } else {
            return redirect()->back()->with('error', 'Đóng vé trợ giúp thất bại');
        }
      }
    }
    public function setSpam($id){
        if($id){
            $ticket = new CustomerSupport();
            $ticket = $ticket->setSpamticket($id);
            if($ticket){
                return redirect()->back()->with('success', 'Đánh dấu vé trợ giúp là spam thành công');
            } else {
                return redirect()->back()->with('error', 'Đánh dấu vé trợ giúp là spam thất bại');
            }
        }

    }

    public function getlastticket(){
        $ticket = new CustomerSupport();
        $ticket = $ticket->getlastticetid();
        return response()->json($ticket);
    }
    public function seachcustomer(Request $request){
        $search = $request->keyword;
        $listuser = new User();
        $listuser = $listuser->searchUser($search);
        return response()->json($listuser);
    }
    public function userdetail($id){
        $account = new User();
        $account = $account->getUser($id);
        return response()->json($account);
    }

    public function search(Request $request){
        $search = $request->search;
        $listTicket = new CustomerSupport();
         $listTicket = $listTicket->searchTicket($search);
         //dd($listTicket);
        $countOpen = $listTicket->where('ticket_status', 1)->count();
        $countClose = $listTicket->where('ticket_status', 2)->count();
        $countSpam = $listTicket->where('ticket_status', 3)->count();
        return view('admin::ticket.list', compact('listTicket', 'countOpen', 'countClose', 'countSpam'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
