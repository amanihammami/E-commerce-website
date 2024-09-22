<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminController extends Controller
{
    public function view_category(){
        $data=Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(request $request){
        $category=new category();
        $category->category_name=$request->category;
        $category->save();
        toastr()->timeOut(10000)->closeButton()->warning('category added successfully.');
        
        return redirect()->back();
        
    }
    public function delete_category($id)
    {
        $data=Category::find($id);
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->warning('category deleteded successfully.');
        return redirect()->back();
    }
    public function edit_category($id)
    {
        $data=Category::find($id);
        return view('admin.edit_category',compact('data'));
    }
    public function update_category(request $request,$id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        toastr()->timeOut(10000)->closeButton()->warning('category updated successfully.');
        return redirect('/view_category');
    }
    public function add_product(){
        $category=Category::all();
        return view('admin.add_product',compact('category'));
    }
    public function upload_product(request $request){
        $data=new product();
        $data->title=$request->title;
        $data->description=$request->description;
        $data->price=$request->price;
        $data->quantity=$request->qty;
        $data->category=$request->category;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getclientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image=$imagename;
        }
        toastr()->timeOut(10000)->closeButton()->warning('product added successfully.');
        $data->save();
        return redirect()->back();
        return view('admin.add_product',compact('category'));
    }
    public function view_product(){
        $product=Product::paginate(5);
        return view('admin.view_product',compact('product'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        $image_path=public_path('products/'.$data->image);
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
        $data->delete();
        toastr()->timeOut(10000)->closeButton()->warning('product deleted successfully.');
        return redirect()->back();
    }
    public function update_product($slug){
        
        $category=Category::all();
        $data = Product::where('slug',$slug)->get()->first();
        return view('admin.update_product',compact('data','category'));
    }
    public function edit_product(request $request,$id){
        $data=Product::find($id);
        $data->title=$request->title;
        $data->description=$request->description;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getclientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image=$imagename;
        }
        $data->price=$request->price;
        $data->category=$request->category;
        $data->quantity=$request->qty;
       
        
        
        toastr()->timeOut(10000)->closeButton()->warning('product updated successfully.');
        $data->save();
        return redirect('/view_product');
        
}
public function product_search(Request $request)
{
        
    $search=$request->search;
    $product = Product::where('title','Like','%'.$search.'%')
    ->orwhere('category','Like','%'.$search.'%')->paginate(3);
    return view('admin.view_product',compact('product'));
}
public function view_order(){
    $data=Order::all();
    return view('admin.order',compact('data'));
}
public function On_the_way($id)
{
    $data = Order::find($id);
    $data->status = 'On_the_way'; // Enclose On_the_way in quotes
    $data->save();
    return redirect('/view_order');
}

public function Delivered($id)
{
    $data = Order::find($id);
    $data->status = 'Delivered'; // Enclose On_the_way in quotes
    $data->save();
    return redirect('/view_order');
}
public function print_pdf($id)
{
    $data=Order::find($id);
    $pdf = Pdf::loadView('admin.invoice',compact('data'));
    return $pdf->download('invoice.pdf');
}
}