<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">

    @include('Admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('Admin.sidebar')
        <!-- partial -->
        @include('Admin.header')
        <!-- partial -->



        <div class="main-panel">
            <div class="content-wrapper">

                @if (Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="">
                    <h1 class="text-center text-4xl bg-primary p-2 mb-5">Update Products</h1>

                    <form class="mt-5 border border-white p-3 w-50 m-auto" action="{{ url('update-product',$editProduct->id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="">Product title : </label> <br>
                            <input value="{{ $editProduct->title }}" class="text-black w-100" type="text" name="title" placeholder="enter product title" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product description : </label> <br>
                            <input value="{{ $editProduct->description }}" class="text-black w-100" type="text" name="description" placeholder="enter product description" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product price : </label> <br>
                            <input value="{{ $editProduct->price }}" class="text-black w-100" type="number" name="price" placeholder="enter product price" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product discount price : </label> <br>
                            <input value="{{ $editProduct->discount_price }}" class="text-black w-100" type="number" name="dPrice" placeholder="enter product discount price">
                        </div>
                        <div class="mt-3">
                            <label for="">Product quantity : </label> <br>
                            <input value="{{ $editProduct->quantity }}" class="text-black w-100" min="0" type="number" name="quantity" placeholder="enter product quantity" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product category : </label> <br>
                            <select class="text-black w-100" name="cate" id="" required>
                                <option value="{{ $editProduct->category }}" selected>{{ $editProduct->category }}</option>

                                @foreach ($category as $c)
                                <option value="{{ $c->category_name }}">{{ $c->category_name }}</option>
                                @endforeach
                              
                            </select>
                        </div>
                        
                        <div class="my-3">
                            <label for="">Product image : </label> <br>
                            <input value="{{ $editProduct->image }}"  class="w-100" type="file" name="img" required>
                        </div>
                        <div class="text-center mb-3">
                            <button class="btn btn-danger">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('Admin.script')
    <!-- End custom js for this page -->
</body>

</html>