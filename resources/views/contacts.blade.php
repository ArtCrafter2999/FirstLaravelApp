@extends('templates.mainTemplate')

@section('content')

  @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
  @endif



  @include('templates.formError')

  <form action="/send-email" method="post">

    @csrf

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
      @error('name')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group mt-3">
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
      @error('email')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>

    <div class="form-group mt-3">
      <label for="message">Message:</label>
      <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror">{{old('message')}}</textarea>
      @error('message')
      <div class="invalid-feedback">{{$message}}</div>
      @enderror
    </div>

    <button class="btn btn-primary mt-3">Send</button>
</form>

@endsection
