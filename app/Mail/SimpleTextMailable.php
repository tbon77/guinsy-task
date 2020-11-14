<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Swift_Transport;

class SimpleTextMailable extends CustomTransportMailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Swift_Transport $transport, $subject, $text)
  {
    parent::__construct($transport);
    $this->text = $text;
    $this->subject = $subject;
  }


  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject($this->subject)->view('mails.simple', ['text' => $this->text]);
  }
}
