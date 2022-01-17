@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <form action="/forum/post/add" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" name="post_title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="post_desc" rows="3" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Select Image</label>
                    <small>(not required)</small>
                    <input class="form-control" type="file" name="post_img">
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
@endsection