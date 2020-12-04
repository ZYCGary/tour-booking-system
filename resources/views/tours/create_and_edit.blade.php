@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">

                <div class="card-body">
                    <h2 class="">
                        <i class="far fa-edit"></i>
                        Post A Tour
                    </h2>

                    <hr>

                    <form action="{{ route('tours.store') }}" method="POST" accept-charset="UTF-8">

                        {{ csrf_field() }}

                        @include('shared._error')

                        <div class="form-group">
                            <input class="form-control" type="text" name="name" value="{{ old('name', $tour->name) }}"
                                   placeholder="Please enter a name" required dusk="question-title"/>
                        </div>

                        <div class="form-group">
                            <textarea name="itinerary" class="form-control" id="editor" rows="6"
                                      placeholder="Please enter an itinerary for the tour." required
                                      dusk="question-content">{{ old('content', $tour->itinerary ) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary" dusk="question-submit"><i
                                    class="far fa-save mr-2" aria-hidden="true"></i> SAVE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
