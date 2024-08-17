@extends('Layouts.index')
@section('content')
<section class="d-flex align-items-center py-20 overflow-hidden background-no-repeat bg-center bg-cover h-lg-calc" style="background-image: linear-gradient( rgba(0, 0, 0, 80%) 100%, rgba(0, 0, 0, 50%)100%), url('../frontend/images/banner/spa-banner.webp');--x-h-lg: 80px">
  <div class="container overlap-20 vstack">
    <div class="my-auto mx-auto text-center">
      <p class="mb-2 text-gray-200">MOST LAXURY IN BANER</p>
      <h1 class="mb-8 text-light text-main">Therapy Zone</h1>
      <button type="button" class="btn btn-lg btn-light mb-6" data-bs-toggle="modal" data-bs-target="#exampleModal"> Book Appointment </button>
    </div>
    <div class="mt-auto">
      <div class="swiper testimonial-slider">
        <div class="swiper-wrapper">
          @foreach($spaObj as $spa)
          <div class="swiper-slide">
            <div class="card border border-4 border-light border-primary-hover h-full">
              <div class="card-body" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <h3 class="text-primary-hover stretched-link mb-4">{{ $spa->title }}</h3>
                <p class="text-dark mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i>+91 {{ $spa->mobile }}</p>
                <p><i class="bi bi-geo-alt-fill text-primary me-2"></i>{{ $spa->address }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<section class="bg-gray-200 py-lg-20 py-10 mb-lg-20 mb-10">
  <div class="container position-relative">
    <div class="row align-items-center mb-10">
      <div class="col-8">
        <h2 class="h1 font-bolder"> Packages <br>
        </h2>
      </div>
    </div>
    <div class="swiper testimonial-slider">
      <div class="swiper-wrapper">
        @foreach($packageObj as $pack)
        <div class="swiper-slide">
          <div class="card">
            <div class="card-body" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <h3>{{ $pack->title }}</h3>
              <p class="text-dark mb-2">Price:- {{ $pack->price }}</p>
              <p> {{ $pack->content }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<section class="mb-lg-20 mb-10">
  <div class="container">
    <div class="row align-items-center ">
      <div class="col-lg-6">
        <img width="600" src="{{ asset('frontend/images/home-page/welcome-to-therapy.jpg') }}" alt="Welcome To Therapy Zone In Ahmedabad">
      </div>
      <div class="col-lg-6">
        <h2 class="h1 mb-3">Welcome to Therapy zone</h2>
        <p>Welcome to Therapy Zone in Ahmedabad, your sanctuary for ultimate relaxation and rejuvenation. Immerse yourself in a world of tranquility as our expert therapists pamper you with bespoke treatments designed to soothe your mind, body, and soul. From revitalizing massages to luxurious skincare rituals, we offer a personalized escape from the hustle and bustle of everyday life. Experience a haven of serenity at Therapy Zone, where every visit is a journey to wellness.</p>
      </div>
    </div>
  </div>
</section>
<section class="position-relative py-10 vstack background-no-repeat bg-center bg-cover bg-dark bg-opacity-60 h-lg-calc mb-lg-20 mb-10" style="background-image: url('../frontend/images/home-page/experience-spa.jpg');--x-h-lg: 80px">
  <div class="color-tint"></div>
  <div class="container my-lg-auto my-16 position-relative overlap-20">
    <div class="max-w-screen-sm mb-lg-20 mb-8">
      <span class="d-block mb-3 text-gray-400">WHAT ELSE WE DO</span>
      <h2 class="h1 mb-5 text-light">Get An Incredible Experience with Therapy Zone Thai</h2>
      <p class="text-gray-500">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, buying to injected humour, or randomised words which don't look even many desktop publishing packages,All message will be of 60 minutes duration.</p>
    </div>
    <div class="row row-cols-lg-4 row-cols-md-2 gy-3 text-gray-500">
      <div>
        <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
          <li class="text-light">Head & Shoulder Massage</li>
          <li class="text-light">Foot Massage</li>
          <li class="text-light">Relax Massage</li>
          <li class="text-light">OIL Massage</li>
        </ul>
      </div>
      <div>
        <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
          <li class="text-light">Aroma Massage</li>
          <li class="text-light">Deep Tissue Massage</li>
          <li class="text-light">LOMI LOMI Massage</li>
          <li class="text-light">Thai Massage</li>
        </ul>
      </div>
      <div>
        <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
          <li class="text-light">Swedish Massage</li>
          <li class="text-light">Balinese Massage</li>
          <li class="text-light">Back Massage</li>
          <li class="text-light">Body Polish</li>
        </ul>
      </div>
      <div>
        <ul class="list-check-1 list-unstyled vstack gap-3 mb-0">
          <li class="text-light">Cream Massage (Full Body)</li>
          <li class="text-light">Gel Massage (Full Body)</li>
          <li class="text-light">Scrub Massage (Full Body)</li>
          <li class="text-light">hammam Massage </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- @include('frontend.components.company-exp') -->
<section class="mb-lg-20 mb-10">
  <div class="container">
    <div class="row gy-6 align-items-center">
      <div class="col-lg-6 order-lg-1 order-2">
        <span class="d-block mb-3">About Us</span>
        <h2 class="h1 mb-5">The Beauty is about being Comfortable in your own skin!</h2>
        <p class="mb-7">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, buying to injected humour, or randomised words which don't look even many desktop publishing packages.</p>
        <div class="row row-cols-sm-3 gy-4">
          <div>
            <div class="card">
              <div class="card-body text-center p-5">
                <img width="64" class="h-16 object-contain mb-3" src="{{ asset('frontend/images/icon/beauty-experts.svg') }}" alt="Beauty Experts">
                <p class="font-semibold text-dark">Beauty <br> Experts </p>
              </div>
            </div>
          </div>
          <div>
            <div class="card">
              <div class="card-body text-center p-5">
                <img width="64" class="h-16 object-contain mb-3" src="{{ asset('frontend/images/icon/great-services.svg') }}" alt="Great Services">
                <p class="font-semibold text-dark">Great <br> Services </p>
              </div>
            </div>
          </div>
          <div>
            <div class="card">
              <div class="card-body text-center p-5">
                <img width="64" class="h-16 object-contain mb-3" src="{{ asset('frontend/images/icon/genuine.svg') }}" alt="100 Genuine">
                <p class="font-semibold text-dark">100% <br> Genuine </p>
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
<section class="mb-lg-20 mb-10">
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
    <div></div>
    <div class="swiper type-of-spa">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://naturatermospa.com/wp-content/uploads/2019/10/image-42.jpeg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Head & Shoulder Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://cdn-prod.medicalnewstoday.com/content/images/articles/323/323790/foot-massage-finishing-strokes.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Foot Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://www.goodnet.org/photos/620x0/28755_hd.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Relax Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://swastha.life/wp-content/uploads/2020/10/oil-massage.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>OIL Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://www.juaraskincare.com/cdn/shop/articles/what-is-aromatherapy-massage.jpg?v=1711678233" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Aroma Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://propelphysiotherapy.com/wp-content/uploads/2023/08/what-is-deep-tissue-massage-therapy-propel-physiotherapy-1200x675.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Deep Tissue Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://banyanmarbella.com/wp-content/uploads/2024/04/4238.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>LOMI LOMI Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://letsrelaxspa.com/wp-content/uploads/2022/09/spa-massage-thai-healing-relaxation.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Thai Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://spalavish.in/wp-content/uploads/2024/01/swedishcover11657021031.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Swedish Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://productimages.withfloats.com/tile/5cb4c5e7873cd6000184e70d.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Balinese Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://cdn.spafinder.com/2016/10/back-massage.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Back Massage</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://www.bodycraft.co.in/wp-content/uploads/side-view-woman-getting-massaged-spa-1.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Body Polish</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://media.vyaparify.com/vcards/services/29542/Cinnamon-3-in-1-Body-Massage-Cream-model.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Cream Massage (Full Body)</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://siamesemassagebangkok.com/wp-content/uploads/2022/10/aloe-vera-gel-massage-1024x731.webp" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Gel Massage (Full Body)</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://myskinph.com/wp-content/uploads/2021/12/Benefits-of-Body-Scrub-Massage.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>Scrub Massage (Full Body)</h4>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="card bg-gray-200 h-full">
            <img src="https://greendayspa.in/wp-content/uploads/2017/11/Hammam-Bath.jpg" class="card-img-top h-72 object-fit-cover" width="423" height="288" alt="...">
            <div class="card-body">
              <h4>hammam Massage</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="bg-gray-200 py-lg-20 py-10">
  <div class="container position-relative">
    <div class="row align-items-center mb-10">
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
              <img class="img-fluid" loading="lazy" width="70" alt="quote icon" src="{{ asset('frontend/images/icon/qoute.svg') }}">
              <p class="text-md">“ It is a long established fact that a reader will be tracked distracted by the readable content of a</p>
              <div class="hstack align-items-center mt-auto gap-5">
                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy" alt="client_name" src="https://source.unsplash.com/random/80x80">
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
              <img class="img-fluid" loading="lazy" width="70" alt="quote icon" src="{{ asset('frontend/images/icon/qoute.svg') }}">
              <p class="text-md">“ It is a long established fact that a reader will be tracked distracted by the readable content of a page is when looking at its layout. The point of using Lorem of distribution it look like readable English “</p>
              <div class="hstack align-items-center mt-auto gap-5">
                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy" alt="client_name" src="https://picsum.photos/80/80">
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
              <img class="img-fluid" loading="lazy" width="70" alt="quote icon" src="{{ asset('frontend/images/icon/qoute.svg') }}">
              <p class="text-md">“ It is a long established fact that a reader will be tracked distracted by the readable content of a page is when looking at its layout. The point of using Lorem of distribution it look like readable English “</p>
              <div class="hstack align-items-center mt-auto gap-5">
                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy" alt="client_name" src="https://source.unsplash.com/random/80x80">
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
              <img class="img-fluid" loading="lazy" width="70" alt="quote icon" src="{{ asset('frontend/images/icon/qoute.svg') }}">
              <p class="text-md">“ It is a long established fact that a reader will be tracked distracted by the readable content of a page is when looking at its layout. The point of using Lorem of distribution it look like readable English “</p>
              <div class="hstack align-items-center mt-auto gap-5">
                <img class="img-fluid avatar w-20 h-20 object-contain rounded-circle" loading="lazy" alt="client_name" src="https://source.unsplash.com/random/80x80">
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