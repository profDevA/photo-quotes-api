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
                        <h1 class="m-0 text-dark">Tag Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Tags</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div>

        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{route('tags.create')}}" class="create-article__link btn btn-primary float-right">New Tag</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="tagsTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tag Name</th>
                                <th>Added by User</th>
                                <th>Visible</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $key=>$tag)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->addedByUser}}</td>
                                    <td>{{$tag->visible ? "Yes" : "No"}}</td>
                                    <td>
                                        <a href="{{ route('tags.edit', $tag->id) }}"
                                           class="edit-article fa fa-edit"></a>
                                        <form
                                            action="{{ route('tags.destroy', $tag->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure to delete this tag?');"
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
        </section>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#tagsTable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>

@endsection
