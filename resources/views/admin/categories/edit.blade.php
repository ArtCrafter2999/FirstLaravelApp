@extends('templates.mainTemplate')

@section('content')
    <h1>Create Category</h1>

    @include('templates.formError')

    <form action="/admin/categories/{{$category->id}}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label>
                Name:
                <input type="text" name="name" class="form-control" value="{{$category->name}}"/>
            </label>
        </div>
        <div class="form-group mt-3">
            <label>
                Description:
                <textarea name="description" class="form-control">{{$category->description}}</textarea>
            </label>
        </div>

        <button class="btn btn-primary mt-3">Save</button>
    </form>
@endsection
