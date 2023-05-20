@extends('templates.mainTemplate')

@section('content')
    <h1>Create Product</h1>

    @include('templates.formError')

    {!! Form::model($product, ['url' => 'admin/products/'.$product->id, 'method' => 'PUT', 'files' => true]) !!}
        @include('admin.products._form')
    {!! Form::close() !!}
@endsection
