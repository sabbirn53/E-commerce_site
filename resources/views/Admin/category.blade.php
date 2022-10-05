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
                <div class="text-center py-5 text-4xl ">
                    <h2 class="my-3">Add Category</h2>

                    <form action="{{ url('add-category') }}" method="post">
                        @csrf
                        <input type="text" class="text-black" name="category" placeholder="enter your category">
                        <br>
                        <button class="btn btn-dark border border-white m-1">Add category</button>
                    </form>
                </div>

                <h3 class="text-3xl text-center text-blue-300 my-4">All Category</h3>

                <table class="table table-striped text-white w-5/12 m-auto">
                    <tr>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>
                    @foreach ($allCategory as $c)
                    <tr>
                        <td>{{ $c->category_name }}</td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete {{ $c->category_name }} ')" class="btn btn-danger" href="{{ url('delete-category', $c->id) }}">Delete</a>
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