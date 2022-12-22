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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
   <div class="hero_area">

      @include('sweetalert::alert')

      <!-- header section strats --Home/> -->
      @include('home.header')
      <!-- end header section

         <!-- slider section -->

      @include('home.slider')
      <!-- end slider section -->
   </div>
   <!-- why section -->
   @include('home.why')
   <!-- end why section -->

   <!-- arrival section -->
   @include('home.arrival')
   <!-- end arrival section -->

   <!-- product section -->
   @include('home.product')
   <!-- end product section -->






   <!-- comment and reply start  -->



   <div id="comment">


      <h1 class="text-4xl text-center my-5 text-red-400 font-bold">Comments</h1>

      <form class="w-50 mx-auto mb-5" action="{{ url('add-comment') }}" method="POST">
         @csrf
         <textarea placeholder="comment here" name="comment" id="" cols="30" rows="10"></textarea>
         <p class="text-center"> <button type="submit" class="btn btn-outline-danger">Submit</button></p>
      </form>

   </div>


   <div>

      <h1 class="text-4xl text-center my-5 text-green-400 font-bold">All Comments</h1>

      @foreach ($comment as $c)


      <div class="m-5">
         <b>{{ $c->name }}</b>
         <p>{{ $c->comment }}</p>

         <br>
         <a class="text-blue-500" href="javascript::void(0);" onclick="reply(this)" data-commentId="{{ $c->id}}">Reply</a>
      </div>


      <div style="padding-left: 10%; padding-bottom: 10px;">

         @foreach ($reply as $r)

         @if ($r->comment_id==$c->id)


         <b>{{ $r->name }}</b>
         <p>{{ $r->reply }}</p>
         <br>
         <a class="text-blue-500" href="javascript::void(0);" onclick="reply(this)" data-commentId="{{ $c->id}}">Reply</a>
         <br>


         @endif
         @endforeach

      </div>

      @endforeach


      <!-- Reply textarea  -->

      <div style="display: none;" class="m-5 replyDiv" id="replyDiv">
         <form action="{{ url('add-reply') }}" method="POST">
            @csrf
            <input type="text" name="commentId" id="commentId" hidden>
            <textarea placeholder="reply here" name="reply" id="" class="w-50" cols="30" rows="3"></textarea> <br>
            <button type="submit" class="btn btn-warning">Submit</button>
            <a class="text-blue-500 btn btn-dark" href="javascript::void(0);" onclick="reply_close(this)">Close</a>
         </form>

      </div>

   </div>


   <script type="text/javascript">
      function reply(caller) {

         document.getElementById('commentId').value = $(caller).attr('data-commentId');

         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
      }

      function reply_close(caller) {
         $('.replyDiv').hide();
      }
   </script>




   <!-- subscribe section -->
   @include('home.sub')
   <!-- end subscribe section -->
   <!-- client section -->
   @include('home.client')
   <!-- end client section -->
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

   <script>
      document.addEventListener("DOMContentLoaded", function(event) {
         var scrollpos = localStorage.getItem('scrollpos');
         if (scrollpos) window.scrollTo(0, scrollpos);
      });

      window.onbeforeunload = function(e) {
         localStorage.setItem('scrollpos', window.scrollY);
      };
   </script>
</body>

</html>