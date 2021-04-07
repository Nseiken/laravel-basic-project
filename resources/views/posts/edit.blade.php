@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit article</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="content">Content*</label>
                            <textarea name="body" rows="6" class="form-control">{!! $post->body !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="iframe">Embedded Content*</label>
                            <textarea name="iframe" class="form-control">{!! $post->iframe !!}</textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            @method('PUT')
                            <input type="submit" value="Update" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
