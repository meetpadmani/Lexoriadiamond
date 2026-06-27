<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class WishlistReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $wishlistItems;

    public function __construct(User $user, Collection $wishlistItems)
    {
        $this->user = $user;
        $this->wishlistItems = $wishlistItems;
    }

    public function build()
    {
        return $this->subject('Still thinking about these? | Bhaumik Diamonds Wishlist')
                    ->view('emails.wishlist_reminder');
    }
}
