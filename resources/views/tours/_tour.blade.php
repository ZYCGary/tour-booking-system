<li class="media">
    <div class="media-body">
        <div class="media-heading mt-1 mb-1">
            <a class="text-dark" href="{{ route('tours.show', ['tour' => $tour->id]) }}" title="{{ $tour->name }}">
                {{ $tour->name }}
            </a>

            <a class="float-right"
               href="{{ route('bookings.create', ['tour' => $tour->id]) }}">
                <button type="submit" class="btn btn-primary btn-sm ml-2">Book Now
                </button>
            </a>

        </div>
    </div>
</li>
