<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class AbandonedCartReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cartItems;

    public function __construct(User $user, Collection $cartItems)
    {
        $this->user = $user;
        $this->cartItems = $cartItems;
    }

    public function build()
    {
        return $this->subject('You left something beautiful in your bag | Bhaumik Diamonds')
                    ->view('emails.abandoned_cart');
    }
}
