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
                        <h1 class="m-0 text-dark">Quote Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Quotes</li>
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
                        <a href="{{route('quotes.create')}}" class="create-article__link btn btn-primary float-right">New Quote</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <table id="quotetable" class="table table-bordered table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Quote</th>
                                <th>Hidden Comments</th>
                                <th>Visible Comments</th>
                                <th>Visible</th>
                                <th>Data Added</th>
                                <th>ReferenceId1</th>
                                <th>ReferenceId2</th>
                                <th>ReferenceId3</th>
                                <th>ReferenceId4</th>
                                <th>Quote Of The Day</th>
                                <th>bookid</th>
                                <th>Sender Email</th>
                                <th>Sender Name</th>
                                <th>source id</th>
                                <th>source name</th>
                                <th>IP Adress</th>
                                <th>Added By User</th>
                                <th>Original Quote</th>
                                <th>Quote Type</th>
                                <th>new</th>
                                <th>Turn Visible</th>
                                <th>page</th>
                                <th>Quote Count Visible</th>
                                <th>New Date</th>
                                <th>Rss Feed Type</th>
                                <th>admin Rss feed Type</th>
                                <th>is Edited</th>
                                <th>Rating</th>
                                <th>is_english</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($quotes as $key=>$quote)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$quote->quote}}</td>
                                    <td>{{$quote->visibleComments}}</td>
                                    <td>{{$quote->hiddenComments}}</td>
                                    <td>{{$quote->visible == 1 ? "Yes" : "No"}}</td>
                                    <!-- <td>{{$quote->source->lastName ?? ''}} {{$quote->source->middleName ?? ''}} {{$quote->source->firstName ?? ''}}</td> -->
                                    <td>{{$quote->dataAdded ?? ''}}</td>
                                    <td>{{$quote->referenceId1}}</td>
                                    <td>{{$quote->referenceId2}}</td>
                                    <td>{{$quote->referenceId3}}</td>
                                    <td>{{$quote->referenceId4}}</td>
                                    <td>{{$quote->quoteOfTheDay}}</td>
                                    <td>{{$quote->bookId}}</td>
                                    <td>{{$quote->senderEmail}}</td>
                                    <td>{{$quote->senderName}}</td>
                                    <td>{{$quote->sourceId}}</td>
                                    <td>{{$quote->sourceName}}</td>
                                    <td>{{$quote->IPAddress}}</td>
                                    <td>{{$quote->addedByUser}}</td>
                                    <td>{{$quote->originalQuote}}</td>
                                    <td>{{$quote->quoteType}}</td>
                                    <td>{{$quote->new == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$quote->turnVisible == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$quote->page}}</td>
                                    <td>{{$quote->quoteCountVisible == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$quote->newDate}}</td>
                                    <td>{{$quote->rssFeedType}}</td>
                                    <td>{{$quote->adminRssFeedType}}</td>
                                    <td>{{$quote->isEdited == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$quote->rating}}</td>
                                    <td>{{$quote->isEnglish == 1 ? "Yes" : "No"}}</td>
                                    <td>{{$quote->created_at}}</td>
                                    <td>
                                        <a href="{{ route('quotes.edit', $quote->id) }}" class="edit-article fa fa-edit"></a>
                                        <form action="{{ route('quotes.destroy', $quote->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this quote?');" style="display: inline-block;">
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
            $('#quotetable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });
        })
    </script>

@endsection
