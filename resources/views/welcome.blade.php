@extends('layouts.welcome')

@section('content')
<div class="site-blocks-cover" id="home-section" style="overflow: hidden;">
    <div class="container">
        <div class="row align-items-center justify-content-center mt-5 pt-5">
            <div class="col-md-12" style="position: relative;" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('images/landing/undraw_investing_7u74.svg') }}" alt="Image"
                    class="img-fluid img-absolute">
                <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-6 mr-auto">
                        <h1>{{ $company->tagline ?? 'Make Your Business More Profitable' }}</h1>
                        <!-- <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam
                            assumenda ea quo cupiditate facere deleniti fuga officia.</p> -->
                        <div>
                            <a href="#become-reseller" class="btn btn-primary mr-2 mb-2">Become a Reseller</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-image2 overlay" id="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-5">
                <form action="{{ route('reseller.login') }}" method="post" class="p-5 bg-white">
                    @csrf
                    <h2 class="h4 text-black mb-5">Reseller Login Form</h2>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="login-email">Email</label>
                            <input id="login-email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="text-black" for="login-password">Password</label>
                            <input id="login-password" type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Login" class="btn btn-sm btn-block btn-primary rounded-0 mr-2 mb-2">

                            @if (Route::has('reseller.password.request'))
                                <a class="btn btn-link float-right" href="{{ route('reseller.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="site-section" id="features-section">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center" data-aos="fade-up">
            <div class="col-7 text-center  mb-5">
                <h2 class="section-title">Imagine Features</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quos quaerat
                    sapiente nam, id vero.</p>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span class="text-primary icon-autorenew"></span></span>
                    </div>
                    <div>
                        <h3>Marketing Consulting</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span
                                class="text-primary icon-store_mall_directory"></span></span>
                    </div>
                    <div>
                        <h3>Market Analysis</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span class="text-primary icon-shopping_basket"></span></span>
                    </div>
                    <div>
                        <h3>Easy Purchase</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span
                                class="text-primary icon-settings_backup_restore"></span></span>
                    </div>
                    <div>
                        <h3>Free Updates</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span
                                class="text-primary icon-sentiment_satisfied"></span></span>
                    </div>
                    <div>
                        <h3>100% Satistified</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="unit-4 d-block">
                    <div class="unit-4-icon mb-3">
                        <span class="icon-wrap"><span class="text-primary icon-power"></span></span>
                    </div>
                    <div>
                        <h3>Easy Plugin</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae
                            vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="feature-big">
    <div class="container">
        <div class="row mb-5 site-section">
            <div class="col-lg-7" data-aos="fade-right">
                <img src="{{ asset('images/landing/undraw_gift_card_6ekc.svg') }}" alt="Image"
                    class="img-fluid">
            </div>
            <div class="col-lg-5 pl-lg-5 ml-auto mt-md-5">
                <h2 class="text-black">Communicate and gather feedback</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem neque nisi
                    architecto autem molestias corrupti officia veniam.</p>
                <div class="author-box" data-aos="fade-left">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/landing/person_4.webp') }}" alt="Image"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="mr-auto text-black">
                            <strong class="font-weight-bold mb-0">Grey Simpson</strong> <br>
                            Co-Founder, XYZ Inc.
                        </div>
                    </div>
                    <blockquote>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus vitae
                        ipsa asperiores inventore aperiam iure?&rdquo;</blockquote>
                </div>
            </div>
        </div>
        <div class="mt-5 row mb-5 site-section ">
            <div class="col-lg-7 order-1 order-lg-2" data-aos="fade-left">
                <img src="{{ asset('images/landing/undraw_metrics_gtu7.svg') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5 pr-lg-5 mr-auto mt-5 order-2 order-lg-1">
                <h2 class="text-black">Communicate and gather feedback</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem neque nisi
                    architecto autem molestias corrupti officia veniam</p>
                <div class="author-box" data-aos="fade-right">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/landing/person_1.webp') }}" alt="Image"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="mr-auto text-black">
                            <strong class="font-weight-bold mb-0">Kimberly Gush</strong> <br>
                            Co-Founder, XYZ Inc.
                        </div>
                    </div>
                    <blockquote>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus vitae
                        ipsa asperiores inventore aperiam iure?&rdquo;</blockquote>
                </div>
            </div>
        </div>
        <div class="row mb-5 site-section">
            <div class="col-lg-7" data-aos="fade-right">
                <img src="{{ asset('images/landing/undraw_gift_card_6ekc.svg') }}" alt="Image"
                    class="img-fluid">
            </div>
            <div class="col-lg-5 pl-lg-5 ml-auto mt-md-5">
                <h2 class="text-black">Communicate and gather feedback</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem neque nisi
                    architecto autem molestias corrupti officia veniam.</p>
                <div class="author-box" data-aos="fade-left">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/landing/person_4.webp') }}" alt="Image"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="mr-auto text-black">
                            <strong class="font-weight-bold mb-0">Grey Simpson</strong> <br>
                            Co-Founder, XYZ Inc.
                        </div>
                    </div>
                    <blockquote>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus vitae
                        ipsa asperiores inventore aperiam iure?&rdquo;</blockquote>
                </div>
            </div>
        </div>
        <div class="mt-5 row mb-5 site-section ">
            <div class="col-lg-7 order-1 order-lg-2" data-aos="fade-left">
                <img src="{{ asset('images/landing/undraw_metrics_gtu7.svg') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5 pr-lg-5 mr-auto mt-5 order-2 order-lg-1">
                <h2 class="text-black">Communicate and gather feedback</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem neque nisi
                    architecto autem molestias corrupti officia veniam</p>
                <div class="author-box" data-aos="fade-right">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/landing/person_1.webp') }}" alt="Image"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="mr-auto text-black">
                            <strong class="font-weight-bold mb-0">Kimberly Gush</strong> <br>
                            Co-Founder, XYZ Inc.
                        </div>
                    </div>
                    <blockquote>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus vitae
                        ipsa asperiores inventore aperiam iure?&rdquo;</blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section testimonial-wrap bg-light" id="testimonials-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3">Testimonials</h2>
            </div>
        </div>
    </div>
    <div class="slide-one-item home-slider owl-carousel">
        <div>
            <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                    <div><img src="{{ asset('images/landing/person_3.webp') }}" alt="Image"
                            class="w-100 img-fluid mb-3 shadow"></div>
                </figure>
                <blockquote class="mb-3">
                    <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde
                        reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae
                        illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                </blockquote>
                <p class="text-black"><strong>John Smith</strong></p>
            </div>
        </div>
        <div>
            <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                    <div><img src="{{ asset('images/landing/person_2.webp') }}" alt="Image"
                            class="w-100 img-fluid mb-3 shadow"></div>
                </figure>
                <blockquote class="mb-3">
                    <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde
                        reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae
                        illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                </blockquote>
                <p class="text-black"><strong>Robert Aguilar</strong></p>
            </div>
        </div>
        <div>
            <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                    <div><img src="{{ asset('images/landing/person_4.webp') }}" alt="Image"
                            class="w-100 img-fluid mb-3 shadow"></div>
                </figure>
                <blockquote class="mb-3">
                    <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde
                        reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae
                        illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                </blockquote>
                <p class="text-black"><strong>Roger Spears</strong></p>
            </div>
        </div>
        <div>
            <div class="testimonial">
                <figure class="mb-4 d-block align-items-center justify-content-center">
                    <div><img src="{{ asset('images/landing/person_1.webp') }}" alt="Image"
                            class="w-100 img-fluid mb-3 shadow"></div>
                </figure>
                <blockquote class="mb-3">
                    <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde
                        reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae
                        illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                </blockquote>
                <p class="text-black"><strong>Kyle McDonald</strong></p>
            </div>
        </div>
    </div>
</div>
<div class="site-section bg-image2 overlay" id="become-reseller">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title mb-3 text-white">Become a Reseller</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-5">
                <form action="{{ route('reseller.register') }}" method="post" class="p-5 bg-white">
                    @csrf
                    <h2 class="h4 text-black mb-5">Fill Up The Form</h2>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror rounded-0">
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="register-email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="register-email" class="form-control @error('email') is-invalid @enderror rounded-0">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="phone">Phone</label>
                            <input type="phone" name="phone" value="{{ old('phone') }}" id="phone" class="form-control @error('phone') is-invalid @enderror rounded-0">
                            
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="register-password">Password</label>
                            <input type="password" name="password" id="register-password" class="form-control @error('password') is-invalid @enderror rounded-0">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror rounded-0">
                            
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Register" class="btn btn-primary mr-2 mb-2">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection