@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Photo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('photos.index')}}">Photos</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('photos.update', $photo->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="photo_source">Source</label>
                    <select name="sourceId" id="photo_source" class="form-control" required>
                    <option value="">Select Source</option>
                        @foreach($sources as $key=>$source)
                        <option value="{{$source->id}}" {!! isset($photo->source) && $photo->source->id == $source->id ? 'selected' : '' !!}>{{ ($source->firstName ? $source->firstName.'_' : '') . ($source->middleName ? $source->middleName.'_' : '') . ($source->lastName ? $source->lastName : '')}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="photo">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="article-featured-image">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="photo_title">Title</label>
                    <input type="text" name="title" id="photo_title" class="form-control" placeholder="Photo title" value="{{ $photo->title }}">
                </div>

                <div class="form-group">
                    <label for="photo_description">Description</label>
                    <input type="text" name="description" id="photo_description" class="form-control" placeholder="Alt description" value="{{ $photo->description }}">
                </div>

                <div class="form-group">
                    <label for="photo_added_by_user">Added User</label>
                    <input type="text" name="addedByUser" id="photo_added_by_user" class="form-control" placeholder="Added User" value="{{ $photo->addedByUser }}">
                </div>

                <div class="form-group">
                    <label for="photo_comments">Comments</label>
                    <textarea name="comment" id="photo_comments" rows="4" class="form-control" value="{{ $photo->comment }}"></textarea>
                </div>

                <div class="form-group">
                    <label>Visible</label>
                    <div class="form-check">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="visible" value="1" {!! $photo->visible == '1' ? 'checked' : '' !!}>Visible
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="visible" value="0" {!! $photo->visible == '0' ? 'checked' : '' !!}>Hidden
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </div>

            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    })
</script>
@endsection