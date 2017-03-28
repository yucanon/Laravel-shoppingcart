<?php

namespace App\Http\Controllers;
use App\Product;
use App\Cart;
use App\User;
use Session;
use Illuminate\Http\Request;

use Auth;
use App\Order;
use Stripe\Charge;
use Stripe\Stripe;
use App\Http\Requests;

class ProductController extends Controller{
    public function getIndex(Request $request){
        $products=Product::all();
        $keyword = $request->input('keyword');
        $query = Product::query();
        if(!empty($keyword)){
            $query->where('title','like','%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%');
        }
        $products = $query->orderBy('created_at','desc')->paginate(9);
        return view('shop.index')->with('products',$products)->with('keyword',$keyword)->with('message','ユーザーリスト');
    }
    public function getShow($id){
        $product=Product::findOrFail($id);
        return view('shop.show')->with('product',$product);
    }
    public function getAddToCart(Request $request, $id){
    	$product=Product::find($id);
    	$oldCart=Session::has('cart') ? Session::get('cart') : null;
    	$cart = new Cart($oldCart);
    	$cart->add($product, $product->id);

    	$request->session()->put('cart', $cart);
    	return redirect()->route('product.index');
    }
    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }
    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }
    public function getCart(Request $request){
        if(!Session::has('cart')){
            return view('shop.shopping-cart', ['products'=>null]);
        }
        $keyword = $request->input('keyword');
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        return view('shop.shopping-cart', ['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice, 'keyword'=>$keyword]);
    }
     public function getCheckout(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart=Session::get('cart');
        $cart= new Cart($oldCart);
        $total=$cart->totalPrice;
        return view('shop.checkout', ['total'=>$total]);
     }
     public function postCheckout(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);

        Stripe::setApiKey('sk_test_OWg5N71XOvJmoJm24PRAne5O');
        try{
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice,
                "currency" => "jpy",
                "description" => "Test charge",
                "source" => $request->input('stripeToken'),
                ));
            $order= new Order();
            $order->cart=serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request ->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        }catch(\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
     }
}


