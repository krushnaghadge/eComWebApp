<x-header/>



    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6 mx-auto">

                    <h2> Crete New Account</h2>
                    <div class="contact__form">
                           {{-- @if (@section()->has('sucess'))
                            <div class="alert alert-sucess">
                                <p>{{session()->get('sucess')
                                    
                                }}</p>
                            </div>
                        @endif --}}
                        {{-- <form action="{{url('/registerUser')}}" method="POST" enctype="multipart/form-data"> --}}
                        <form action="{{ url('/registerUser') }}" method="POST" enctype="multipart/form-data">
  
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" placeholder="fullname" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email"  name="email" placeholder="email" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="file" name="file" required>

                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                                <div class="col-lg-12">
                                  
                                    <button type="submit" name="register" class="site-btn">Sign Up /register</button>
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