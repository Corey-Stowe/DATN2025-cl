<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Checkout extends Notification
{
    use Queueable;

    protected $order;
    protected $orderItems;

    /**
     * Create a new notification instance.
     */
    public function __construct($order, $orderItems)
    {
        $this->order = $order;
        $this->orderItems = $orderItems;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $orderItemsArray = [];

        foreach ($this->orderItems as $item) {
            $orderItemsArray[] = [
                'name' => $item->productVariant->product->name,
                'image' => $item->productVariant->product->image_avatar,
                'size' => $item->productVariant->size->size_value,
                'color' => $item->productVariant->color->color_value,
                'quantity' => $item->product_quantity,
                'price' => $item->product_price_final,
            ];
        }

        return (new MailMessage)
            ->subject('Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi - mã đơn hàng #' . $this->order->id)
            ->view('client::emails.order', [
                'order' => $this->order,
                'orderItems' => $orderItemsArray,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'status_order' => $this->order->status_order,
            'status_payment' => $this->order->status_payment,
        ];
    }
}
