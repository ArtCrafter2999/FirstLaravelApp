@extends('templates.mainTemplate')

@section('content')
    <h1>Create Category</h1>

    @include('templates.formError')

    <form action="/admin/categories" method="POST">
        @csrf
        <div class="form-group">
            <label>
                Name:
                <input type="text" name="name" class="form-control"/>
            </label>
        </div>
        <div class="form-group mt-3">
            <label>
                Description:
                <textarea name="description" class="form-control"></textarea>
            </label>
        </div>

        <button class="btn btn-primary mt-3">Save</button>
    </form>
@endsection
