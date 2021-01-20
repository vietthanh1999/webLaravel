@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif

            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
                <form action="" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <h3>ADD BLOG</h3>
                    <div class="form-group">
                        <label>Tilte</label>
                        <input type="text" class="form-control" name="title" placeholder="placeholder">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" placeholder="placeholder">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" placeholder="placeholder">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" placeholder="placeholder" id="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
    </script>
</div>
@endsection

