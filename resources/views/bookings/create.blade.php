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

                    <form action="{{ route('bookings.store') }}" method="POST" accept-charset="UTF-8">
                        @csrf

                        @include('shared._error')

                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input name="tour_date" type="text" class="form-control datetimepicker-input"
                                       data-target="#datetimepicker"/>
                                <div class="input-group-append" data-target="#datetimepicker"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary"><i
                                    class="far fa-save mr-2" aria-hidden="true">
                                </i> BOOK
                            </button>
                        </div>
                    </form>
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

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                enabledDates: @json($enabledDates ?? '')
            });
        });
    </script>
@stop
