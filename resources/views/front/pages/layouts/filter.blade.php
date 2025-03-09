<div class="shop__sidebar">
        <div class="shop__sidebar__search">
            <form action="{{ route('front.shop') }}" method="get">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search...">
                <button type="submit"><span class="icon_search"></span></button>
            </form>
        </div>
        <form method="GET" action="{{ route('front.shop') }}">
            <div class="shop__sidebar__accordion">
                <div class="accordion" id="accordionExample">
                    @if ($categories->isNotEmpty())
                        <div class="card">
                            <div class="card-heading">
                                <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="shop__sidebar__categories">
                                        <ul class="taxonomy custom-scrollbar">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <label class="position-relative cursor-pointer" for="category-{{ $category->id }}"> 
                                                        <input type="checkbox" id="category-{{ $category->id }}"  name="category[]"  value="{{ $category->slug }}"
                                                            {{ in_array($category->slug, request()->category ?? []) ? 'checked' : '' }}> 
                                                        <a>{{ $category->name }} ({{ optional($category->products)->count() ?? 0 }})</a>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($brands->isNotEmpty())
                        <div class="card">
                            <div class="card-heading">
                                <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                            </div>
                            <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="shop__sidebar__brand">
                                        <ul class="taxonomy custom-scrollbar">
                                            @foreach ($brands as $brand)
                                                <li>
                                                    {{-- <a href="{{ route('front.shop', ['brand' => $brand->slug]) }}">
                                                        {{ $brand->name }} ({{ optional($brand->products)->count() ?? 0 }})
                                                    </a> --}}
                                                    <label class="position-relative cursor-pointer" for="brand-{{ $brand->id }}"> 
                                                        <input type="checkbox" id="brand-{{ $brand->id }}"  name="brand[]"  value="{{ $brand->slug }}"
                                                            {{ in_array($brand->slug, request()->brand ?? []) ? 'checked' : '' }}> 
                                                        <a>{{ $brand->name }} ({{ optional($brand->products)->count() ?? 0 }})</a>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- <div class="card">
                        <div class="card-heading">
                            <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                        </div>
                        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="shop__sidebar__price">
                                    <ul class="taxonomy custom-scrollbar">
                                        <li><a href="#">$0.00 - $50.00</a></li>
                                        <li><a href="#">$50.00 - $100.00</a></li>
                                        <li><a href="#">$100.00 - $150.00</a></li>
                                        <li><a href="#">$150.00 - $200.00</a></li>
                                        <li><a href="#">$200.00 - $250.00</a></li>
                                        <li><a href="#">$250.00+</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="filter-action">
                <a href="{{ route('front.shop') }}" class="btn btn-secondary mt-4">Reset Filters</a>
                <button type="submit" class="btn btn-primary mt-4">Apply Filters</button>
            </div>
        </form>
        
</div>