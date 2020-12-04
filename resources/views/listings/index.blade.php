@extends('layouts.app')

@section('title', 'Drafts List')

@section('content')
    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            <div class="card ">

                <div class="card-body">
                    @if (count($listings))
                        <ul class="list-unstyled">
                            @foreach ($listings as $listing)
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-heading mt-1 mb-1">
                                            {{ $listing->name }}

                                            <a class="text-muted">
                                                <i class="far fa-clock"></i>
                                                <span
                                                    class="timeago">Created At：{{ $listing->created_at->diffForHumans() }}</span>
                                            </a>


                                            <a class="float-right" href="{{ route('tours.edit', ['tour' => $listing]) }}">
                                                <button type="submit" class="btn btn-success btn-sm ml-2">Edit
                                                </button>
                                            </a>

                                            @if($listing->isPublic())
                                            <a class="float-right">
                                                <form action="{{ route('tours.publish', ['tour'=> $listing]) }}"
                                                      method="POST" accept-charset="UTF-8">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">PUBLISH
                                                    </button>
                                                </form>
                                            </a>
                                            @endif

                                        </div>
                                    </div>
                                </li>

                                @if ( ! $loop->last)
                                    <hr>
                                @endif

                            @endforeach
                        </ul>

                    @else
                        <div class="empty-block">No Data ~_~</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
