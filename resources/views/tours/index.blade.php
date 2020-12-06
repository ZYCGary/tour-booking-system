@extends('layouts.app')

@section('title', 'Tour list')

@section('content')

    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            <div class="card ">
                <div class="card-body">
                    {{-- Tour list --}}
                    @if (count($tours))
                        <ul class="list-unstyled">
                            @foreach ($tours as $tour)
                                @include('tours._tour')

                                @if ( ! $loop->last)
                                    <hr>
                                @endif

                            @endforeach
                        </ul>
                    @else
                        <div class="empty-block">No data ~_~ </div>
                    @endif
                    {{-- Tour list end --}}

                    {{-- Pagination --}}
                    <div class="mt-5">
                        {{ $tours->links() }}
                    </div>
                    {{-- Pagination end --}}

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('tours.create') }}">
                        <button type="submit" class="btn btn-success btn ml-2">Create A Tour
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
