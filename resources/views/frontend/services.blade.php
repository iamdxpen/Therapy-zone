@extends('Layouts.index')
@section('content')
<section class="position-relative mb-lg-40 mb-10 py-18 py-lg-40 vstack background-no-repeat bg-center bg-cover"
    style="background-image: url('../frontend/images/services/banner-1.jpg');">
    <div class="color-tint"></div>
    <div class="container my-lg-auto my-16 text-center position-relative overlap-20">
        <div class="max-w-screen-md mx-auto">
            <h1 class="mb-8 text-primary text-main">Our Services</h1>
            <p class="text-gray-200">Therapy zone offers a holistic range of beauty and spa services ranging from
                massages,
                facials, body scrubs,
                body wraps, manicures, pedicures, hair spa and luxurious wellness retreats.</p>
        </div>
    </div>
</section>
<section class="mb-lg-40 mb-10">
    <div class="container">
        <div class="row row-cols-lg-3 row-cols-md-2 gy-8">
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/deep-tissue.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">Deep Tissue</h3>
                <p>It is quite a strong massage for people who do a lot of physical work, exercise & athletes.</p>
            </div>
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/swedish-massage.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">Swedish Massage</h3>
                <p>It consists mainly of long strokes over oiled skin and kneading of the outer layers of muscle tissue.
                </p>
            </div>
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/balinese-massage.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">Balinese Massage</h3>
                <p>Includes acupressure, firm & gentle stroking, percussion, & application of essential oils.</p>
            </div>
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/spa-locations.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">SPA LOCATIONS</h3>
                <p>Includes pressure points, muscle stretching & compression in a rhythmic motion.</p>
            </div>
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/aroma-therapy.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">Aroma Therapy</h3>
                <p>Essential oils & aroma compounds is used for improving mental or physical well-being.</p>
            </div>
            <div>
                <img width="430" class="mb-4" src="{{ asset('frontend/images/services/couple-massage.jpg') }}"
                    alt="about-us">
                <h3 class="text-primary mb-2">Couple Massage</h3>
                <p>It allows two people to have a shared experience that can result in a closer bond.</p>
            </div>
        </div>
    </div>
</section>
@include('frontend.components.book-now')
@endsection