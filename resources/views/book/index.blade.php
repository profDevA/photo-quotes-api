@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->isbn}}</td>
                                    <td>{{$book->pubDate}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->source->lastName ?? ''}} {{$book->source->middleName ?? ''}} {{$book->source->firstName ?? ''}}</td>
                                    <td>{{$book->category->name ?? ''}}</td>
                                    <td>{{$book->visible == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$book->amazonUrl}}</td>
                                    <td>
                                        <img src="/uploads/{{$book->bookImage}}" alt="" style="width: 70px;">

                                    </td>
                                    <td>{{$book->bookStoreName}}</td>

                                    <td>
                                        <a class="view-article fa fa-eye" href="{{ route('books.show', $book->id) }}"></a>
                                        <a href="{{ route('articles.edit', $book->id) }}" class="edit-article fa fa-edit"></a>
                                        <form action="{{ route('articles.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
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
