
<div class="ers-container">
    <!-- Review Form -->
    <form action="" method="post" class="ers-form-wrapper" id="reviewForm">
        @csrf
        <h2>Write Your Review</h2>        
        <div class="ers-stars-container">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="rating" id="rating-input" value="0">
            <button type="button" class="ers-star-btn" data-value="1">★</button>
            <button type="button" class="ers-star-btn" data-value="2">★</button>
            <button type="button" class="ers-star-btn" data-value="3">★</button>
            <button type="button" class="ers-star-btn" data-value="4">★</button>
            <button type="button" class="ers-star-btn" data-value="5">★</button>
        </div>

        <textarea class="ers-text-input" name="review_text" placeholder="Share your experience..."></textarea>
        <div id="submission-message"></div>

        <button type="submit" class="ers-submit-btn">Submit Review</button>
    </form>

    <!-- Reviews Display -->
    @if ($reviews->isNotEmpty())
        <div class="ers-reviews-container">
            <h2>Customer Reviews</h2>
            <div id="ers-reviews-list">
                @foreach ($reviews as $review)
                    <div class="ers-review-card">
                        <div class="first-review">
                            <div class="ers-review-meta">
                                <h3 class="reviewer-name">{{ Str::lower($review->user->name) }}</h3>
                                {{ $review->created_at->format('d/m/Y') }}

                                <!-- Dropdown Menu -->
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button">
                                        <img src="{{ asset('front-assets/img/icon/ellipsis.svg') }}" alt="">
                                        
                                    </button>
                                    <ul class="dropdown-menu">
                                        {{-- <li><button class="edit-review-btn" type="button">Edit</button></li>
                                        <li><a href="#">Delete</a></li> --}}
                                        @if(Auth::check() && Auth::id() == $review->user_id)
                                            <li><button class="edit-review-btn" type="button">Edit</button></li>
                                            <li>
                                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-review-btn">Delete</button>
                                                </form>
                                            </li>
                                        @endif
                                        <li><a href="#">Report</a></li>
                                    </ul>
                                </div>
                            </div>
                        
                            <div class="ers-review-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>{{ $review->review_text }}</p>
                        </div>
                        <div class="edit-review" style="display: none;">
                            <form method="post" class="ers-form-wrapper reviewEditForm">
                                @csrf
                                <div class="ers-stars-container">
                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                    <input type="hidden" name="rating" class="rating-input" value="{{ $review->rating }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" class="ers-star-btn active" data-value="{{ $i }}">
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        </button>
                                    @endfor
                                </div>
                        
                                <textarea class="ers-text-input" name="review_text" placeholder="Share your experience..." style="min-height: 100px">{{ $review->review_text }}</textarea>
                                <div id="submission-message"></div>
                        
                                <button type="submit" class="ers-submit-btn">Update</button>
                                <button type="button" class="ers-submit-btn edit-review-btn" style="background: #ccc">Cancel</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>