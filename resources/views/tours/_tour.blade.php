<li class="media">
    <div class="media-body">
        <div class="media-heading mt-1 mb-1">
            <a class="text-dark" href="{{ route('tours.show', ['tour' => $tour->id]) }}" title="{{ $tour->name }}">
                {{ $tour->name }}
            </a>
        </div>
    </div>
</li>