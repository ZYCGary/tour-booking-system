@extends('layouts.app')

@section('title', $tour->name)

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 question-content">
            <div class="card">
                <div class="card-body">
                    <h1 class="mt-3 mb-3">
                        {{ $tour->name }}
                    </h1>

                    <div class="tour-body mt-4 mb-4">
                        {{ $tour->itinerary }}
                    </div>

                    @if(auth()->id() === $tour->user_id)
                        <a class="float-right" href="{{ route('tours.edit', ['tour' => $tour]) }}">
                            <button type="submit" class="btn btn-success btn-sm">Edit
                            </button>
                        </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
            <div class="card ">
                <div class="card-body">
                    <div class="text-center">
                        Creator: {{ $tour->creator->name }}
                    </div>
                    <hr>
                    <div class="media">
                        <div align="center">
                            <a href="#">
                                <img class="thumbnail img-fluid" src="{{ asset('images/avators/avator.png') }}"
                                     width="300px" height="300px"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
