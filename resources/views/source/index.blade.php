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

            @if($message = Session::get('alert'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{$message}}
                    </p>
                </div>
            </div>
            @endif


            <div class="row">
                <div class="col-md-12">
                    <table id="sourceTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Comments</th>
                                <th>Bio</th>
                                <th>URL name</th>
                                <th>Source Name</th>
                                <th>IP Adress</th>
                                <th>Viewed Times</th>
                                <th>Viewed Times Date</th>
                                <th>Quote Count Visible</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Background Image</th>
                                <th>Visible</th>
                                <th>Miscallaneus</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sources as $key=>$source)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$source->firstName.' '.$source->middleName.' '.$source->lastName}}</td>
                                <td>{{$source->slug}}</td>
                                <td>{{$source->comments}}</td>
                                <td>{{$source->bio}}</td>
                                <td>{{$source->urlName}}</td>
                                <td>{{$source->sourceName}}</td>
                                <td>{{$source->ipAddress}}</td>
                                <td>{{$source->viewed_Times}}</td>
                                <td>{{$source->viewed_times_date}}</td>
                                <td>{{$source->quoteCountVisible}}</td>
                                <td>{{$source->metaTitle}}</td>
                                <td>{{$source->metaDescription}}</td>
                                <td>
                                    <a href="{{$source->backgroundImage}}" data-fancybox>
                                        <img src="{{$source->backgroundImage}}" style="width: 70px;">
                                    </a>
                                </td>
                                <td>{{$source->visible ? "Yes" : "No"}}</td>
                                <td>{{$source->misc ? "Yes" : "No"}}</td>
                                <td>{{$source->created_at}}</td>
                                <td>
                                    <a href="{{ route('sources.edit', $source->id) }}" class="edit-article fa fa-edit"></a>
                                    <form action="{{ route('sources.destroy', $source->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
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
<script src="{{ asset('plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script>
    $(document).ready(function() {
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