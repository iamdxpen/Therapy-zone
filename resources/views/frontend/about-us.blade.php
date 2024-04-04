@extends('Layouts.index')
@section('content')
<section class="my-lg-40 my-10">
    <div class="container">
        <div class="row gy-6 align-items-center gx-xl-16 gx-lg-8">
            <div class="col-lg-6 order-lg-1 order-2">
                <span class="d-block mb-2">Our Story</span>
                <h1 class=" mb-5">Therapy Zone</h1>
                <p>Prithivi, Akash, Jal, Agni, Vayu (Earth, Sky, Water, Fire, Air) are the five therapy zone or elements
                    that the universe and the human body is composed of. Ancient eastern philosophy holds that the
                    balance of these five therapy zone or elements in entire universe, including the human body, is the
                    essence of wellness. Balance. That is what therapy zone Spa aims to strive for your mind, body and
                    soul.</p>
            </div>
            <div class="col-lg-6 text-center order-lg-2 order-1">
                <img width="680" class="" src="{{ asset('frontend/images/about-us/about-us.jpg') }}" alt="about-us">
            </div>
        </div>
    </div>
</section>
<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row gy-6 align-items-center gx-xl-16 gx-lg-8">
            <div class="col-lg-6 text-center">
                <img width="680" class="" src="{{ asset('frontend/images/about-us/spa-location.jpg') }}" alt="about-us">
            </div>
            <div class="col-lg-6">
                <span class="d-block mb-2">Our Location</span>
                <h2 class="h1 mb-5">SPA LOCATIONS</h2>
                <p>Since opening that first spa in 2018 in the quaint ahmedabad, we have come a long way with our Spas
                    now located across 70+ locations. Whether it be a spa located in the heart of the city or our Spa
                    located in idyllic resort spa destinations, you can be assured of the warm hospitality and
                    professional nature of services. Magnificently accoutred, therapy zone Spa spaces evokes the
                    feelings of tranquillity, balance, and serenity in the consumer by using elements from nature,
                    beautiful landscapes, that and a pastel soothing colour pallette.</p>
            </div>

        </div>
    </div>
</section>
@include('frontend.components.company-exp')
@include('frontend.components.book-now')

@endsection