<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id_pesanan,
            'message' => 'A new order has been placed by ' . $this->order->pembeli->nama,
            'total' => $this->order->total_harga,
            'pembeli_image' => $this->order->pembeli->foto_profil ? asset('storage/foto_profil/' . $this->order->pembeli->foto_profil) : asset('img/default-user.png'),
        ];
    }
}
