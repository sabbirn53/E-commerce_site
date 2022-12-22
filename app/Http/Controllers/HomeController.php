<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    public function index()
    {
        $product = products::paginate(10);
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        return view('home.userPage', compact('product', 'comment', 'reply'));
    }
    public function redirect()
    {
        $userType = Auth::user()->usertype;
        if ($userType == '1') {


            $total_product = products::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();

            $order = Order::all();

            $total_revenue = 0;

            foreach($order as $o){
                $total_revenue = $total_revenue + $o->price;
            }

            $total_delivered = Order::where('delivary_status', '=', 'delivered')->get()->count();
            $total_processing = Order::where('delivary_status', '=', 'processing')->get()->count();

            return view('Admin.home', compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } 
        
        else {
            $product = products::paginate(10);
            $comment = Comment::orderby('id', 'desc')->get();
            $reply = Reply::all();
            return view('home.userPage', compact('product', 'comment', 'reply'));
        }
    }
    public function productDetails($id)
    {
        $product = products::find($id);
        return view('home.productDetails', compact('product'));
    }
    public function addCart(Request $r, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();

            $product = products::find($id);
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->quantity = $r->quantity;

            $cart->product_id = $product->id;
            $cart->product_title = $product->title;
            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $r->quantity;
            } else {

                $cart->price = $product->price * $r->quantity;
            }
            $cart->image = $product->image;

            $cart->save();
            Alert::success('Product added Successfully.', 'We have added product to the cart');
            return redirect()->back();
        } 
        else {
            return redirect('login');
        }
    }

    public function showCart()
    {
        if (Auth::id()) {

            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showCart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('success', 'Cart deleted successfully.');
    }

    public function cashOrder()
    {
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', '=', $userId)->get();


        foreach ($data as $d) {
            $order = new Order;
            $order->user_id = $d->user_id;
            $order->name = $d->name;
            $order->email = $d->email;
            $order->phone = $d->phone;
            $order->address = $d->address;

            $order->product_id = $d->product_id;
            $order->product_title = $d->product_title;
            $order->price = $d->price;
            $order->quantity = $d->quantity;
            $order->image = $d->image;

            $order->payment_status = 'cash on delivary';
            $order->delivary_status = 'processing';

            $order->save();


            $cartID = $d->id;
            $cart = Cart::find($cartID);
            $cart->delete();
        }
        return redirect()->back()->with('success', 'We have received your order.We will contact with you soon');
    }

    public function cardPay($totalPrice)
    {
        return view('home.cardPay', compact('totalPrice'));
    }

    public function stripePost(Request $request, $totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalPrice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', '=', $userId)->get();


        foreach ($data as $d) {
            $order = new Order;
            $order->user_id = $d->user_id;
            $order->name = $d->name;
            $order->email = $d->email;
            $order->phone = $d->phone;
            $order->address = $d->address;

            $order->product_id = $d->product_id;
            $order->product_title = $d->product_title;
            $order->price = $d->price;
            $order->quantity = $d->quantity;
            $order->image = $d->image;

            $order->payment_status = 'Paid';
            $order->delivary_status = 'processing';

            $order->save();


            $cartID = $d->id;
            $cart = Cart::find($cartID);
            $cart->delete();
        }


        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function addComment(Request $r)
    {
    
        if(Auth::id())
        {

            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $r->comment;
            $comment->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }

    public function addReply(Request $r)
    {
    
        if(Auth::id())
        {

            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $r->commentId;
            $reply->reply = $r->reply;
            $reply->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }
    }
}
