<div class="header py-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="top-logo d-flex">
                <a href="{{route('home')}}"><img src="{{asset('front/assets/images/logo.svg')}}" alt="Rubycon electrical & electronic industries" width="100" height="50"></a>
                <div class="logo-devider">&nbsp;</div>
                <a href="{{route('home')}}"><img src="{{asset('front/assets/images/eurolite-logo.svg')}}" alt="Eurolight Lighting and Automation" width="100" height="50"></a>
            </div>

            <button id="nav-icon3" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link @if($controller=="HomeController") active @endif" aria-current="page" href="{{route('home')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link @if($controller=="ProductController") active @endif" href="{{route('products')}}">Products</a></li>
                    <li class="nav-item"><a class="nav-link @if($controller=="PageController" && $action == 'automation') active @endif" href="{{route('automation')}}">Automation</a></li>
                    <li class="nav-item"><a class="nav-link @if($controller=="PageController" && $action == 'facilities') active @endif" href="{{route('facilities')}}">Facilities</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#">Blog</a></li> --}}
                    <li class="nav-item"><a class="nav-link @if($controller=="PageController" && $action == 'oems') active @endif" href="{{route('oems')}}">OEMs</a></li>
                    <li class="nav-item"><a class="nav-link @if($controller=="PageController" && $action == 'contactUs') active @endif" href="{{route('contact-us')}}">Contact</a></li>
                    <li class="nav-item d-md-none"><a class="nav-link" aria-current="page" href="{{route('home')}}#getInTouch">Get In Touch</a></li>
                </ul>
            </div>
            <div class="gt-button ms-md-3">
                <a href="{{route('home')}}#getInTouch" class="btn btn-primary">Get In Touch</a>
            </div>
        </nav>
    </div>
</div>