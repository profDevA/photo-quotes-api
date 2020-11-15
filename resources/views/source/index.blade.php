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
                        <h1 class="m-0 text-dark">Source Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Source</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div>

        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{route('sources.create')}}" class="create-article__link btn btn-primary float-right">New
                            Source</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="sourceTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Source Name</th>
                                <th>Quote Title</th>
                                <th>Meta Tag</th>
                                <th>Viewed</th>
                                <th>Visible</th>
                                <th>Miscallaneus</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sources as $key=>$source)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$source->firstName.', '.$source->middleName.', '.$source->lastName}}</td>
                                    <td>{{$source->sourceName}}</td>
                                    <td>{{$source->quoteTitle}}</td>
                                    <td>{{$source->metatag}}</td>
                                    <td>{{$source->viewed_Times}}</td>
                                    <td>{{$source->visible ? "Yes" : "No"}}</td>
                                    <td>{{$source->misc ? "Yes" : "No"}}</td>
                                    <td>
                                        <a href="{{ route('sources.edit', $source->id) }}"
                                           class="edit-article fa fa-edit"></a>
                                        <form
                                            action="{{ route('sources.destroy', $source->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure to delete this article?');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token"
                                                   value="{{ csrf_token() }}">
                                            <button type="submit"
                                                    class="delete-article fa fa-trash-alt"></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#sourceTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>

@endsection
