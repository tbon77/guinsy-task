<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Swift_Mailer;
use Swift_Transport;

class CustomTransportMailable extends Mailable
{
  public $transport;
  public function __construct(Swift_Transport $transport)
  {
    $this->transport = $transport;
    $this->swapMailServiceTransport();
  }
  private function swapMailServiceTransport()
  {
    $swiftMailer = new Swift_Mailer($this->transport);
    Mail::setSwiftMailer($swiftMailer);
  }
}
