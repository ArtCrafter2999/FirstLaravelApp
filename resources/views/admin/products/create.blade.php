@extends('templates.mainTemplate')

@section('content')
    <h1>Create Product</h1>

    @include('templates.formError')

    {!! Form::open(['url' => 'admin/products', 'files' => true]) !!}
        @include('admin.products._form')
    {!! Form::close() !!}
@endsection
