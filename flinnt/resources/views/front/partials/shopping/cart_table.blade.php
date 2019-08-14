<div class="wrap-table-shopping-cart bgwhite">
  @if (sizeof($carts) > 0)
  <table class="table-shopping-cart m-width-0">
     <tr class="table-head">
        <th class="column-1"></th>
        <th class="column-2">Product</th>
        <th class="column-3">Price</th>
        <th class="column-4">Quantity</th>
        <th class="column-5">Total</th>
        <th class="column-6"></th>
     </tr>
     @foreach ( $carts as $cart)
     <tr class="table-row">
        <td class="column-1 p-t-10 p-b-10">
           <div class="cart-img-product b-rad-4 o-f-hidden">
              <img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG-PRODUCT">
           </div>
        </td>
        <td class="column-2 m-text14 p-t-10 p-b-10">{{ $cart->name }}</td>
        <td class="column-3 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i>{{ $cart->price }}</td>
        <td class="column-4 p-t-10 p-b-10">
           <div class="flex-w bo5 of-hidden w-size22">
              <button class="btn-num-product-down color1 flex-c-m qty-btn bg8 eff2">
              <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
              </button>
              <input class="qty-btn m-text18 t-center num-product quantity" data-id="{{ $cart->rowId }}" type="number" name="qty" value="{{ $cart->qty }}">
              <button class="btn-num-product-up color1 flex-c-m qty-btn bg8 eff2">
              <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
              </button>
           </div>
        </td>
        <td class="column-5 m-text14 p-t-10 p-b-10"><i class="fa fa-rupee"></i> {{ $cart->subtotal }}</td>
        <td class="column-6 m-text14 p-t-10 p-b-10">
          <i class="fa fa-trash-o fa-2x trash-color" aria-hidden="true" id="item-delete" data-id="{{ $cart->rowId }}"></i>
        </td>
     </tr>
     @endforeach
  </table>
  @endif
</div>