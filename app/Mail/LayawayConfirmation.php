<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LayawayConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    
    private $performer = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($performer)
    {
        $this->performer = $performer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@example.com', 'カレンダーアプリ！')
        ->subject('取り置きの確認')
        ->view('emails.layaway.confirmation')
        ->with('performer', $this->performer);
    }
}
