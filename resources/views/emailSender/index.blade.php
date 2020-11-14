@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Email Sender</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="/emailSender/send" role="form">

  <div class="row">
    <div class="col-sm-6">

            
      <div class="form-group">
        <label>Sending type</label>
        <select class="form-control" name="type" id="type">

          <option value=""></option>
          @foreach ($sendingOptions as $key=>$val)
              
          <option value="{{$key}}">{{$val}}</option>
          @endforeach

        </select>
      </div>


      <div class="form-group">
        <label>To</label>
        <input name="to" type="text" class="form-control" placeholder="someone@gmail.com">
      </div>
      
      <div class="form-group">
        <label>Subject</label>
        <input name="subject" type="text" class="form-control" placeholder="Subject of mail">
      </div>
      
      <div class="form-group">
        <label>Textarea</label>
        <textarea class="form-control" name="text" rows="3" placeholder="Interesting stuff ">BTW ... Tedo is your guy !!</textarea>
      </div>
      <button class="btn btn-primary">Send </button>
    </div>
    @csrf

  </div>
</form>
@stop