<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\products;
use App\Models\Order;
use PDF;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewCategory()
    {
        $allCategory = Category::all();
        return view('Admin.category', compact('allCategory'));
    }
    public function addCategory(Request $r)
    {
        $data = new Category;

        $data->category_name = $r->category;
        $data->save();
        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function deleteCategory($id)
    {
        $delete = Category::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Category Deleted successfully');
    }

    public function addProduct()
    {
        $category =  Category::all();
        return view('Admin.product', compact('category'));
    }

    public function storeProduct(Request $r)
    {
        $add = new products();

        $add->title = $r->title;
        $add->description = $r->description;
        $add->quantity = $r->quantity;
        $add->price = $r->price;
        $add->category = $r->cate;
        $add->discount_price = $r->dPrice;



        $image = $r->img;
        $imgName = time() . '.' . $image->getClientOriginalExtension();
        $r->img->move('product', $imgName);
        $add->image = $imgName;



        $add->save();
        return redirect()->back()->with('success', 'Product added successfully');
    }

    public function viewProduct()
    {
        $allProduct = products::all();
        return view('Admin.viewProduct', compact('allProduct'));
    }
    public function delete($id)
    {

        $delete = products::find($id);
        $delete->delete();
        return redirect()->back()->with('success', 'Product Deleted successfully');
    }

    public function edit($id)
    {
        $editProduct = products::find($id);
        $category =  Category::all();
        return view('Admin.updateProduct', compact('editProduct', 'category'));
    }

    public function updateProduct(Request $r, $id)
    {
        $update = products::find($id);

        $update->title = $r->title;
        $update->description = $r->description;
        $update->quantity = $r->quantity;
        $update->price = $r->price;
        $update->category = $r->cate;
        $update->discount_price = $r->dPrice;

        $image = $r->img;
        $imgName = time() . '.' . $image->getClientOriginalExtension();
        $r->img->move('product', $imgName);
        $update->image = $imgName;

        $update->save();
        return redirect()->back()->with('success', 'Product update successfully');
    }

    public function viewOrder()
    {
        $order = Order::all();
        return view('Admin.viewOrder', compact('order'));
    }

    public function deliver($id)
    {
        $order = Order::find($id);
        $order->delivary_status = "delivered";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();
    }

    public function printPdf($id)
    {
        
        $order = Order::find($id);
        $pdf= PDF::loadView('Admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function searchData(Request $r)
    {
    //    $searchText = $r->search;

       $order = Order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();
       return view('Admin.viewOrder', compact('order'));

    }


}
