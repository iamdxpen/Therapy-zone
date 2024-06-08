<header class="sticky-top backdrop-blur-5 bg-light bg-opacity-80 border-bottom">
    <div class="container">
        <nav class="tv-header navbar navbar-expand-lg py-3 px-0">
            <a class="navbar-brand py-0" href="#">
                <!-- Regular Logo -->
                <img src="{{ asset('frontend/images/logo/logo.svg') }}" alt="therapy zone" width="205">
            </a>
            <button class="navbar-toggler menu-toggle" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span></span>
            </button>
            <div class="collapse navbar-collapse custome-collapse gap-6" id="navbarMenu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link py-xl-2 px-3" href="{{route('home')}}"><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-xl-2 px-3" href="{{route('about-us')}}"><span>About
                                Us</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-xl-2 px-3" href="{{route('services')}}"><span>Services</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-xl-2 px-3" href="#"><span>Contact
                                Us</span></a>
                    </li>
                </ul>
                <button type="button" class="btn btn-sm btn-dark px-6" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   Book now
                </button>
                    
            </div>
        </nav>
    </div>
</header>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="" id="exampleModalLabel">Book Now</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row gy-6 align-items-center">
                                    <div class="col-lg-6">
                                        <img
                                            src="{{ asset('frontend/images/google-pay.jpg') }}"
                                            class=""
                                            alt="google pay QR"
                                        />
                                        
                                    </div>
                                    <div class="col-lg-6">
                                       <form action="">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Name</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name=""
                                                    id=""
                                                    placeholder="Enter your name"
                                                />
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Email</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    name=""
                                                    id=""
                                                    aria-describedby="emailHelpId"
                                                    placeholder="Enter your Email Address"
                                                />
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Mobile Number</label>
                                                <input
                                                    type="Number"
                                                    class="form-control"
                                                    name=""
                                                    id=""
                                                    aria-describedby="emailHelpId"
                                                    placeholder="Enter your mobile number"
                                                />
                                            </div>
                                            <label for="" class="form-label">Sent Screen short</label>
                                                <label for="sent-img" class="border border-dashed border-2 border-cyan bg-white py-3 px-6 rounded-4 text-black hstack justify-content-center w-full">
                                                <img src="{{ asset('frontend/images/file.svg') }}" width="35" alt="Attach the Resume" class="img-fluid me-3">
                                                <span id="sent-img-preview">Attach the Shreen short*</span>
                                                </label>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>