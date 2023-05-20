<div class="form-group">
    {!! Form::label('title', 'Product Name') !!}
    {!! Form::text('title', null, ["class" => 'form-control']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('price', 'Price') !!}
    {!! Form::text('price', null, ["class" => 'form-control']) !!}
</div>

<div class="form-group mt-3">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id',$categories, null, ["class" => 'form-control']) !!}
</div>

<div class="form-group mt-3">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ["class" => 'form-control']) !!}
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

</div>

<div class="form-group mt-3">
    {!! Form::label('tags', 'Tags') !!}
    {!! Form::select('tags[]', $tags, null, ["class" => 'form-control', 'multiple'=>"multiple", 'id' => 'tags']) !!}
</div>

{{--<div class="form-group mt-3">--}}
{{--    {!! Form::label('image', 'Image') !!}--}}
{{--    {!! Form::file('image', ["class" => 'form-control']) !!}--}}
{{--</div>--}}

<div class="input-group mt-3">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o"></i> Choose
     </a>
   </span>
    {!! Form::text('image', null, ["class" => 'form-control', 'id'=>"thumbnail"]) !!}
</div>
<div id="holder" style="margin-top:15px;max-height:100px;">
    @isset($product)
        <img src="{{asset($product->image)}}" style="width: 100px" alt="">
    @endisset
</div>

<button class="btn btn-primary mt-3">Save</button>

<script>
    var lfm = function (id, type, options) {
        let button = document.getElementById(id);

        button.addEventListener('click', function () {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            var target_input = document.getElementById(button.getAttribute('data-input'));
            var target_preview = document.getElementById(button.getAttribute('data-preview'));

            window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');

                // set the value of the desired input to image url
                target_input.value = file_path;
                target_input.dispatchEvent(new Event('change'));

                // clear previous preview
                target_preview.innerHTML = '';

                // set or change the preview image src
                items.forEach(function (item) {
                    let img = document.createElement('img')
                    img.setAttribute('style', 'height: 5rem')
                    img.setAttribute('src', item.thumb_url)
                    target_preview.appendChild(img);
                });

                // trigger change event
                target_preview.dispatchEvent(new Event('change'));
            };
        });
    };
    var route_prefix = "/laravel-filemanager";
    lfm('lfm', 'image', {prefix: route_prefix});
</script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('description', options);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tags').select2();
    });
</script>
