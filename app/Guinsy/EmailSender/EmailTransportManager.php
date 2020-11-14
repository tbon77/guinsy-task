<?php

namespace App\Guinsy\EmailSender;

use Illuminate\Support\Facades\Mail;
use Swift_Transport;

class  EmailTransportManager //extends EmailSender
{

  const TYPE_PRESET_SMTP = 'smtp';
  const TYPE_PRESET_MAILGUN = 'mailgun';
  const TYPE_CUSTOM_SMTP = 'custom_smtp';
  const TYPE_CUSTOM_MAILGUN = 'custom_mailgun';



  public function createTransport($type, $params = false): Swift_Transport
  {

    $config = [];
    switch ($type) {
      case self::TYPE_PRESET_SMTP:
        $config = config('mail.mailers.smtp');
        break;
      case self::TYPE_CUSTOM_SMTP:
        // TODO:
        // some validation 
        $config = $params;
        break;
      case self::TYPE_PRESET_MAILGUN:
        $config = config('mail.mailers.mailgun');

        break;
      case self::TYPE_CUSTOM_MAILGUN:
        // TODO:
        // some validation 
        $config = $params;
        break;

        // TODO: ...
      default:
        // Custom excepiton here 
        throw new \Exception("invalid transport type", 1);
        break;
    }
    return Mail::createTransport($config);
  }

  public static function getTypes(): array
  {
    return [
      self::TYPE_PRESET_MAILGUN => 'Preset mailgun',
      self::TYPE_PRESET_SMTP => 'Preset sMTP',
      self::TYPE_CUSTOM_MAILGUN => 'Custom mailgun',
      self::TYPE_CUSTOM_SMTP => 'Custom SMTP'
      //,...
    ];
  }
}
