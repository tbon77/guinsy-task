<?php

namespace App\Http\Controllers;

use App\Guinsy\EmailSender\EmailTransportManager;
use App\Mail\SimpleTextMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSenderController extends Controller
{
  public function index()
  {

    $sendingOptions = EmailTransportManager::getTypes();
    return view('emailSender.index', compact('sendingOptions'));
  }
  public function send(Request $request)
  {

    $this->validate($request, [
      'type' => 'required',
      'subject' => 'required',
      'text' => 'required',
      'to' => 'required|email'
    ]);
    $transportManager = new EmailTransportManager();
    $transport = $transportManager->createTransport(
      $request->get('type'),
      $request->get('params', false)
    );
    Mail::to($request->get('to'))->send(
      new SimpleTextMailable(
        $transport,
        $request->get('text'),
        $request->get('subject')
      )
    );
    return redirect('/');
  }
}
