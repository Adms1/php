@if ($count > 0) 
<div class="flex-sb-m flex-w filter-header">
    <span class="s-text8 p-t-10 p-b-10 p-l-15">
        Showing 1–{{$count}} of {{$count}} results
        <b>
        @if (!empty($string))
            {{$string}}
        @endif 
        </b>
    </span>
    <input type="hidden" id="filter_header_data" name="filter_header_data" value="{{!empty($filter_encode) ? $filter_encode : ''}}">
</div>
@endif