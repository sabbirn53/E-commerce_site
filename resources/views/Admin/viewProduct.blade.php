<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
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
                
                <h2 class="my-3 text-purple-300 text-center text-3xl">All Product</h2>
                <table class="table table-striped text-white">
                    <tr class="bg-primary">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>price</th>
                        <th>Discount price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($allProduct as $p)

                    <tr>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $p->quantity }}</td>
                        <td>{{ $p->category }}</td>
                        <td>{{ $p->price }}</td>
                        <td>{{ $p->discount_price }}</td>
                        <td>
                            <img style="width: 220px; height: 190px;" src="product/{{ $p->image }}" alt="">
                        </td>
                        <td>
                            <div class="btn btn-success"><a href="{{ url('edit',$p->id) }}">Edit</a></div>
                            <div class="btn btn-danger"><a onclick="return confirm('Are you sure to delete {{$p->title}} ')" href="{{ url('delete',$p->id) }}">Delete</a></div>
                        </td>
                    </tr>

                    @endforeach

                </table>
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