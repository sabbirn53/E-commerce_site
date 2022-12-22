<section id="product" class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $p)

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('product-details',$p->id) }}" class="option2">
                                products details
                            </a>


                            <form action="{{ url('add-cart',$p->id) }}" method="post" class="text-center options">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                                <button class="option1 px-3 py-1 rounded-2xl">Add to Cart</button>
                            </form>


                        </div>
                    </div>
                    <div class="img-box">
                        <img src="product/{{ $p->image }}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $p->title }}
                        </h5>
                        @if ( $p->discount_price!=null)

                        <h6 style="color:red; font-weight:bold">

                            ${{ $p->discount_price }}
                        </h6>


                        <h6 style="text-decoration: line-through ;">
                            ${{ $p->price }}
                        </h6>
                        @else

                        <h6 style="color:blue; font-weight:bold">
                            ${{ $p->price }}
                        </h6>
                        @endif

                    </div>
                </div>
            </div>

            @endforeach

            <div class="m-4">
                {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>

        </div>
    </div>
    <div class="btn-box">
        <a href="">
            View All products
        </a>
    </div>
    </div>
</section>