<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupportDetail extends Model
{
    use HasFactory;
    protected $table = 'customer_support_detail';
    protected $fillable = [
        'ticket_id',
        'ticket_reply',
        'ticket_reply_attachment',
        'ticket_reply_by',
        'ticket_reply_date',
        'ticket_auto_reply_ai',
        'mark_as_spam',
    ];

    public function ticket()
    {
        return $this->belongsTo(CustomerSupport::class, 'ticket_id', 'id');
    }

    public function getdetail($ticket_id)
    {
        return $this->where('customer_support_detail.ticket_id', $ticket_id)
        ->join('customer_supports', 'customer_support_detail.ticket_id', '=', 'customer_supports.ticket_id')
        ->join('users', 'customer_supports.user_id', '=', 'users.id')
        ->select('customer_support_detail.*', 'users.full_name', 'customer_supports.*')
        ->get();
    }
    public function addmessage($ticket_id, $ticket_reply, $ticket_reply_attachment, $ticket_reply_by)
    {
        return $this->insert([
            'ticket_id' => $ticket_id,
            'ticket_reply' => $ticket_reply,
            'ticket_reply_attachment' => $ticket_reply_attachment,
            'ticket_reply_by' => $ticket_reply_by,
            'ticket_reply_date' => now(),
        ]);
    }
    public function addmessageAI($ticket_id, $ticket_reply, $ticket_reply_attachment, $ticket_reply_by)
    {
        return $this->insert([
            'ticket_id' => $ticket_id,
            'ticket_reply' => $ticket_reply,
            'ticket_reply_attachment' => $ticket_reply_attachment,
            'ticket_reply_by' => $ticket_reply_by,
            'ticket_reply_date' => now(),
        ]);
    }
}
