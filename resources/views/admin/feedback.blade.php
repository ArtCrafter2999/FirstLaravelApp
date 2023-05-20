@extends('templates.mainTemplate')

@section('content')
    <h1>Write feedback to us!</h1>

    @include('templates.formError')

    <form action="/feedback" method="POST">
        @csrf
        <div class="form-group">
            <label>
                From:
                <input type="text" name="from" class="form-control"/>
            </label>
        </div>
        <div class="form-group mt-3">
            <label>
                Rate:
                <input type="number" name="rate" class="form-control"/>
            </label>
        </div>
        <div class="form-group mt-3">
            <label>
                Comment:
                <textarea name="comment" class="form-control"></textarea>
            </label>
        </div>

        <button class="btn btn-primary mt-3">Send</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>From</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Rate</th>
        </tr>
        </thead>
        <tbody>
        @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$feedback->from}}</td>
                <td>{{$feedback->comment}}</td>
                <td>{{$feedback->created_at}}</td>
                <td class="row">
                    {{str_repeat("★", $feedback->rate)}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
