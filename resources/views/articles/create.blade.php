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
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('articles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="article-title">Title</label>
                    <input type="text" class="form-control" id="article-title" name="article_title" placeholder="Please Enter title" required>
                </div>
                <div class="form-group">
                    <label for="article_content">Text</label>
                    <textarea class="textarea form-control" name="article_content" id="article_content" placeholder="Place some text here" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                </div>

                <div class="form-group">
                    <label for="article_visible_comments">Visible Comments</label>
                    <textarea class="textarea form-control" name="visible_comments" id="article_visible_comments" placeholder="Place visible coments here" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="article_hidden_comments">Hidden Comments</label>
                    <textarea class="textarea form-control" name="hidden_comments" id="article_hidden_comments" placeholder="Place hidden comments here" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="article_url">Url</label>
                    <input type="text" class="form-control" id="article_url" name="url" placeholder="Article Url">
                </div>
                <div class="form-group">
                    <label for="article_author">Author</label>
                    <input type="text" class="form-control" id="article_author" name="author" placeholder="Author">
                </div>
                <div class="form-group">
                    <label>Source</label>
                    <div class="input-group">
                        <select name="source_id" id="" class="form-control">
                            <option value="">Select Source</option>
                            @foreach($sources as $key => $source)
                            <option value="{{ $source->id }}">{{ ($source->firstName ? $source->firstName.'_' : '') . ($source->middleName ? $source->middleName.'_' : '') . ($source->lastName ? $source->lastName : '')}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <div class="input-group">
                        <select name="category_id" id="" class="form-control">
                            @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Article Type</label>
                    <div class="input-group">
                        <select name="article_type" id="" class="form-control">
                            <option>Blog</option>
                            <option>Article</option>
                            <option>Interview</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Visible</label>
                    <div class="form-check">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="visible" value="1" checked>Visible
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="visible" value="0">Hidden
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="article-featured-image">Featured Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="article-featured-image" name="article_featured_image" required>
                            <label class="custom-file-label" for="article-featured-image">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title">
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description">
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
<script src="{{asset('plugins/summernote-image-attribute/summernote-image-attributes.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#article_content').summernote({
            popover: {
                image: [
                    ['custom', ['imageAttributes']],
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
            },
            lang: 'en-US', // Change to your chosen language
            imageAttributes: {
                icon: '<i class="note-icon-pencil"/>',
                removeEmpty: true, // true = remove attributes | false = leave empty if present
                disableUpload: true // true = don't display Upload Options | Display Upload Options
            }
        })
        // File input
        bsCustomFileInput.init();
    })
</script>
@endsection