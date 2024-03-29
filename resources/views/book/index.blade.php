@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Books Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Books</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col">
                    <a href="{{route('books.create')}}" class="create-article__link btn btn-primary float-right">New Book</a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <table id="booktable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>ISBN</th>
                                <th>PubDate</th>
                                <th>Author</th>
                                <th>Source</th>
                                <th>Category</th>
                                <th>Visible</th>
                                <th>Visible Comments</th>
                                <th>Hidden Comments</th>
                                <th>Amazon Url</th>
                                <th>Book Image</th>
                                <th>Book Store Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $key=>$book)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    <p>{{$book->title}}</p>
                                </td>
                                <td>{{$book->isbn}}</td>
                                <td>{{$book->pubDate}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->source->firstName ?? ''}} {{$book->source->middleName ?? ''}} {{$book->source->lastName ?? ''}}</td>
                                <td>{{$book->category->name ?? ''}}</td>
                                <td>{{$book->visible == 1 ? "Yes" : "No"}}</td>
                                <td>
                                    <p>{{$book->visibleComments}}</p>
                                </td>
                                <td>
                                    <p>{{$book->hiddenComments}}</p>
                                </td>
                                <td>{{$book->amazonUrl}}</td>
                                <td>
                                    <a href="/uploads/{{$book->bookImage}}" data-fancybox data-caption="{{$book->title}}">
                                        <img src="/uploads/{{$book->bookImage}}" style="width: 70px;">
                                    </a>
                                </td>
                                <td>{{$book->bookStoreName}}</td>

                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="edit-article fa fa-edit"></a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="delete-article fa fa-trash-alt"></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#booktable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })
</script>

@endsection