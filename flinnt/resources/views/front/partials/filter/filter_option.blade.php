<div class="leftbar p-r-0-sm">
    <h5 class="m-text14 p-b-7 p-t-7 bo3">
        Show results for
    </h5>
    <h5 class="m-text14 p-b-7 p-t-7">
        <b>Any Category</b>
    </h5>

    <ul class="p-b-20">
        @if (!empty($category_id))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('category')">
                <i class="fa fa-angle-left"> Clear</i>
            </a>
        </li>
        @endif
        @foreach ($categories as $category) 
        <li class="p-t-4">
            <a href="#" onclick="set_category('{{$category["category_tree_id"]}}')" class="s-text13">
                {{ $category['category_name'] }}
            </a>
        </li>
        @endforeach
    </ul>

    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Bookset</b>
    </h4>

    <ul class="p-b-20">
        <li class="p-t-4 s-text13">
            <a href="{{route('bookset_home')}}" class="s-text13">{{ 'All' }}
            </a>
        </li>
        @foreach ($standards as $key => $standard) 
        <li class="p-t-4">
            <a href="{{route('bookset_home', $key)}}" class="s-text13">
                {{ $standard }}
            </a>
        </li>
        @endforeach
    </ul>

    @if (!Auth::guard('user')->check())
    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Institution</b>
    </h4>

    <ul class="p-b-20">
        @if (!empty($institution_id))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('institution')">
                <i class="fa fa-angle-left"> Clear</i>
            </a>
        </li>
        @endif
        @foreach ($institutions as $key => $institution)
        <li class="p-t-4">
            <a href="#" onclick="set_institution('{{$key}}')" class="s-text13">
                {{ $institution }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    @if (count($languages) > 0)
    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Refine by</b>
    </h4>
    <h5 class="m-text14">English & Indian Languages</h5>

    <ul class="p-b-20">
        @if (!empty($selected_lng))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('language')">
                <i class="fa fa-angle-left"> Clear</i>
            </a>
        </li>
        @endif
        @foreach ($languages  as $key => $language)
        <li class="p-t-4 s-text13">
            <input type="checkbox" id="language_{{ $key }}" name="languages[]" value="{{ $key }}" {{(in_array($key,$selected_lng)) ? "checked" : ""}} onclick="filter_checked('language_{{ $key }}')">
            <a href="#" class="s-text13" onclick="set_checked('language_{{ $key }}')">
                {{ $language }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    @if (count($formats) > 0)
    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Format</b>
    </h4>

    <ul class="p-b-20">
        @if (!empty($selected_frmt))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('format')">
                <i class="fa fa-angle-left"> Clear</i>
            </a>
        </li>
        @endif
        @foreach ($formats  as $key => $format)
        <li class="p-t-4 s-text13">
            <input type="checkbox" id="format_{{ $key }}" name="formats[]" value="{{ $key }}" {{(in_array($key,$selected_frmt)) ? "checked" : ""}} onclick="filter_checked('format_{{ $key }}')">
            <a href="#" class="s-text13" onclick="set_checked('format_{{ $key }}')">
                {{ $format }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    @if (count($authors) > 0)
    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Author</b>
    </h4>

    <ul class="p-b-20">
        @if (!empty($selected_athr))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('author')">
                <i class="fa fa-angle-left"> Clear</i>
            </a>
        </li>
        @endif
        @foreach ($authors  as $key => $author)
        <li class="p-t-4 s-text13">
            <input type="checkbox" id="author_{{ $key }}" name="authors[]" value="{{ $key }}" {{(in_array($key,$selected_athr)) ? "checked" : ""}} onclick="filter_checked('author_{{ $key }}')">
            <a href="#" class="s-text13" onclick="set_checked('author_{{ $key }}')">
                {{ $author }}
            </a>
        </li>
        @endforeach
    </ul>
    @endif

    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Avg. Customer Review</b>
    </h4>

    <ul class="p-b-20">
        <li class="p-t-4 s-text13">
            <p class="ratings">
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                & Up
            </p>
        </li>

        <li class="p-t-4 s-text13">
            <p class="ratings">
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                & Up
            </p>
        </li>

        <li class="p-t-4 s-text13">
            <p class="ratings">
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                & Up
            </p>
        </li>

        <li class="p-t-4 s-text13">
            <p class="ratings">
                <a href="#" class="star-color"><span class="fa fa-star"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                <a href="#"><span class="fa fa-star-o"></span></a>
                & Up
            </p>
        </li>
    </ul>

    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Item Condition</b>
    </h4>

    <ul class="p-b-20">
        <li class="p-t-4 s-text13">
            New
        </li>

        <li class="p-t-4 s-text13">
            Certified Refurbished
        </li>

        <li class="p-t-4 s-text13">
            Used
        </li>
    </ul>

    @if (count($prices) > 0)
    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Price</b>
    </h4>

    <ul class="p-b-20">
        @if (!empty($selected_min || $selected_max))
        <li class="p-t-4 s-text13">
            <a href="#" class="s-text13" onclick="checkbox_clear('price')">
                <i class="fa fa-angle-left"> Any Price</i>
            </a>
        </li>
        @endif
        @foreach ($prices  as $key => $price)
            @if($price['min'] == 0)
                <li class="p-t-4 s-text13" onclick="compile_filter('{{$price["min"]}}', '{{$price["max"]}}')">
                    <a href="#">
                        Under <i class="fa fa-rupee"></i> 100 
                    </a>
                </li>
            @elseif ($price['max'] == 'all')
                <li class="p-t-4 s-text13" onclick="compile_filter('{{$price["min"]}}', '')">
                    <a href="#">
                        Over <i class="fa fa-rupee"></i> 1000
                    </a>
                </li>
            @else
                <li class="p-t-4 s-text13" onclick="compile_filter('{{$price["min"]}}', '{{$price["max"]}}')">
                    <a href="#">
                        <i class="fa fa-rupee"></i> {{$price['min']}} - <i class="fa fa-rupee"></i> {{$price['max']}} 
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    @endif
    <p class="p-b-7">
        <!-- HTML for rupes sign &#8377 --->
        <input type="text" class="price_box" name="min" value="{{!empty($selected_min) ? $selected_min : ''}}" id="min" placeholder='Min'>
        <input type="text" class="price_box" name="max" value="{{!empty($selected_max) ? $selected_max : ''}}" id="max" placeholder='Max'>
        <button class="price_box btn-secondary width-27" onclick="set_checked('price_box')"> GO </button>
    </p>

    <h4 class="m-text14 p-b-7 p-t-7 bo3">
        <b>Discount</b>
    </h4>

    <ul class="p-b-20 border-discount">
        <li class="p-t-4 s-text13">
            10% Off or more
        </li>

        <li class="p-t-4 s-text13">
            25% Off or more
        </li>

        <li class="p-t-4 s-text13">
            35% Off or more
        </li>

        <li class="p-t-4 s-text13">
            50% Off or more
        </li>
    </ul>
</div>