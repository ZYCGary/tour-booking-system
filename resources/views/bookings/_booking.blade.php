<li class="media">
    <div class="media-body">
        <div class="media-heading mt-1 mb-1">
            <a class="text-dark" title="{{ $booking->tour->name }}">
                {{ $booking->tour->name }}
            </a>

            <a class="text-muted ml-2 mr-2">
                <i class="far fa-clock"></i>
                <span class="timeago">{{ $booking->tour_date }}</span>
            </a>

            <a class="text-muted">
                <span class="timeago">|</span>
            </a>

            <a class="text-muted ml-2 mr-2">
                <span class="timeago">{{ $booking->status === 0 ? 'Submitted' : 'Cancelled' }}</span>
            </a>

            <a class="text-muted">
                <span class="timeago">|</span>
            </a>

            <a class="text-muted ml-2 mr-2">
                <span class="timeago">Passengers: {{ count($booking->passengers) }}</span>
            </a>

            <a class="float-right"
               href="{{ route('bookings.edit', ['booking' => $booking->id]) }}">
                <button type="submit" class="btn btn-primary btn-sm ml-2">Edit
                </button>
            </a>
        </div>
    </div>
</li>
