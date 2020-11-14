@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create Article</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index')}}">Articles</a></li>
                        <li class="breadcrumb-item active">Edit Article</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('articles.update', $article->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="article-title">Title</label>
                    <input type="text" class="form-control" id="article-title" name="article_title" placeholder="Please Enter title" value="{{ $article->title ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="article-content"></label>
                    <textarea class="textarea form-control" name="article_content" placeholder="Place some text here" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $article->text ?? ''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="article-featured-image">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="article-featured-image" name="article_featured_image">
                            <label class="custom-file-label" for="article-featured-image">{{ $article->url ?? 'Choose file'}}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary float-right mr-4">Submit</button>
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
        // Summernote
        $('.textarea').summernote()
        // File input
        bsCustomFileInput.init();
    })
</script>
@endsection