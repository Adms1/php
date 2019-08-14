@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
        @foreach ($products->chunk(4) as $items)
                @foreach ($items as $product)
                <div class="col-md-3" style="border: 1px solid; margin: 5px; padding: 5px; border-radius: 5px;">
                    <div class="thumbnail">
                            <div class="caption text-center">
                                <a href="{{ url('products/show', [$product->id]) }}"><img src="{{ asset('img/' . $product->image) }}" alt="product" class="img-responsive width-95"></a>
                                <a href="{{ url('products/show', [$product->id]) }}"><h3>{{ $product->name }}</h3>
                                <p>{{ $product->price }}</p>
                                </a>
                            </div> <!-- end caption -->
                        </div> <!-- end thumbnail -->
                    </div> <!-- end col-md-3 -->
                @endforeach
        @endforeach
        </div> <!-- end row -->
    </div>
</div>
@endsection
