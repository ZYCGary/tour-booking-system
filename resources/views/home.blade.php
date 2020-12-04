@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route('tours.create') }}">
                <button type="submit" class="btn btn-success btn-lg ml-2">Create A Tour
                </button>
            </a>
        </div>

        <div class="mt-3">
            <a href="{{ route('tours.index') }}">
                <button type="submit" class="btn btn-primary btn-lg ml-2">Find A Tour
                </button>
            </a>
        </div>

    </div>
@endsection
