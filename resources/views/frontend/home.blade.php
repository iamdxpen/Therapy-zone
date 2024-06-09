@extends('Layouts.index')
@section('content')
<section class="mb-lg-40 mb-10 overflow-hidden">
    <div class="py-10 background-no-repeat bg-center bg-cover"
        style="background-image: linear-gradient( rgba(0, 0, 0, 80%) 100%, rgba(0, 0, 0, 50%)100%), url('../frontend/images/banner/spa-banner.webp');--x-h-lg: 80px">
        <div class="container overlap-20">
            <div class="row align-items-center gy-6">
                <div class="col-lg-7">
                    <div class="">
                        <p class="mb-8 text-gray-200">MOST LAXURY IN BANER</p>
                        <h1 class="mb-8 text-light text-main">Therapy Zone</h1>
                        <div>
                            <a class="btn btn-lg btn-light" role="button">Book Appointment</a>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="mx-auto">
                        <div class="swiper swiper-home overflow-visible">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card border-0">
                                        <div class="card-body bg-gray-200">
                                            <h3 class="h4 text-primary">Spa name</h3>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-dark mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 12345 67890</p>
                                            <p> <i class="bi bi-geo-alt-fill text-primary me-2"></i>Call us prior to book
                                                appointment or Walk-In directly to our. Everyone is welcome.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card border-0">
                                        <div class="card-body bg-gray-200">
                                            <h3 class="h4 text-primary">Spa name</h3>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-dark mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 12345 67890</p>
                                            <p> <i class="bi bi-geo-alt-fill text-primary me-2"></i>Call us prior to book
                                                appointment or Walk-In directly to our. Everyone is welcome.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card border-0">
                                        <div class="card-body bg-gray-200">
                                            <h3 class="h4 text-primary">Spa name</h3>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-dark mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 12345 67890</p>
                                            <p> <i class="bi bi-geo-alt-fill text-primary me-2"></i>Call us prior to book
                                                appointment or Walk-In directly to our. Everyone is welcome.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-scrollbar swiper-scrollbar-home me-n6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-lg-6">
                <img width="600" src="{{ asset('frontend/images/home-page/welcome-to-therapy.jpg') }}" alt="
                    Welcome To Therapy Zone In Ahmedabad">
            </div>
            <div class="col-lg-6">
                <h2 class="h1 mb-3">Welcome to Therapy zone</h2>
                <p>Welcome to Therapy Zone in Ahmedabad, your sanctuary for ultimate relaxation and rejuvenation.
                    Immerse yourself in a world of tranquility as our expert therapists pamper you with bespoke
                    treatments designed to soothe your mind, body, and soul. From revitalizing massages to luxurious
                    skincare rituals, we offer a personalized escape from the hustle and bustle of everyday life.
                    Experience a haven of serenity at Therapy Zone, where every visit is a journey to wellness.</p>
            </div>
        </div>
    </div>
</section>
<section class="position-relative py-10 vstack background-no-repeat bg-center bg-cover bg-dark bg-opacity-60 h-lg-calc"
    style="background-image: url('../frontend/images/home-page/experience-spa.jpg');--x-h-lg: 80px">
    <div class="color-tint"></div>
    <div class="container my-lg-auto my-16 position-relative overlap-20">
        <div class="max-w-screen-sm mb-lg-20 mb-8">
            <span class="d-block mb-3 text-gray-400">WHAT ELSE WE DO</span>
            <h2 class="h1 mb-5 text-light">Get An Incredible Experience with Therapy Zone Thai</h2>
            <p class="text-gray-500">There are many variations of passages of Lorem Ipsum available, but the majority
                have suffered alteration in some form, buying to injected humour, or randomised words which don't look
                even many desktop publishing packages.</p>
        </div>
        <div class="row row-cols-lg-4 row-cols-md-2 gy-3 text-gray-500">
            <div>
                <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
                    <li>Aroma Therapy</li>
                    <li>Back Massage</li>
                    <li>Head & Shoulder Massage</li>
                </ul>
            </div>
            <div>
                <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
                    <li>Thai Massage</li>
                    <li>Deep Tissue</li>
                    <li>Body Scrub</li>
                </ul>
            </div>
            <div>
                <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
                    <li>Swedish Massage</li>
                    <li>Couple Massage</li>
                    <li>Body Polish</li>
                </ul>
            </div>
            <div>
                <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
                    <li>Balinese Massage</li>
                    <li>Foot Massage</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@include('frontend.components.company-exp')
<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row gy-6 align-items-center">
            <div class="col-lg-6 order-lg-1 order-2">
                <span class="d-block mb-3">About Us</span>
                <h2 class="h1 mb-5">The Beauty is about being Comfortable in your own skin!</h2>
                <p class="mb-7">There are many variations of passages of Lorem Ipsum available, but the majority have
                    suffered alteration in some form, buying to injected humour, or randomised words which don't look
                    even many desktop publishing packages.</p>
                <div class="row row-cols-sm-3 gy-4">
                    <div>
                        <div class="card">
                            <div class="card-body text-center p-5">
                                <img width="64" class="h-16 object-contain mb-3"
                                    src="{{ asset('frontend/images/icon/beauty-experts.svg') }}" alt="Beauty Experts">
                                <p class="font-semibold text-dark">Beauty<br>
                                    Experts</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body text-center p-5">
                                <img width="64" class="h-16 object-contain mb-3"
                                    src="{{ asset('frontend/images/icon/great-services.svg') }}" alt="Great Services">
                                <p class="font-semibold text-dark">Great<br>
                                    Services</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="card-body text-center p-5">
                                <img width="64" class="h-16 object-contain mb-3"
                                    src="{{ asset('frontend/images/icon/genuine.svg') }}" alt="100 Genuine">
                                <p class="font-semibold text-dark">100%<br>
                                    Genuine</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center order-lg-2 order-1">
                <img width="520" class="" src="{{ asset('frontend/images/home-page/about-us.jpg') }}" alt="about us">
            </div>
        </div>
    </div>
</section>

<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row align-items-center mb-10">
            <div class="col-8">
                <h2 class="h1 font-bolder">Type of Spa</h2>
            </div>
            <div class="col-4 text-end">
                <button type="button" class="btn btn-primary type-of-spa-slider-prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-primary type-of-spa-slider-next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        <div>
        </div>
        <div class="swiper type-of-spa">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card bg-gray-200-hover h-full">
                        <img src="https://images.pexels.com/photos/3757942/pexels-photo-3757942.jpeg"
                            class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
                        <div class="card-body">
                            <!-- <h3 class="font-60 mb-4">1</h3> -->
                            <h4 class="text-primary mb-2">Lorem ipsum dolor</h4>
                            <p><span class="text-primary">Location: </span> Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. At nemo</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card bg-gray-200-hover h-full">
                        <img src="https://images.pexels.com/photos/3212179/pexels-photo-3212179.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
                        <div class="card-body">
                            <!-- <h3 class="font-60 mb-4">2</h3> -->
                            <h4 class="text-primary mb-2">Lorem ipsum dolor</h4>
                            <p><span class="text-primary">Location: </span> Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. At nemo</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card bg-gray-200-hover h-full">
                        <img src="https://images.pexels.com/photos/3738349/pexels-photo-3738349.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
                        <div class="card-body">
                            <!-- <h3 class="font-60 mb-4">3</h3> -->
                            <h4 class="text-primary mb-2">Lorem ipsum dolor</h4>
                            <p><span class="text-primary">Location: </span> Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. At nemo</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card bg-gray-200-hover h-full">
                        <img src="https://images.pexels.com/photos/3738348/pexels-photo-3738348.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
                        <div class="card-body">
                            <!-- <h3 class="font-60 mb-4">3</h3> -->
                            <h4 class="text-primary mb-2">Lorem ipsum dolor</h4>
                            <p><span class="text-primary">Location: </span> Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. At nemo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-gray-200 py-lg-32 py-10">
    <div class="container position-relative">
        <div class="row align-items-center mb-lg-20 mb-10">
            <div class="col-8">
                <h2 class="h1 font-bolder"> What They’re <br>Talking About Us </h2>
            </div>
            <div class="col-4 text-end">
                <button type="button" class="btn btn-primary testimonial-slider-prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-primary testimonial-slider-next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="swiper testimonial-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card h-full">
                        <div class="card-body px-md-6 py-md-6 vstack gap-4 h-full">
                            <img class="img-fluid" loading="lazy" width="70" alt="quote icon"
                                src="{{ asset('frontend/images/icon/qoute.svg') }}">
                            <p class="text-md">“ It is a long established fact that a reader will be tracked
                                distracted by the readable content of a page is when looking at its layout. The point of
                                using Lorem of distribution it look like readable English “</p>
                            <div class="hstack align-items-center mt-auto gap-5">
                                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy"
                                    alt="client_name" src="https://source.unsplash.com/random/80x80">
                                <div class="flex-fill">
                                    <p class="mb-1 text-md font-bold text-dark">James Williams</p>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-full">
                        <div class="card-body px-md-6 py-md-6 vstack gap-4 h-full">
                            <img class="img-fluid" loading="lazy" width="70" alt="quote icon"
                                src="{{ asset('frontend/images/icon/qoute.svg') }}">
                            <p class="text-md">“ It is a long established fact that a reader will be tracked
                                distracted by the readable content of a page is when looking at its layout. The point of
                                using Lorem of distribution it look like readable English “</p>
                            <div class="hstack align-items-center mt-auto gap-5">
                                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy"
                                    alt="client_name" src="https://picsum.photos/80/80">
                                <div class="flex-fill">
                                    <p class="mb-1 text-md font-bold text-dark">test2 Williams</p>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-full">
                        <div class="card-body px-md-6 py-md-6 vstack gap-4 h-full">
                            <img class="img-fluid" loading="lazy" width="70" alt="quote icon"
                                src="{{ asset('frontend/images/icon/qoute.svg') }}">
                            <p class="text-md">“ It is a long established fact that a reader will be tracked
                                distracted by the readable content of a page is when looking at its layout. The point of
                                using Lorem of distribution it look like readable English “</p>
                            <div class="hstack align-items-center mt-auto gap-5">
                                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy"
                                    alt="client_name" src="https://source.unsplash.com/random/80x80">
                                <div class="flex-fill">
                                    <p class="mb-1 text-md font-bold text-dark">test3 Williams</p>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card h-full">
                        <div class="card-body px-md-6 py-md-6 vstack gap-4 h-full">
                            <img class="img-fluid" loading="lazy" width="70" alt="quote icon"
                                src="{{ asset('frontend/images/icon/qoute.svg') }}">
                            <p class="text-md">“ It is a long established fact that a reader will be tracked
                                distracted by the readable content of a page is when looking at its layout. The point of
                                using Lorem of distribution it look like readable English “</p>
                            <div class="hstack align-items-center mt-auto gap-5">
                                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy"
                                    alt="client_name" src="https://source.unsplash.com/random/80x80">
                                <div class="flex-fill">
                                    <p class="mb-1 text-md font-bold text-dark">test3 Williams</p>
                                    <p>United States</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection