<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
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
      <!-- end header section

         <!-- slider section -->

      <!-- end slider section -->

      @if (Session::has('success'))
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
         {{ Session::get('success') }}
      </div>
      @endif
      <div class="mt-5 container">
         <table class="table table-dark table-striped">
            <tr class="bg-success text-white">
               <th>product titles</th>
               <th>Quantity</th>
               <th>price</th>
               <th>Product Image</th>
               <th>Action</th>
            </tr>

            <?php
            $totalPrice = 0;
            ?>
            @foreach ($cart as $c)

            <tr class="">
               <td>{{ $c->product_title }}</td>
               <td>{{ $c->quantity }}</td>
               <td>{{ $c->price }}</td>
               <td>
                  <img style="height: 150px; width:150px" src="/product/{{ $c->image }}" alt="">
               </td>
               <td>
                  <a onclick="return confirm('Are you sure delete {{ $c->product_title }} ')" href="{{ url('remove-cart',$c->id) }}">
                     <div class="btn btn-danger">Remove Product</div>
                  </a>
               </td>
            </tr>

            <?php
            $totalPrice = $totalPrice + $c->price;
            ?>

            @endforeach


         </table>

         <div>
            <h2 class="text-3xl my-4 text-center font-bold">Total price : {{ $totalPrice }}</h2>
         </div>
         <div class="text-center my-3 py-3">
            <h1 class="text-2xl font-bold text-danger">Proceed to order</h1>
            <a class="btn btn-primary my-2" href="{{ url('cash-order') }}">Cash on delivary</a>
            <a class="btn btn-success" href="{{ url('card-pay',$totalPrice )}}">pay using Card</a>
         </div>
      </div>
   </div>
   <!-- why section -->
   <!-- end why section -->



   <!-- arrival section -->
   <!-- end arrival section -->

   <!-- product section -->
   <!-- end product section -->

   <!-- subscribe section -->
   <!-- end subscribe section -->
   <!-- client section -->
   <!-- end client section -->
   <!-- footer start -->
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