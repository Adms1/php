@foreach ($remain_que_count as $key => $que_count)
<div class="pull-left m-5">
    <span class="label label-default font-12 p-l-10 p-r-10" id="" data-remain="" data-qno="">{{$key}} : {{$que_count}} </span>
</div>
@endforeach