@extends('templates.adTemplate')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Stars</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hotels as $hotel)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$hotel['name']}}</td>
                <td class="row">
                    @for($i = 0; $i < $hotel['star']; $i++)★@endfor
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
