@extends('Layouts.index')
@section('content')
<section class="my-lg-40 my-10">
    <div class="container">
        <div class="row gy-6 align-items-center gx-xl-16 gx-lg-8">
            <div class="col-lg-6 order-lg-1 order-2">
                <span class="d-block mb-2">Our Story</span>
                <h1 class=" mb-5">Therapy Zone</h1>
                <p>Prithivi, Akash, Jal, Agni, Vayu (Earth, Sky, Water, Fire, Air) are the five therapy zone or elements that the universe and the human body is composed of. Ancient eastern philosophy holds that the balance of these five therapy zone or elements in entire universe, including the human body, is the essence of wellness. Balance. That is what therapy zone Spa aims to strive for your mind, body and soul.</p>
            </div>
            <div class="col-lg-6 text-center order-lg-2 order-1">
                <img width="680" class="" src="{{ asset('frontend/images/about-us/about-us.jpg') }}"
                    alt="about-us">
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
            <h2 class="h1 mb-5 text-light">Get An Incredible Spa Experience with Therapy Zone Thai Spa</h2>
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
        <div>
            <span class="d-block mb-3">3 EASY STEPS</span>
            <h2 class="h1 mb-5">How It Works?</h2>
            <p class="mb-7">It seems like you're looking for information or guidance on a spa experience called "Therapy
                Zone Spa" in three easy steps. However, without specific details about what these steps entail, I can
                provide a general outline that might help you create a relaxing spa experience. Here's a suggestion:</p>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 gy-6 justify-content-center">
            <div>
                <div class="card bg-gray-200-hover h-full">
                    <div class="card-body">
                        <h3 class="font-60 mb-4">1</h3>
                        <h4 class="h2 text-primary mb-4">Book Appointment</h4>
                        <p>Call us prior to book appointment or Walk-In directly to our spa. Everyone is welcome.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card bg-gray-200-hover h-full">
                    <div class="card-body">
                        <h3 class="font-60 mb-4">2</h3>
                        <h4 class="h2 text-primary mb-4">Get Treatment</h4>
                        <p>Select treatment of your choice & our well trained therapists will take care of the rest.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card bg-gray-200-hover h-full">
                    <div class="card-body">
                        <h3 class="font-60 mb-4">3</h3>
                        <h4 class="h2 text-primary mb-4">Feel Relaxed</h4>
                        <p>Guaranteed you will leave our spa feeling relaxed, rejuvenated, energized and stress free.
                        </p>
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