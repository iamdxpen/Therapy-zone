<div class="footer-outer">
    <div class="container">
        {{-- <div class="footer-newsletter py-5">
            <div class="group-hd mb-4 text-center">
                <h3>Sign Up For The Latest<br>Updates</h3>
            </div>
            <div class="d-flex signup-form">
                <input type="text" class="form-control" placeholder="Enter Your Email">
                <input type="submit" value="SIGN UP" class="btn btn-primary ms-2">
            </div>
        </div> --}}

        <div class="footer-widget pb-5 py-md-5">
            <div class="fw-card pe-md-3">
                <h4>About Us</h4>
                <p>Where illumination meets elegance, offering a curated collection of lighting solutions to illuminate your space with style.</p>
                <div class="top-logo d-flex mt-4">
                    <a href="{{route('home')}}"><img src="{{asset('front/assets/images/logo.svg')}}" alt="Rubycon electrical & electronic industries" width="100" height="50" loading="lazy"></a>
                    <div class="logo-devider">&nbsp;</div>
                    <a href="{{route('home')}}"><img src="{{asset('front/assets/images/eurolite-logo.svg')}}" alt="Eurolight Lighting and Automation" width="100" height="50" loading="lazy"></a>
                </div>
            </div>

            <div class="fw-card ms-md-auto">
                <h4>Our Services</h4>
                <ul class="fnav">
                    <li><a href="{{route('products', ['used_id' => 'Residential'])}}">Residential</a></li>
                    <li><a href="{{route('products', ['used_id' => 'Industrial'])}}">Industrial</a></li>
                    <li><a href="{{route('products', ['used_id' => 'Commercial'])}}">Commercial</a></li>
                    <li><a href="{{route('products', ['used_id' => 'Retail'])}}">Retail</a></li>
                    <li><a href="{{route('products', ['used_id' => 'Paintbooth'])}}">Paintbooth</a></li>
                </ul>
            </div>

            {{-- <div class="fw-card">
                <h4>Recent Blogs</h4>
                <div class="f-blog">
                    <p><img src="{{asset('front/assets/images/calendar-icon.svg')}}" alt="blog" width="10" height="10" loading="lazy"> January 14, 2023</p>
                    <h5><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</a></h5>
                </div>
                <div class="f-blog">
                    <p><img src="{{asset('front/assets/images/calendar-icon.svg')}}" alt="blog" width="10" height="10" loading="lazy"> January 14, 2023</p>
                    <h5><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</a></h5>
                </div>
            </div> --}}
        </div>
    </div>

    <div class="footer-bootm py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 fb-nav-link text-center text-md-end">
                    {{-- <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a> --}}
                    <a href="{{route('contact-us')}}">Contact Us</a>
                </div>

                <div class="col-md-6">
                    <p class="pb-0 copy-txt">{!! get_reserved_right() !!}</p>
                </div>
                
            </div>
        </div>
    </div>
</div>