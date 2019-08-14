<?php

namespace App\Http\Controllers\V1\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CartCreateRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\BooksetRepository;
use App\Validators\CartValidator;
use \Cart as Cart;
use Config;
use Session;
use Auth;
use Log;

/**
 * Class CartsController.
 *
 * @package namespace App\Http\Controllers\V1\Frontend;
 */
class CartsController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var BooksetRepository
     */
    protected $booksetRepository;

    /**
     * @var CartValidator
     */
    protected $validator;

    /**
     * CartsController constructor.
     *
     * @param CartRepository $cartRepository
     * @param ProductRepository $productRepository
     * @param BooksetRepository $booksetRepository
     * @param CartValidator $validator
     */
    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository,
        BooksetRepository $booksetRepository,
        CartValidator $validator)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
        $this->booksetRepository = $booksetRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cart list
        Log::channel('loginfo')->info('Cart list.',['Frontend/CartsController/index']);
        $this->cartRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $user_id = Auth::guard('user')->user()->user_id;        
        Cart::instance('cartlist')->restore($user_id.'_cart');
        Cart::instance('cartlist')->store($user_id.'_cart');
        $carts = Cart::instance('cartlist')->content();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $carts,
            ]);
        }
        return view('front.cart', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CartCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $user_id = Auth::guard('user')->user()->user_id;
            $duplicates = Cart::instance('cartlist')->search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->id;
            });

            if (!$duplicates->isEmpty()) {
                Session::flash('message', 'Item is already in your cart!');
                Session::flash('alert-class', 'alert-danger'); 
                $response = [
                    'message' => 'Item is already in your cart!',
                ];
                //return redirect('cart')->with('response', $response);
                return redirect()->back()->with('response', $response);
            }

            if ($request->book_id) {
                switch ($request->type) {
                    case 'book':
                        $path = $this->productRepository->getProductPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $path;
                        break;

                    case 'bookset':
                        $path = $this->booksetRepository->getBooksetPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $path;
                        break;

                    default:
                        $path = $this->productRepository->getProductPrimaryImage($request->book_id);
                        $option['image'] = Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $path;
                        break;
                }
                $option['type'] = $request->type;
            }

            $qty = isset($request->qty) ? $request->qty : 1;

            // Cart store
            Log::channel('loginfo')->info('add item to cart.',['Frontend/CartsController/store']);

            Cart::instance('cartlist')->add($request->id, $request->name, $qty , $request->price, $option)->associate('App\Product');
            Cart::instance('cartlist')->restore($user_id.'_cart');
            Cart::instance('cartlist')->store($user_id.'_cart');
            Session::flash('message', 'Item is added to your cart!');
            Session::flash('alert-class', 'alert-success'); 

            $response = [
                'message' => 'Item is added to your cart!',
            ];
            return redirect('cart')->with('response', $response);
            //return redirect()->back()->with('response', $response);

            /*$cart = $this->cartRepository->create($request->all());

            $response = [
                'message' => 'Cart created.',
                'data'    => $cart->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);*/
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Log::channel('loginfo')->error('store cart item.',[$e->getMessageBag()]);
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $cart = $this->cartRepository->find($id);

    //     if (request()->wantsJson()) {

    //         return response()->json([
    //             'data' => $cart,
    //         ]);
    //     }

    //     return view('carts.show', compact('cart'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $cart = $this->cartRepository->find($id);

    //     return view('carts.edit', compact('cart'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(CartUpdateRequest $request)
    {
        try {
            // Cart update
            Log::channel('loginfo')->info('update item of cart.',['Frontend/CartsController/update']);

            $user_id = Auth::guard('user')->user()->user_id;
            Cart::instance('cartlist')->restore($user_id.'_cart');
            Cart::instance('cartlist')->update($request->id, $request->quantity);
            Cart::instance('cartlist')->store($user_id.'_cart');
            $response = [
                'message' => 'Quantity updated successfully!',
            ];

            $carts = Cart::instance('cartlist')->content();
            $header = view('front.partials.shopping.cart_header', compact('carts'))->render();
            $table = view('front.partials.shopping.cart_table', compact('carts'))->render();
            $shipping = view('front.partials.shopping.cart_shipping', compact('carts'))->render();
            return response()->json([
                'header' => $header,
                'table' => $table,
                'shipping' => $shipping,
                'msg' => 'Quantity updated successfully!'
            ]);
            //return array('header' => $header, 'table' => $table, 'shipping' => $shipping);

            //return response()->json(['success' => true]);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Log::channel('loginfo')->error('update cart item.',[$e->getMessageBag()]);
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Delete Cart
        Log::channel('loginfo')->info('delete cart item.',['Frontend/CartsController/destroy']);

        $user_id = Auth::guard('user')->user()->user_id;
        Cart::instance('cartlist')->restore($user_id.'_cart');
        Cart::instance('cartlist')->remove($request->id);
        Cart::instance('cartlist')->store($user_id.'_cart');

        $carts = Cart::instance('cartlist')->content();
        $header = view('front.partials.shopping.cart_header', compact('carts'))->render();
        $table = view('front.partials.shopping.cart_table', compact('carts'))->render();
        $shipping = view('front.partials.shopping.cart_shipping', compact('carts'))->render();
        return response()->json([
            'header' => $header,
            'table' => $table,
            'shipping' => $shipping,
            'msg' => 'Item has been removed!'
        ]);
        
        //return redirect()->back()->with('response', $response);
    }
}
