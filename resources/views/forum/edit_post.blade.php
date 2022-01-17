@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach ($post as $p)   
            <form action="/forum/post/update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                    <input type="hidden" name="post_id" value="{{ $p->post_id }}">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" name="post_title" value="{{ $p->post_title }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="post_desc" rows="3">{{ $p->post_desc }}</textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Change Image</label>
                    <small>(not required)</small>
                    <input class="form-control" type="file" name="post_img">
                  </div>
                  <input type="hidden" name="post_img_default" value="{{ $p->post_img }}">
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            @endforeach
        </div>
    </div>
@endsection