@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Source</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sources.index')}}">Sources</a></li>
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
                <form action="{{ route('sources.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="source_firstname">First Name</label>
                                <input type="text" class="form-control" id="source_firstname" name="firstName" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="source_middlename">Middle name</label>
                                <input type="text" class="form-control" id="source_middlename" name="middleName" placeholder="Middle name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="source_lastname">Last name</label>
                                <input type="text" class="form-control" id="source_lastname" name="lastName" placeholder="Last name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_comments">Comments</label>
                                <textarea class="textarea form-control" name="comments" id="source_comments" placeholder="Place some text here" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_biography">Biography</label>
                                <textarea class="textarea form-control" name="bio" id="source_biography" placeholder="Place some text here" style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url_name">Url Name</label>
                                <input type="text" class="form-control" id="url_name" name="urlName" placeholder="Url name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_name">Source Name</label>
                                <input type="text" class="form-control" id="source_name" name="sourceName" placeholder="Source name">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="source_background_image">Source Background Image</label>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="source_background_image" name="backgroundImage">
                                    <label class="custom-file-label" for="source_background_image">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="source_meta_title" name="metaTitle" placeholder="Meta Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="source_meta_description">Meta Description</label>
                                <input type="text" class="form-control" id="source_meta_description" name="metaDescription" placeholder="Meta description">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Visible</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="visible1">
                                        <input type="radio" class="form-check-input" id="visible1" name="visible" value="1" checked>Visible
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="visible2">
                                        <input type="radio" class="form-check-input" id="visible2" name="visible" value="0">Hidden
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Miscallaneus</label>
                                <div class="form-check">
                                    <label class="form-check-label" for="misc1">
                                        <input type="radio" class="form-check-input" id="misc1" name="misc" value="1" checked>Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="misc2">
                                        <input type="radio" class="form-check-input" id="misc2" name="misc" value="0">No
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
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function() {
            // Summernote
            // $('.textarea').summernote()
            // File input
            bsCustomFileInput.init();
        })
    </script>
@endsection
