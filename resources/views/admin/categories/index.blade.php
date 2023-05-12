@extends('templates.mainTemplate')

@section('content')
    <h1 class="text-center">Categories</h1>
    <a href="/admin/categories/create" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td class="btn-group">
                    <form action="/admin/categories/{{$category->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-warning" href="/admin/categories/{{$category->id}}/edit">Edit</a>
                        <button class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
