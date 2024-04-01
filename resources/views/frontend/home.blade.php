@extends('Layouts.index')
@section('content')
<section
    class="position-relative mb-lg-40 mb-10 py-10 vstack background-no-repeat bg-center bg-cover bg-dark bg-opacity-80 h-lg-calc"
    style="background-image: url('../frontend/images/banner/spa-banner.webp');--x-h-lg: 80px">
    <div class="color-tint"></div>
    <div class="container my-lg-auto my-16 text-center position-relative overlap-20">
        <p class="mb-8 text-gray-200">MOST LAXURY SPA IN BANER</p>
        <h1 class="mb-8 text-light text-main">Therapy Zone Spa</h1>
        <a class="btn btn-lg btn-dark" role="button">BOOK Appointment</a>
    </div>
</section>
<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-lg-6">
                <img width="600" src="{{ asset('frontend/images/home-page/welcome-to-therapy.jpg') }}" alt="
                    Welcome To Therapy Zone Spa In Ahmedabad">
            </div>
            <div class="col-lg-6">
                <h2 class="h1 mb-3">Welcome To
                    Therapy Zone Spa
                    In Ahmedabad</h2>
                <p>Welcome to Therapy Zone Spa in Ahmedabad, your sanctuary for ultimate relaxation and rejuvenation.
                    Immerse yourself in a world of tranquility as our expert therapists pamper you with bespoke
                    treatments designed to soothe your mind, body, and soul. From revitalizing massages to luxurious
                    skincare rituals, we offer a personalized escape from the hustle and bustle of everyday life.
                    Experience a haven of serenity at Therapy Zone Spa, where every visit is a journey to wellness.</p>
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
<section class="mb-lg-40 mb-10 bg-gray-200 py-lg-20 py-14">
    <div class="container">
        <div class="row row-cols-lg-4 row-cols-sm-2 align-items-center gy-12">
            <div>
                <div class="hstack gap-4">
                    <img width="64" class="h-16 object-contain"
                        src="{{ asset('frontend/images/icon/years-experience.svg') }}" alt="Years Experience">
                    <div>
                        <h2 class="font-60 text-primary-hover">6</h2>
                        <p>Years Experience</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="hstack gap-4">
                    <img width="64" class="h-16 object-contain" src="{{ asset('frontend/images/icon/therapists.svg') }}"
                        alt="Therapists">
                    <div>
                        <h2 class="font-60 text-primary-hover">6</h2>
                        <p>Therapists</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="hstack gap-4">
                    <img width="64" class="h-16 object-contain"
                        src="{{ asset('frontend/images/icon/spa-treatments.svg') }}" alt="Spa Treatments">
                    <div>
                        <h2 class="font-60 text-primary-hover">16</h2>
                        <p>Spa Treatments</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="hstack gap-4">
                    <img width="64" class="h-16 object-contain"
                        src="{{ asset('frontend/images/icon/happy-clients.svg') }}" alt="Happy Clients">
                    <div>
                        <h2 class="font-60 text-primary-hover">123</h2>
                        <p>Happy Clients</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <span class="d-block mb-3">WHAT ELSE WE DO</span>
                <h2 class="h1 mb-5">Get An Incredible Spa Experience with Therapy Zone Thai Spa</h2>
                <p class="">There are many variations of passages of Lorem Ipsum available, but the
                    majority
                    have suffered alteration in some form, buying to injected humour, or randomised words which don't
                    look
                    even many desktop publishing packages.</p>
            </div>
        </div>
    </div>
</section>
@endsection