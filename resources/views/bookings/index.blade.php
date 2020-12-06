@extends('layouts.app')

@section('title', 'Tour list')

@section('content')

    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            <div class="card ">
                <div class="card-body">
                    {{-- Tour list --}}
                    @if (count($bookings))
                        <ul class="list-unstyled">
                            @foreach ($bookings as $booking)
                                @include('bookings._booking')

                                @if ( ! $loop->last)
                                    <hr>
                                @endif

                            @endforeach
                        </ul>
                    @else
                        <div class="empty-block">暂无数据 ~_~ </div>
                    @endif
                    {{-- Tour list end --}}

                    {{-- Pagination --}}
                    <div class="mt-5">
                        {{ $bookings->links() }}
                    </div>
                    {{-- Pagination end --}}

                </div>
            </div>
        </div>
    </div>

@endsection
