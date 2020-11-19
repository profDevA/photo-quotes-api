@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Quote</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quotes.index')}}">Quotes</a></li>
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
            <form action="{{ route('quotes.update', $quote->id)}}" method="post" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quote_source">Source</label>
                        <select name="sourceId" id="quote_source" class="form-control">
                            @foreach($sources as $key=>$source)
                            <option value="{{$source->id}}" {!! ( isset($quote->source) && $quote->source->id == $source->id ) ? 'selected':'' !!}>{{ $source->lastName.'_'.$source->middleName.'_'.$source->firstName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quote_source_name">Source Name</label>
                        <input type="text" class="form-control" id="quote_source_name" name="sourceName" placeholder="Source Name" value="{{ $quote->sourceName }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="quote_text">Quote</label>
                        <textarea class="form-control" id="quote_text" name="quote" placeholder="Enter quote .." rows="4" required>{{ $quote->quote }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quote_visible_comment">Visible Comments</label>
                        <textarea name="visibleComments" id="quote_visible_comment" cols="10" rows="5" class="form-control">{{ $quote->visibleComments }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quote_hidden_comment">Hidden Comments</label>
                        <textarea name="hiddenComments" id="quote_hidden_comment" cols="10" rows="5" class="form-control">{{ $quote->hiddenComments }}</textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quote_reference_id_1">referenceId 1</label>
                        <input type="number" class="form-control" id="quote_reference_id_1" name="referenceId1" placeholder="referenceId" value="{{ $quote->referenceId1 }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quote_reference_id_2">referenceId 2</label>
                        <input type="number" class="form-control" id="quote_reference_id_2" name="referenceId2" placeholder="referenceId" value="{{ $quote->referenceId2 }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quote_reference_id_3">referenceId 3</label>
                        <input type="number" class="form-control" id="quote_reference_id_3" name="referenceId3" placeholder="referenceId" value="{{ $quote->referenceId3 }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quote_reference_id_4">referenceId 4</label>
                        <input type="number" class="form-control" id="quote_reference_id_4" name="referenceId4" placeholder="referenceId" value="{{ $quote->referenceId4 }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_data_added">Date added</label>
                        <input type="date" class="form-control" id="quote_data_added" name="dataAdded" value="{{ $quote->dataAdded }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_of_the_day">Quote of the day</label>
                        <div class="input-group">
                            <select name="quoteOfTheDay" id="quote_of_the_day" class="form-control">
                                <option value="0" {!! $quote->quoteOfTheDay == 0 ? 'selected' : '' !!}>No</option>
                                <option value="1" {!! $quote->quoteOfTheDay == 1 ? 'selected' : '' !!}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_book_id">Quote Book</label>
                        <select name="bookId" id="quote_book_id" class="form-control">
                            @foreach($books as $key=>$book)
                            <option value="{{$book->id}}" {!! isset($quote->book) && $quote->book->id == $book->id ? 'seelcted' : '' !!}>{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_sender_email">Sender Email</label>
                        <input type="email" class="form-control" id="quote_sender_email" name="senderEmail" placeholder="Sender Email" value="{{ $quote->senderEmail }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_sender_name">Sender Name</label>
                        <input type="text" class="form-control" id="quote_sender_name" name="senderName" placeholder="Sender Name" value="{{ $quote->senderName }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_add_by_user">Add by User</label>
                        <input type="text" class="form-control" id="quote_add_by_user" name="addedByUser" placeholder="Add by User" value="{{ $quote->addedByUser }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="original_quote">Original Quote</label>
                        <input type="text" class="form-control" id="original_quote" name="originalQuote" placeholder="Original Quote" value="{{ $quote->originalQuote }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_type">Quote Type</label>
                        <div class="input-group">
                            <select name="quoteType" id="quote_type" class="form-control">
                                <option value="1" {!! $quote->quoteType == 1 ? 'selected' : '' !!}>Q</option>
                                <option value="0" {!! $quote->quoteType == 0 ? 'selected' : '' !!}>N</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_new">New</label>
                        <div class="input-group">
                            <select name="new" id="quote_new" class="form-control">
                                <option value="0" {!! $quote->new == 0 ? 'selected' : '' !!}>No</option>
                                <option value="1" {!! $quote->new == 1 ? 'selected' : '' !!}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_turn_visible">Quote Turn Visible</label>
                        <div class="input-group">
                            <select name="turnVisible" id="quote_turn_visible" class="form-control">
                                <option value="0" {!! $quote->turnVisible == 0 ? 'selected' : '' !!}>No</option>
                                <option value="1" {!! $quote->turnVisible == 1 ? 'selected' : '' !!}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_page">Page</label>
                        <input type="text" class="form-control" id="quote_page" name="page" placeholder="Page" value="{{ $quote->page }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_count_visible">Quote Count Visible</label>
                        <div class="input-group">
                            <select name="quoteCountVisible" id="quote_count_visible" class="form-control">
                                <option value="1" {!! $quote->quoteCountVisible == 1 ? 'selected' : '' !!}>Yes</option>
                                <option value="0" {!! $quote->quoteCountVisible == 0 ? 'selected' : '' !!}>No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_new_date">New Date</label>
                        <input type="date" class="form-control" id="quote_new_date" name="newDate" value="{{ $quote->newDate }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_is_edited">Edited</label>
                        <div class="input-group">
                            <select name="isEdited" id="quote_is_edited" class="form-control">
                                <option value="0" {!! $quote->isEdited == 0 ? 'selected' : '' !!}>No</option>
                                <option value="1" {!! $quote->isEdited == 1 ? 'selected' : '' !!}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_rating">Rating</label>
                        <input type="text" name="rating" id="quote_rating" class="form-control" placeholder="Rating" value="{{ $quote->rating }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quote_is_elglish">English</label>
                        <div class="input-group">
                            <select name="isEnglish" id="quote_is_elglish" class="form-control">
                                <option value="1" {!! $quote->isEnglish == 1 ? 'selected' : '' !!}>Yes</option>
                                <option value="0" {!! $quote->isEnglish == 0 ? 'selected' : '' !!}>No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="tag_quote">Tags</label>
                        <input type="text" name="tags" id="tag_quote" class="form-control" placeholder="Enter separated by comma" value="{{ $tags_str }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Visible</label>
                        <div class="form-check">
                            <label class="form-check-label" for="radio1">
                                <input type="radio" class="form-check-input" id="radio1" name="visible" value="1" {!! $quote->visible == 1 ? 'checked':'' !!}>Visible
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="radio2">
                                <input type="radio" class="form-check-input" id="radio2" name="visible" value="0" {!! $quote->visible == 0 ? 'checked':'' !!}>Hidden
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
<script>

</script>
@endsection