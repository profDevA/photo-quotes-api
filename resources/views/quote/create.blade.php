@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/boostrap-tag-input/css/tagsinput.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Quote</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('quotes.index')}}">Quotes</a></li>
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
                <form action="{{ route('quotes.store')}}" method="post" enctype="multipart/form-data" class="row">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quote_source">Source</label>
                            <select name="sourceId" id="quote_source" class="form-control">
                                <option value="">Select Source</option>
                                @foreach($sources as $key=>$source)
                                    <option value="{{$source->id}}">{{ ($source->firstName ? $source->firstName.'_' : '') . ($source->middleName ? $source->middleName.'_' : '') . ($source->lastName ? $source->lastName : '')}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quote_source_name">Source Name</label>
                            <input type="text" class="form-control" id="quote_source_name" name="sourceName" placeholder="Source Name">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="quote_text">Quote</label>
                            <textarea class="form-control" id="quote_text" name="quote" placeholder="Enter quote .." rows="7" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quote_visible_comment">Visible Comments</label>
                            <textarea name="visibleComments" id="quote_visible_comment" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quote_hidden_comment">Hidden Comments</label>
                            <textarea name="hiddenComments" id="quote_hidden_comment" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quote_reference_id_1">referenceId 1</label>
                            <input type="number" class="form-control" id="quote_reference_id_1" name="referenceId1" placeholder="referenceId">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quote_reference_id_2">referenceId 2</label>
                            <input type="number" class="form-control" id="quote_reference_id_2" name="referenceId2" placeholder="referenceId">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quote_reference_id_3">referenceId 3</label>
                            <input type="number" class="form-control" id="quote_reference_id_3" name="referenceId3" placeholder="referenceId">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="quote_reference_id_4">referenceId 4</label>
                            <input type="number" class="form-control" id="quote_reference_id_4" name="referenceId4" placeholder="referenceId">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_data_added">Data added</label>
                            <input type="date" class="form-control" id="quote_data_added" name="dataAdded" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_of_the_day">Quote of the day</label>
                            <div class="input-group">
                                <select name="quoteOfTheDay" id="quote_of_the_day" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_book_id">Quote Book</label>
                            <select name="bookId" id="quote_book_id" class="form-control">
                                <option value="">Select Book</option>
                                @foreach($books as $key=>$book)
                                    <option value="{{$book->id}}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_sender_email">Sender Email</label>
                            <input type="email" class="form-control" id="quote_sender_email" name="senderEmail" placeholder="Sender Email">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_sender_name">Sender Name</label>
                            <input type="text" class="form-control" id="quote_sender_name" name="senderName" placeholder="Sender Name">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_add_by_user">Add by User</label>
                            <input type="text" class="form-control" id="quote_add_by_user" name="addedByUser" placeholder="Add by User">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="original_quote">Original Quote</label>
                            <input type="text" class="form-control" id="original_quote" name="originalQuote" placeholder="Original Quote">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_type">Quote Type</label>
                            <div class="input-group">
                                <select name="quoteType" id="quote_type" class="form-control">
                                    <option value="1">Q</option>
                                    <option value="0">N</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_new">New</label>
                            <div class="input-group">
                                <select name="new" id="quote_new" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_turn_visible">Quote Turn Visible</label>
                            <div class="input-group">
                                <select name="turnVisible" id="quote_turn_visible" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_page">Page</label>
                            <input type="text" class="form-control" id="quote_page" name="page" placeholder="Page">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_count_visible">Quote Count Visible</label>
                            <div class="input-group">
                                <select name="quoteCountVisible" id="quote_count_visible" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_new_date">New Date</label>
                            <input type="date" class="form-control" id="quote_new_date" name="newDate">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_is_edited">Edited</label>
                            <div class="input-group">
                                <select name="isEdited" id="quote_is_edited" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_rating">Rating</label>
                            <input type="text" name="rating" id="quote_rating" class="form-control" placeholder="Rating" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quote_is_elglish">English</label>
                            <div class="input-group">
                                <select name="isEnglish" id="quote_is_elglish" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="tag_quote">Tags</label>
                            <input data-role="tagsinput" name="tags" id="tag_quote" type="text" class="form-control">

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Visible</label>
                            <div class="form-check">
                                <label class="form-check-label" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="visible" value="1" checked>Visible
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="visible" value="0">Hidden
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>

                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('scripts')
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('plugins/boostrap-tag-input/js/tagsinput.js')}}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        })
    </script>
@endsection
