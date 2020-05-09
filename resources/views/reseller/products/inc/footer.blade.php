<footer class="footer">
    <div class="container">
        <div class="footer-top p-tb-50 clearfix">
            <div class="row">
                <div class="col-md-4">
                    <a href="https://fleetcart.envaysoft.com/en" class="footer-logo">
                        <img src="{{ asset($logo->footer ?? $logo->color) ?? '' }}"
                            class="img-responsive" alt="footer-logo">
                    </a>

                    <div class="clearfix"></div>

                    <p class="footer-brief"></p>

                    <div class="contact">
                        <ul class="list-inline">
                            <li>
                                <i class="fa fa-phone-square" aria-hidden="true"></i>
                                <span class="contact-info">{{ $contact->phone ?? '' }}</span>
                            </li>

                            <li>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <span class="contact-info">{{ $company->email ?? '' }}</span>
                            </li>

                            <li>
                                <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                <span class="contact-info">{{ $company->address ?? '' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="links">
                                <div class="mobile-collapse">
                                    <h4>My Account</h4>
                                </div>

                                <ul class="list-inline">
                                    <li><a href="{{ route('reseller.home') }}">Dashboard</a>
                                    </li>
                                    <li><a href="{{ route('reseller.order.index') }}">My
                                            Orders</a></li>
                                    <li><a href="{{ route('reseller.profile.show', auth('reseller')->user()->id) }}">My
                                            Profile</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="links">
                                <div class="mobile-collapse">
                                    <h4>Popular Categories</h4>
                                </div>

                                <ul class="list-inline">
                                    <li><a href="http://fleetcart.envaysoft.com/en/products?category=laptops"
                                            target="_self">Laptops</a></li>
                                    <li><a href="http://fleetcart.envaysoft.com/en/products?category=mobiles"
                                            target="_self">Mobiles</a></li>
                                    <li><a href="http://fleetcart.envaysoft.com/en/products?category=desktops"
                                            target="_self">Desktops</a></li>
                                    <li><a href="http://localhost/en/fleetcart11/en/products?category=t-shirts"
                                            target="_self">T-shirts</a></li>
                                    <li><a href="http://fleetcart.envaysoft.com/en/products?category=backpacks"
                                            target="_self">Backpacks</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-middle p-tb-30 clearfix">
            {!! iconMenu('iconsocial') !!}
            <!-- <ul class="social-links list-inline">
                <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            </ul> -->
        </div>
    </div>

    <div class="footer-bottom p-tb-20 clearfix">
        <div class="container">
            <div class="copyright text-center">
                Copyright © <a href="https://fleetcart.envaysoft.com/en"> FleetCart </a> 2020. All rights
                reserved.
            </div>
        </div>
    </div>
</footer>