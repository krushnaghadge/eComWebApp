<x-header/>



    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6 mx-auto">

                    <h2> Crete New Account</h2>
                    <div class="contact__form">
                     
                            
                 @if (session()->has('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger">
        <p>{{ session('error') }}</p>
    </div>
@endif



                        <form action="{{url('/loginUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="email" required>
                                </div>
                              
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                  
                                    <button type="submit" name="login" class="site-btn">Log In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

   <x-footer/>