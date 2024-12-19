<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;
    protected $table = 'customer_supports';
    protected $fillable = [
        'user_id',
        'ticket_title',
        'ticket_content',
        'ticket_status',
        'ticket_priority',
        'ticket_category',
        'ticket_attachment',
        'ticket_ai_analyze',
        'ticket_date',
    ];
    public function getlastticetid()
    {
        return $this->orderBy('ticket_id', 'desc')->first();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(CustomerSupportDetail::class, 'ticket_id', 'id');
    }

    public function listTicket()
    {
        return $this->join('users', 'customer_supports.user_id', '=', 'users.id')
            ->select('customer_supports.*', 'users.full_name')
            ->get();
    }
    public function addTicket($user_id, $ticket_title, $ticket_content, $ticket_category, $ticket_attachment)
    {
        return $this->insert([
            'user_id' => $user_id,
            'ticket_title' => $ticket_title,
            'ticket_content' => $ticket_content,
            'ticket_category' => $ticket_category,
            'ticket_attachment' => $ticket_attachment,
            'ticket_date' => now(),
        ]);
    }
    public function addsystemticket($user_id, $ticket_title, $ticket_content, $ticket_category, $ticket_ai_analyze, $ticket_attachment)
    {
        return $this->insert([
            'user_id' => $user_id,
            'ticket_title' => $ticket_title,
            'ticket_content' => $ticket_content,
            'ticket_category' => $ticket_category,
            'ticket_ai_analyze' => $ticket_ai_analyze,
            'ticket_attachment' => $ticket_attachment,
            'ticket_date' => now(),
        ]);
    }
    public function listOpenTicket()
    {
        return $this
            ->join('users', 'customer_supports.user_id', '=', 'users.id')
            ->where('ticket_status', 1)->get();
    }
    public function listCloseTicket()
    {
        return $this
            ->join('users', 'customer_supports.user_id', '=', 'users.id')
            ->where('ticket_status', 2)->get();
    }
    public function listSpamTicket()
    {
        return $this
            ->join('users', 'customer_supports.user_id', '=', 'users.id')
            ->where('ticket_status', 3)->get();
    }

    public function countOpenTicket()
    {
        return $this->where('ticket_status', 1)->count();
    }
    public function countCloseTicket()
    {
        return $this->where('ticket_status', 2)->count();
    }
    public function countSpamTicket()
    {
        return $this->where('ticket_status', 3)->count();
    }
    public function countToalTicket()
    {
        return $this->count();
    }
    public function setOpenticket($id)
    {
        return $this->where('ticket_id', $id)->update([
            'ticket_status' => 1,
        ]);
    }
    public function setClosedticket($id)
    {
        return $this->where('ticket_id', $id)->update([
            'ticket_status' => 2,
        ]);
    }
    public function setSpamticket($id)
    {
        return $this->where('ticket_id', $id)->update([
            'ticket_status' => 3,
        ]);
    }
    public function updateAiAnalyze($id, $ticket_ai_analyze)
    {
        return $this->where('ticket_id', $id)->update([
            'ticket_ai_analyze' => $ticket_ai_analyze,
        ]);
    }
    public function gethighPriority()
    {
        return $this->where('ticket_priority', 2)->get();
    }
    public function getlowPriority()
    {
        return $this->where('ticket_priority', 1)->get();
    }
    public function getticketByCategory($category)
    {
        return $this->where('ticket_category', $category)->get();
    }
    public function getticketByUser($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    }
    public function getticketdate($date)
    {
        return $this->where('ticket_date', $date)->get();
    }
    public function getticketByUserAndDate($user_id, $date)
    {
        return $this->where('user_id', $user_id)->where('ticket_date', $date)->get();
    }
    public function getticketByUserAndCategory($user_id, $category)
    {
        return $this->where('user_id', $user_id)->where('ticket_category', $category)->get();
    }
    public function getticketByUserAndPriority($user_id, $priority)
    {
        return $this->where('user_id', $user_id)->where('ticket_priority', $priority)->get();
    }
    public function getticketByUserAndStatus($user_id, $status)
    {
        return $this->where('user_id', $user_id)->where('ticket_status', $status)->get();
    }
    public function getticketByUserAndStatusAndPriority($user_id, $status, $priority)
    {
        return $this->where('user_id', $user_id)->where('ticket_status', $status)->where('ticket_priority', $priority)->get();
    }
    public function getTicketdatetoDate($from, $to)
    {
        return $this->whereBetween('ticket_date', [$from, $to])->get();
    }
    public function searchTicket($keyword)
    {
        return $this
            ->join('users', 'customer_supports.user_id', '=', 'users.id')
            ->where('ticket_id', 'like', '%' . $keyword . '%')
            ->orWhere('ticket_title', 'like', '%' . $keyword . '%')
            ->orWhere('ticket_content', 'like', '%' . $keyword . '%')
            ->orWhere('ticket_category', 'like', '%' . $keyword . '%')
            ->get();
    }
    public function getLastticket()
    {
        return $this->orderBy('ticket_id', 'desc')->first();
    }
}
