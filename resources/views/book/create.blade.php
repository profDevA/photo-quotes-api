@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Book</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('articles.index')}}">Books</a></li>
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
                <form action="{{ route('books.store')}}" method="post" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="book_title">Title</label>
                            <input type="text" class="form-control" id="book_title" name="title" placeholder="Title">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="book_isbn">ISBN</label>
                            <input type="text" class="form-control" id="book_isbn" name="isbn" placeholder="ISBN">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="book_author">Author</label>
                            <input type="text" class="form-control" id="book_author" name="author" placeholder="Author">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="book_pubDate">Publication date</label>
                            <input type="date" class="form-control" id="book_pubDate" name="pubDate" placeholder="Amazone Url">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="book_amazonUrl">Amazone Url</label>
                            <input type="text" class="form-control" id="book_amazonUrl" name="amazonUrl" placeholder="Amazone Url">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="book_source">Source</label>
                            <select name="source_id" id="book_source" class="form-control">
                                <option value="">Select Source</option>
                                @foreach($sources as $key=>$source)
                                    <option value="{{$source->id}}">{{ ($source->firstName ? $source->firstName.'_' : '') . ($source->middleName ? $source->middleName.'_' : '') . ($source->lastName ? $source->lastName : '')}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="book_category">Category</label>
                            <div class="input-group">
                                <select name="category_id" id="book_category" class="form-control">
                                    @foreach($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_visible_comment">Visible Comments</label>
                            <textarea name="visibleComments" id="book_visible_comment" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_hidden_comment">Hidden Comments</label>
                            <textarea name="hiddenComments" id="book_hidden_comment" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_image">Book Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="book_image" name="bookImage" required>
                                <label class="custom-file-label" for="article-featured-image">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_store_name">Store Name</label>
                            <input type="text" name="bookStoreName" id="book_store_name" class="form-control" placeholder="Store Name" >
                        </div>
                    </div>

                    <div class="col-md-12">
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
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
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
