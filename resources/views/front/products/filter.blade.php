<div class="shop__sidebar">
    <div class="shop__sidebar__search">
        <form action="#">
            <input type="text" placeholder="Cari...">
            <button type="submit"><span class="icon_search"></span></button>
        </form>
    </div>
    <div class="shop__sidebar__accordion">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-heading">
                    <a data-toggle="collapse" data-target="#collapseOne">Kategori</a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body">
                        {{-- <div class="shop__sidebar__categories">
                            <ul class="nice-scroll">

                                @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url($category['url']) }}">
                                        {{ $category['category_name'] }}
                                    </a>

                                    @if (!empty($category['subcategories']))
                                    <div id="collapse{{ $category['id'] }}" class="collapse"
                                        aria-labelledby="heading{{ $category['id'] }}" data-parent="#categoryAccordion">
                                        <div class="card-body py-1 pl-3">
                                            <ul class="list-unstyled">
                                                @foreach ($category['subcategories'] as $subcategory)
                                                <li>
                                                    <a href="{{ url($subcategory['url']) }}">{{
                                                        $subcategory['category_name'] }}</a>

                                                    @if (!empty($subcategory['subcategories']))
                                                    <ul class="list-unstyled pl-3">
                                                        @foreach ($subcategory['subcategories'] as $subsubcategory)
                                                        <li>
                                                            <a href="{{ url($subsubcategory['url']) }}">{{
                                                                $subsubcategory['category_name'] }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </li>


                                @endforeach

                            </ul>
                        </div> --}}
                        <div class="shop__sidebar__categories">
                            <ul class="nice-scroll category-list">
                                @foreach ($categories as $category)
                                <li>
                                    <span class="category-toggle">
                                        <a href="{{ url($category['url']) }}">
                                            {{ $category['category_name'] }}
                                        </a>
                                        @if (!empty($category['subcategories']))
                                        <span class="toggle-arrow">+</span>
                                        @endif
                                    </span>

                                    @if (!empty($category['subcategories']))
                                    <ul class="nested-category">
                                        @foreach ($category['subcategories'] as $subcategory)
                                        <li>
                                            <span class="category-toggle">
                                                <a href="{{ url($subcategory['url']) }}">
                                                    {{ $subcategory['category_name'] }}</a>
                                                @if (!empty($subcategory['subcategories']))
                                                <span class="toggle-arrow">+</span>
                                                @endif
                                            </span>

                                            @if (!empty($subcategory['subcategories']))
                                            <ul class="nested-category">
                                                @foreach ($subcategory['subcategories'] as $subsubcategory)
                                                <li>
                                                    <a href="{{ url($subsubcategory['url']) }}">
                                                        {{ $subsubcategory['category_name'] }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-heading">
                    <a data-toggle="collapse" data-target="#collapseTwo">Merek</a>
                </div>
                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="shop__sidebar__brand">
                            <ul>
                                @foreach ($brands as $brand)
                                <li>
                                    <a href="{{ request()->fullUrlWithQuery(['brand' => $brand->url]) }}">
                                        {{ $brand->brand_name }}
                                    </a>

                                </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>