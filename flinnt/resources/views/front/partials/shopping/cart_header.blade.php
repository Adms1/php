<div class="header-wrapicon2">
    <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
    <span class="header-icons-noti bg-color">{{Cart::instance('cartlist')->count()}}</span>
    <!-- Header cart noti -->
    <div class="header-cart header-dropdown">
        <ul class="header-cart-wrapitem">
            @foreach (Cart::instance('cartlist')->content() as $cart)
            <li class="header-cart-item">
                <div class="header-cart-item-img">
                    <img src="{{URL::asset('/'.$cart->options->image)}}" alt="IMG">
                </div>
                <div class="header-cart-item-txt">
                    <a href="#" class="header-cart-item-name m-text14">
                    {{ $cart->name }}
                    </a>
                    <span class="header-cart-item-info m-text14">
                    {{ $cart->qty }} x <i class="fa fa-rupee"></i> {{ $cart->price }}
                    </span>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="header-cart-total m-text14">
            Total: <i class="fa fa-rupee"></i>{{Cart::subtotal()}}
        </div>
        <div class="header-cart-buttons">
            <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ url('/cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                View Cart
                </a>
            </div>

            @if (Cart::instance('cartlist')->count() > 0)
            <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ route('select_address') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                    Check Out
                </a>
            </div>
            @endif
        </div>
    </div>
</div>