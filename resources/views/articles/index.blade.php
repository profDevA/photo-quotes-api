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
                    <h1 class="m-0 text-dark">Articles Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Articles</li>
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
                    <a href="{{route('articles.create')}}" class="create-article__link btn btn-primary float-right">New Article</a>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <table id="articleTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Text</th>
                                <th>Author</th>
                                <th>Source</th>
                                <th>Visible</th>
                                <th>Category</th>
                                <th>Article Type</th>
                                <th>Url</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Featured Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $key=>$article)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    @if (strlen($article->title) > 60)
                                        {{substr($article->title, 0, 60) . '...'}}
                                    @else
                                        {{$article->title}}
                                    @endif
                                </td>
                                <td>
                                    @if (strlen($article->text) > 120)
                                        {{substr($article->text, 0, 120) . '...'}}
                                    @else
                                        {{$article->text}}
                                    @endif
                                </td>
                                <td>{{$article->author}}</td>
                                <td>{{$article->source->lastName ?? ''}} {{$article->source->middleName ?? ''}} {{$article->source->firstName ?? ''}}</td>
                                <td>{{$article->visible == 1 ? 'Yes' : 'No'}}</td>
                                <td>{{$article->category->name ?? ''}}</td>
                                <td>{{$article->article_type ?? ''}}</td>
                                <td>{{$article->url}}</td>
                                <td>{{$article->meta_title}}</td>
                                <td>{{$article->meta_description}}</td>
                                <td>{{$article->featured_image}}</td>
                                <td>
                                    <a class="view-article fa fa-eye" href="{{ route('articles.show', $article->slug) }}"></a>
                                    <a href="{{ route('articles.edit', $article->id) }}" class="edit-article fa fa-edit"></a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this article?');" style="display: inline-block;">
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
        $('#articleTable').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    })
</script>

@endsection
