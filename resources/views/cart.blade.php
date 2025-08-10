<x-header/>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach ($cartItems as $item)
                                    
                               
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ URL::asset('uploads/products/'.$item->picture) }}" width="100px" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->title }}</h6>
                                            <h5>${{ $item->price }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="number" class="form-control" min="1" max="{{ $item->pQuantity }}" name="quantity" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ {{ $item->price * $item->quantity   }}</td>
                                    <td class="cart__close"><a href="{{ URL::to('deleteCartItem/'.$item->id)  }}"> <i class="fa fa-close"></i></a></td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            {{-- <li>Subtotal <span>$ {{ $total }}</span></li>
                            <li>Total <span>$ {{ $total }}</span></li> --}}
                           
                        </ul>
                      <form action="{{ url('checkout') }}" method="POST">
    @csrf
    <input type="text" name="fullname" class="form-control mt-2" placeholder="Enter full Name" required>
    <input type="text" name="phone" class="form-control mt-2" placeholder="Enter Phone no" required>
    <input type="text" name="address" class="form-control mt-2" placeholder="Enter address" required>
    {{-- If you need to pass bill value --}}
    {{-- <input type="hidden" name="bill" value="{{ $total }}"> --}}
     <input type="hidden" name="bill" value="233">
    
    <button type="submit" class="primary-btn mt-2 btn-block">Proceed to Checkout</button>
</form>

                        {{-- <a href="#" class="primary-btn">Proceed to checkout</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <x-footer/>