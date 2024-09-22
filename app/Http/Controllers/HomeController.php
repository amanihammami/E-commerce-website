<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use  App\Models\Product;
use  App\Models\User;
use  App\Models\Cart;
use  App\Models\Order;
use Session;
use Stripe;

class HomeController extends Controller
{
    public function index(){
        $user=User::where('usertype','user')->get()->count();
        $product=Product::all()->count();
        $order=Order::all()->count();
        $delivered=Order::where('status','delivered')->get()->count();
        if(Auth::user()->usertype==='admin')
        return view('admin.index',compact('user','product','order','delivered'));
        else 
        return redirect('/dashboard');
    }
    
    public function home(){
        $product=Product::all();
        if(Auth::id())
        {
        $user=Auth::user();
        $userid=$user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count='';
        }
        return view('home.index',compact('product','count'));
    }
    public function login_home(){
        $product=Product::all();
        if(Auth::id())
        {
        $user=Auth::user();
        $userid=$user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count='';
        }
        return view('home.index',compact('product','count'));
    }
    public function product_details($id){
        $data=Product::find($id);
        if(Auth::id())
        {
        $user=Auth::user();
        $userid=$user->id;
        $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count='';
        }
        
       
        return view('home.product_details',compact('data','count'));
    }
    public function add_cart($id){
        $product_id=$id;
        $user=Auth::user();
        $user_id=$user->id;
        $data=new Cart;
        $data->user_id=$user_id;
        $data->product_id=$product_id;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->warning('product added to the card successfully.');
        return redirect()->back();

    
    }
    public function mycart()
    {if(Auth::id())
        {
        $user=Auth::user();
        $userid=$user->id;
        $count = Cart::where('user_id',$userid)->count();
        $cart = Cart::where('user_id',$userid)->get();
        }
    
        return view('home.mycart',compact('count','cart'));
    }
    public function confirm_order(Request $request)
    {
        
        $userid=Auth::user()->id;
        $cart=Cart::where('user_id',$userid)->get();
        foreach($cart as $carts)
        {   
            $order= new Order();
            $order->name= $request->name;
            $order->rec_address= $request->address;
            $order->phone= $request->phone;
            $order->user_id=$userid;
            $order->product_id=$carts->product_id;
            $order->save();
        }
        $cart_remove=Cart::where('user_id',$userid)->get();
        foreach($cart_remove as $remove)
        {
            $data=Cart::find($remove->id);
            $data->Delete();
        }
        toastr()->timeOut(10000)->closeButton()->warning('product removed from the cart  successfully.');
 return redirect()->back();

    }
    public function myorders()
    {   $user=Auth::user()->id;
        $count=Cart::where('user_id',$user)->get()->count();
        $order=Order::where('user_id',$user)->get();
        return view('home.order',compact('count','order'));
    }
    public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }
    public function stripePost(Request $request,$value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from complete" 
        ]);
        $name=Auth::user()->name;
        $phone=Auth::user()->phone;
        $address=Auth::user()->address;
        $userid=Auth::user()->id;
        $cart=Cart::where('user_id',$userid)->get();
        foreach($cart as $carts)
        {   
            $order= new Order();
            $order->name= $name;
            $order->rec_address= $address;
            $order->phone= $phone;
            $order->user_id=$userid;
            $order->product_id=$carts->product_id;
            $order->payment_status ="paid";
            $order->save();
        }
        $cart_remove=Cart::where('user_id',$userid)->get();
        foreach($cart_remove as $remove)
        {
            $data=Cart::find($remove->id);
            $data->Delete();
        }
        toastr()->timeOut(10000)->closeButton()->warning('product removed from the cart  successfully.');
 return redirect('mycart');

    }
    public function shop()
    {
        return view('home.shop');
    }
    public function why()
    {
        return view('home.why');
    }
    public function testimonial()
    {
        return view('home.testimonial');
    }
    public function contact()
    {
        return view('home.contact');
    }
    

}
