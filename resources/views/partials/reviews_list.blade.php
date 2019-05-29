<ul class="list-group">
    @foreach($reviews as $review)
        <li href="#" class="list-group-item">
            <a  href="{{ route('review',$review->{'slug'}) }}" class="d-flex justify-content-between no-underline">
                    <div class="pl-3">{{ $review->title }}</div>
            </a>
        </li>
    @endforeach
</ul>

