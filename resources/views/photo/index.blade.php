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
                    <h1 class="m-0 text-dark">Photos Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Photos</li>
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
                    <a href="{{route('photos.create')}}" class="create-article__link btn btn-primary float-right">Upload New Photo</a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <table id="phototable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Source</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Added by User</th>
                                <th>Comment</th>
                                <th>Visible</th>
                                <th>Date Added</th>
                                <th>Date Changed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($photos as $key=>$photo)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$photo->source->firstName ?? ''}} {{$photo->source->middleName ?? ''}} {{$photo->source->lastName ?? ''}}</td>
                                <td>
                                    <a href="{{$photo->url}}" data-fancybox data-caption="{{$photo->title}}">
                                        <img src="{{$photo->url}}" alt="{{$photo->description}}" style="width: 70px;">
                                    </a>
                                </td>
                                <td>{{$photo->title}}</td>
                                <td>{{$photo->description}}</td>
                                <td>{{$photo->addedByUser}}</td>
                                <td>{{$photo->comment}}</td>
                                <td>{{$photo->visible == 1 ? "Yes" : "No"}}</td>
                                <td>{{$photo->created_at}}</td>
                                <td>{{$photo->updated_at}}</td>
                                <td>
                                    <a href="{{ route('photos.edit', $photo->id) }}" class="edit-article fa fa-edit"></a>
                                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
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
        $('#phototable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })
</script>

@endsection