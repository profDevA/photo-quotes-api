@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Tag</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tags.index')}}">Tags</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('tags.update', $tag->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tag_name">Tag Name</label>
                                <input type="text" class="form-control" id="tag_name" name="name" placeholder="Tag Name" value="{{$tag->name}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tag_added_user">Added User</label>
                                <input type="text" class="form-control" id="tag_added_user" name="addedByUser" placeholder="Middle name" value="{{$tag->addedByUser}}">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Visible</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="visible1">
                                        <input type="radio" class="form-check-input" id="visible1" name="visible" value="1"
                                               {{$tag->visible == 1 ? "checked": ""}}>Visible
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="visible2">
                                        <input type="radio" class="form-check-input" id="visible2" name="visible" value="0" {{$tag->visible == 0 ? "checked": ""}}>Hidden
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('scripts')

@endsection
