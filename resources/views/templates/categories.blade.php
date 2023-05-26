@include('templates._header')

<main class="py-4">
    <div class="row">
        <div class="col-2">
            <ul class="nav flex-column">
                @foreach($categoriesShare as $cat)
                    <li class="nav-item">
                        <a href="{{url('/category/'. $cat->slug)}}"
                           class="nav-link @if(isset($category) && $cat == $category)active @endif">{{$cat->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8">
            @yield('content')
        </div>
    </div>
</main>
@include('templates._footer')
