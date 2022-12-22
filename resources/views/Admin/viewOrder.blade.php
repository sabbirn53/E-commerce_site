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
                <h2 class="text-4xl my-3 font-bold text-center text-indigo-400">All order</h2>

                <div class="my-5 w-50 mx-auto">
                    <form action="{{url('search')}}" method="get">
                        @csrf
                        <input type="text" class="text-black" name="search" placeholder="search something">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <table class="table w-11/12 table-dark text-white border border-white">
                    <tr class="bg-white text-black">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>product_title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment status</th>
                        <th>Delivary status</th>
                        <th>Iamge</th>
                        <th>Action</th>
                        <th>Print</th>

                    </tr>

                    @forelse ($order as $o)
                    <tr>
                        <td>{{ $o->name }}</td>
                        <td>{{ $o->email }}</td>
                        <td>{{ $o->address }}</td>
                        <td>{{ $o->phone }}</td>
                        <td>{{ $o->product_title }}</td>
                        <td>{{ $o->quantity }}</td>
                        <td>{{ $o->price }}</td>
                        <td>{{ $o->payment_status }}</td>
                        <td>{{ $o->delivary_status }}</td>
                        <td>
                            <img style="width: 150px;height:100px;" src="/product/{{ $o->image }}" alt="">
                        </td>
                        <td>
                            @if ($o->delivary_status=='processing')

                            <a onclick="return confirm('Are you sure this product are delivered???')" href="{{ url('deliver',$o->id) }}" class="btn btn-success">Delivered</a>

                            @else
                            <p class="text-blue-400 font-bold text-lg">Delivered</p>
                            @endif


                        </td>
                        <td>

                            <a class="btn btn-sm btn-danger" href="{{url('print-pdf',$o->id)}}">PDF</a>
                        </td>
                    </tr>


                    @empty

                    <div>
                        <p class="text-center my-5">No data Found</p>
                    </div>

                    @endforelse
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