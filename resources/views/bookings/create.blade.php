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
                            <label for="tour_date">Tour Date</label>
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input name="tour_date" type="text" class="form-control datetimepicker-input"
                                       data-target="#datetimepicker"/>
                                <div class="input-group-append" data-target="#datetimepicker"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="input-group-addon">Status</span>
                            <select class="custom-select" name="status">
                                <option value=0>Submitted</option>
                                <option value=1>Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="passengers">Passengers</label>
                            <div class="well well-sm">
                                <button type="button" class="btn btn-success mb-2" id="addPassengerBtn">Add Passenger
                                </button>
                            </div>
                            <div id="passengers">
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

    <script id="document-template" type="text/x-handlebars-template">
        <div class="card mb-3 passenger-card">
            <div class="card-body">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Given Name</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Given Name" name="given_name[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Surname</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Surname" name="surname[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Email" name="email[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mobile</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Mobile" name="mobile[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date of Birth</span>
                    </div>
                    <input type="text" class="form-control" placeholder="e.g. 1994-02-04" name="dob[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Passport</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Passport" name="passport[]">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Special Request</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Special Request" name="special_request[]" value="">
                </div>
                <div class="well well-sm">
                    <button type="button" class="btn btn-danger mb-2 remove-passenger">Remove</button>
                </div>
            </div>
        </div>
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false,
                enabledDates: @json($enabledDates ?? '')
            });

            $('#dob').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $('#addPassengerBtn').on('click', function () {
                let source = $("#document-template").html();
                let template = Handlebars.compile(source);
                let html = template();
                $("#passengers").append(html)
            })

            $(document).on('click', '.remove-passenger', function (event) {
                $(this).closest('.passenger-card').remove();
            })
        });
    </script>
@stop
