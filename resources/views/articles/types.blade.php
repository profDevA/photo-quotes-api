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
                        <h1 class="m-0 text-dark">ArticleType Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">ArticleType</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline float-right" method="POST" action="{{route('articleTypes.store')}}">
                            @csrf
                            <input type="text" name="name" id="" class="form-control" required>
                            <button class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="articleTypeTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articleTypes as $key=>$type)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <a href="{{ route('articleTypes.edit', $type->id) }}"
                                           class="edit-article fa fa-edit"></a>
                                        <form action="{{ route('articleTypes.destroy', $type->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure to delete this article?');"
                                              style="display: inline-block;">
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
            </div><!-- /.container-fluid -->
        </section><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#articleTypeTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>

@endsection
