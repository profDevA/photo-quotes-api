@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Article View</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index')}}">Articles</a></li>
                        <li class="breadcrumb-item active">Article View</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center mb-4 font-weight-bold">{{$article->title ?? ''}}</h2>

            <div class="article-content">
                <!-- <div class="featured-image">
                    <img src="{{asset('uploads/' . $article->url)}}" alt="">
                </div> -->
                {!!$article->text ?? ''!!}
            </div>
            <div class="buttons-group mb-5">
                <a href="{{ route('articles.edit', $article->id) }}" class="edit-article btn btn-primary mr-3">Edit Article</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="delete-article btn btn-danger">Delete Article</button>
                </form>
            </div>
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