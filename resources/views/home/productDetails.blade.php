<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="Home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="Home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="Home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="Home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats --Home/> -->
        @include('home.header')
        <!-- <!-- end header section -->

        <div class="col-sm-6 col-md-4 col-lg-4 w-50 p-5 m-auto">

            <div class="border border-primary m-5 shadow-lg p-5">

                <div class="img-box">
                    <img src="product/{{ $product->image }}" alt="">
                </div>
                <div class="detail-box mt-3">
                    <h5>

                        Title : {{ $product->title }}
                    </h5>
                    @if ( $product->discount_price!=null)

                    <h6 style="color:red; font-weight:bold" class="mt-1">

                        Discount Price : ${{ $product->discount_price }}
                    </h6>


                    <h6 style="text-decoration: line-through ;" class="mt-1">
                        Price : ${{ $product->price }}
                    </h6>
                    @else

                    <h6 style="color:blue; font-weight:bold" class="mt-1">
                        Price : ${{ $product->price }}
                    </h6>
                    @endif

                    <h6 class="mt-1">
                        Category : {{ $product->category }}
                    </h6>
                    <h6 class="mt-1">
                        Description : {{ $product->description }}
                    </h6>
                    <h6 class="mt-1">
                        Available Quantity : {{ $product->quantity }}
                    </h6>

                    <div>
                        <form action="{{ url('add-cart',$product->id) }}" method="post" class="text-center options">
                            @csrf
                            
                            <h4 style="display:inline-block" class="mr-7">Quantity :</h4>
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px; margin-top:10px;">
                            <button class="btn btn-success px-3 py-1 rounded-2xl">Add to Cart</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>




    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="Home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="Home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="Home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="Home/js/custom.js"></script>
</body>

</html>