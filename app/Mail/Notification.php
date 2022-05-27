<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    public $filename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')
            ->subject('This is notification')
            ->attach($this->filename);

    }
}
