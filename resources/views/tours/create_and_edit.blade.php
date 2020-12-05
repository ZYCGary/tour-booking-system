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

                    <form
                        action="{{ $tour->exists ? route('tours.update', ['tour' => $tour->id]) : route('tours.store') }}"
                        method="POST"
                        accept-charset="UTF-8">
                        @if($tour->exists)
                            @method('PUT')
                        @endif

                        @csrf

                        @include('shared._error')

                        <div class="form-group">
                            <input class="form-control" type="text" name="name"
                                   value="{{ old('name', $tour->name) }}"
                                   placeholder="Please enter a name" required/>
                        </div>

                        <div class="form-group">
                            <textarea name="itinerary" class="form-control" id="editor" rows="6"
                                      placeholder="Please enter an itinerary for the tour." required>{{ old('content', $tour->itinerary ) }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                <input name="dates" type="text" class="form-control datetimepicker-input"
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
                                </i> SAVE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                allowMultidate: true,
                multidateSeparator: ',',
                disabledDates: @json($disabledDates ?? '')
            });
        });
    </script>

@endsection
