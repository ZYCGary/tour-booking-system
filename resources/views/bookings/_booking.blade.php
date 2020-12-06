<li class="media">
    <div class="media-body">
        <div class="media-heading mt-1 mb-1">
            <a class="text-dark" title="{{ $booking->tour->name }}">
                {{ $booking->tour->name }}
            </a>

            <a class="float-right text-muted" >
                <i class="far fa-clock"></i>
                <span class="timeago">{{ $booking->tour_date }}</span>
            </a>
        </div>
    </div>
</li>
