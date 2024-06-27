@php
    // $properties = [
    //     [
    //         'slug' => 'property-1',
    //         'photo' => 'frontend/assets/images/detail-1.jpg',
    //         'category' => 'Boarding house aa',
    //         'price' => 250000,
    //         'name' => 'Women',
    //         'address' => '1 room',
    //     ],
    //     [
    //         'slug' => 'property-2',
    //         'photo' => 'frontend/assets/images/detail-2.jpg',
    //         'category' => 'Boarding house ab',
    //         'price' => 250000,
    //         'name' => 'Man',
    //         'address' => '3 room',
    //     ],
    //     [
    //         'slug' => 'property-3',
    //         'photo' => 'frontend/assets/images/detail-3.jpg',
    //         'category' => 'Boarding house ac',
    //         'price' => 250000,
    //         'name' => 'Mixed',
    //         'address' => '6 room',
    //     ],
    // ];

    // Mengelompokkan kosts berdasarkan brand_name
    $groupedKosts = $kosts->groupBy(function ($item) {
        return $item->admin->brand_name;
    });
@endphp

@extends('layouts.frontend')

@section('header')
    <header class="header" id="header">
        <nav class="nav container">
            <div class="nav__logo">
                <a href="{{ route('homepage') }}">Pakom<span>kost</span> <i class="bx bxs-home-heart"></i>
                </a>
            </div>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link"> Home </a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link"> About </a>
                    </li>
                    <li class="nav__item">
                        <a href="#blog" class="nav__link"> Blog </a>
                    </li>
                    <li class="nav__item">
                        <a href="#contact" class="nav__link"> Contact </a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log in
                            </a>

                            {{-- @if (Route::has('register'))
                                <div class="relative">
                                    <a href="#" id="register-link"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                    <div id="register-dropdown" class="absolute hidden bg-white shadow-lg rounded-md mt-2">
                                        <a href="{{ route('register.user') }}"
                                            class="block px-4 py-2 text-black hover:bg-gray-100">Pencari Kos</a>
                                        <a href="{{ route('register.admin') }}"
                                            class="block px-4 py-2 text-black hover:bg-gray-100">Pemilik Kos</a>
                                    </div>
                                </div>
                            @endif --}}

                            @if (Route::has('register'))
                                <div class="relative">
                                    <a href="#" id="register-link"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                    <div id="register-dropdown" class="absolute hidden bg-white shadow-lg rounded-md mt-2">
                                        <a href="{{ route('register.user') }}"
                                            class="block px-4 py-2 text-black hover:bg-gray-100">Pencari Kos</a>
                                        <a href="{{ route('register.admin') }}"
                                            class="block px-4 py-2 text-black hover:bg-gray-100">Pemilik Kos</a>
                                    </div>
                                </div>
                            @endif

                        @endauth
                    @endif

                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
            <div class="nav__toggle" id="nav-toggle">
                <i class="bx bx-menu"></i>
            </div>
        </nav>
    </header>
@endsection

@section('content')
    <section class="home section" id="home">
        <div class="home__container container grid">
            <div class="home__data">
                <h1 class="home__title">Helping people get their dream home</h1>
                <p class="home__description">
                    Find a different of home that comportable for you
                    <br class="home__br" />
                    forget the hard thing about finding great home
                </p>

                @if (session()->has('message'))
                    <div class="alert"
                        style="text-align: center;position: relative;margin-bottom: .5rem;padding: .5rem;border-radius: .25rem;background-color: lightgreen;color: green;"
                        class="alert">
                        {{ session()->get('message') }}
                        <i id="hide"
                            style="font-size: 1.5rem;cursor: pointer;position: absolute;top: .25rem;right: .25rem;"
                            class='bx bx-x'></i>
                    </div>
                @endif

                {{-- <form action="{{ route('subscribers.store') }}" method="post" class="home__search">
                    @csrf
                    <input type="search" placeholder="Enter your email..." class="home__search-input" name="email"
                        value="{{ old('email') }}" />
                    <button type="submit" class="button">Subscribe</button>
                </form> --}}
            </div>
            <div class="home__images">
                <div class="home__orbe"></div>

                <div class="home__img">
                    <img src="{{ asset('frontend/assets/images/home.jpg') }}" alt="" />
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="section" id="popular">
        <div class="container">
            <span class="section__subtitle">Explore Brand</span>
            <h2 class="section__title">Explore brand<span>.</span></h2>

            <div class="popular__container grid">
                {{-- @foreach ($categories as $category)
                    <article class="popular__card">
                        <img src="{{ Storage::url($category->banner) }}" alt="" class="popular__img" />
                        <div class="popular__data">
                            <h3 class="popular__title">{{ $category->name }}</h3>
                            <span class="popular__description"> {{ $category->properties->count() }} Properties </span>
                        </div>
                    </article>
                @endforeach
                @foreach ($brands as $brand)
                    <article class="property__card">
                        <a href="/detail">
                            <div class="property__images">
                                <img src="{{ asset($brand['photo']) }}" alt="" class="property__img" />
                                <span class="property__badge">{{ $brand['category'] }} </span>
                            </div>
                            <div class="property__data">
                                <h2 class="property__price"><span>RP.
                                    </span>{{ number_format($brand['price']) }}<span>/month</span></h2>
                                <h3 class="property__title">{{ $brand['name'] }}</h3>
                                <span class="property__description">{{ $brand['address'] }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section> --}}

    {{-- <section class="section" id="popular">
        <div class="container">
            <span class="section__subtitle">Daftar Kost</span>
            <h2 class="section__title">Daftar Kost<span>.</span></h2>

            <div class="popular__container grid">
                @foreach ($kosts as $kost)
                    <article class="property__card">
                        <a href="{{ route('detail', Str::slug($kost->name_kost)) }}">
                            <div class="property__images">
                                @php
                                    $mediaFiles = explode(',', $kost->media);
                                @endphp

                                @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                                    <img src="{{ asset($mediaFiles[0]) }}" alt="{{ $kost->name_kost }}"
                                        class="property__img" />
                                @else
                                    <img src="{{ asset('placeholder.jpg') }}" alt="No Kost Image" class="property__img" />
                                @endif
                                <span class="property__badge">{{ $kost->kost_type }}</span>
                            </div>
                            <div class="property__data">
                                {{-- <h2 class="property__price"><span>RP. --}}
    {{-- </span>{{ number_format($kost->price) }}<span>/month</span></h2>
                                <h3 class="property__title">{{ $kost->name_kost }}</h3>
                                <span class="property__description">{{ $kost->admin->brand_name }}</span>
                                <span class="property__description">{{ $kost->location }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section> --}}

    {{-- @section --}}
    {{-- <section class="section" id="popular">
        <div class="container">
            {{-- <span class="section__subtitle">Daftar Kost</span>
            <h2 class="section__title">Daftar Kost<span>.</span></h2>

            @foreach ($groupedKosts as $brandName => $brandKosts)
                <div class="brand-section">
                    <h2 class="brand__title">{{ $brandName }}<span>:</span></h2>
                    <div class="popular__container grid">
                        @foreach ($brandKosts as $kost)
                            <article class="property__card">
                                <a href="{{ route('detail', Str::slug($kost->name_kost)) }}">
                                    <div class="property__images">
                                        @php
                                            $mediaFiles = explode(',', $kost->media);
                                        @endphp

                                        @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                                            <img src="{{ asset($mediaFiles[0]) }}" alt="{{ $kost->name_kost }}"
                                                class="property__img" />
                                        @else
                                            <img src="{{ asset('placeholder.jpg') }}" alt="No Kost Image"
                                                class="property__img" />
                                        @endif
                                        <span class="property__badge">{{ $kost->kost_type }}</span>
                                    </div>
                                    <div class="property__data">
                                        <h3 class="property__title">{{ $kost->name_kost }}</h3>
                                        <span class="property__description">{{ $kost->admin->brand_name }}</span>
                                        <span class="property__description">{{ $kost->location }}</span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="brand-section">
                    <h2 class="brand__title">Lokasi Kost {{$brandName}}:</h2>
                </div>
                <!-- Map container for each brand -->
                <div id="map-{{ Str::slug($brandName) }}" style="height: 400px;"></div>
        </div>
        @endforeach
        </div>
    </section> --}}
    <section class="section" id="popular">
        <div class="container">
            {{-- <span class="section__subtitle">Daftar Kost</span> --}}
            <h2 class="section__title">Daftar Kost<span>.</span></h2>

            @foreach ($groupedKosts as $brandName => $brandKosts)
                <div class="brand-section">
                    <h2 class="brand__title">{{ $brandName }}<span>:</span></h2>
                    <div class="popular__container grid">
                        @foreach ($brandKosts as $kost)
                            <article class="property__card">
                                <a href="{{ route('detail', Str::slug($kost->name_kost)) }}">
                                    <div class="property__images">
                                        @php
                                            $mediaFiles = explode(',', $kost->media);
                                        @endphp

                                        @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                                            <img src="{{ asset($mediaFiles[0]) }}" alt="{{ $kost->name_kost }}"
                                                class="property__img" />
                                        @else
                                            <img src="{{ asset('placeholder.jpg') }}" alt="No Kost Image"
                                                class="property__img" />
                                        @endif
                                        <span class="property__badge">{{ $kost->kost_type }}</span>
                                    </div>
                                    <div class="property__data">
                                        <h3 class="property__title">{{ $kost->name_kost }}</h3>
                                        <span class="property__description">{{ $kost->admin->brand_name }}</span>
                                        <span class="property__description">{{ $kost->location }}</span>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                    <div class="brand-section">
                        <h2 class="brand__title">Lokasi Kost {{ $brandName }}:</h2>
                    </div>
                    <!-- Map container for each brand -->
                    <div id="map-{{ Str::slug($brandName) }}" style="height: 400px;"></div>
                    @if (!$loop->last)
                        <div class="mb-5"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    {{-- @endsection --}}

    {{-- <section class="section" id="property">
        <div class="container">
            <span class="section__subtitle">Best Choice</span>
            <h2 class="section__title">Popular boarding house<span>.</span></h2>

            <div class="property__container grid">
                @foreach ($properties as $property)
                    <article class="property__card">
                        <a href="{{ route('detail', $property->slug) }}">
                            <div class="property__images">
                                <img src="{{ Storage::url($property->galleries()->first()->photo) }}" alt=""
                                    class="property__img" />
                                <span class="property__badge">{{ $property->category->name }} </span>
                            </div>
                            <div class="property__data">
                                <h2 class="property__price"><span>$</span>{{ $property->price }}</h2>
                                <h3 class="property__title">{{ $property->name }}</h3>
                                <span class="property__description">
                                    {{ $property->address }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
                @foreach ($properties as $property)
                    <article class="property__card">
                        <a href="{{ route('detail', $property['slug']) }}">
                        <a href="/detail">
                            <div class="property__images">
                                <img src="{{ asset($property['photo']) }}" alt="" class="property__img" />
                                <span class="property__badge">{{ $property['category'] }}</span>
                            </div>
                            <div class="property__data">
                                <h2 class="property__price"><span>RP.
                                    </span>{{ number_format($property['price']) }}<span>/month</span></h2>
                                <h3 class="property__title">{{ $property['name'] }}</h3>
                                <span class="property__description">{{ $property['address'] }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach 
            </div>
        </div>
    </section> --}}

    <section class="subscribe section">
        <div class="subscribe__container container">
            <h2 class="subscribe__title">
                Start listing or buying a <br />
                property with us
            </h2>

            <a href="#" class="button subscribe__button">Get Started </a>
        </div>
    </section>
@endsection


@section('leaflet')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/homepage.css') }}" />
    <style>
        .hide {
            display: none;
        }
    </style>
@endpush

@push('script-alt')
    <script>
        const hideButton = document.getElementById('hide');
        const alert = document.querySelector('.alert');
        if (hideButton && alert) {
            hideButton.addEventListener('click', () => {
                alert.classList.add('hide');
            })
        }
    </script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($groupedKosts as $brandName => $brandKosts)
                // Initialize map
                var map{{ Str::slug($brandName) }} = L.map('map-{{ Str::slug($brandName) }}').setView([
                    {{ $brandKosts->first()->latitude }}, {{ $brandKosts->first()->longitude }}
                ], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map{{ Str::slug($brandName) }});

                @foreach ($brandKosts as $kost)
                    var marker = L.marker([{{ $kost->latitude }}, {{ $kost->longitude }}]).addTo(
                        map{{ Str::slug($brandName) }});
                    marker.bindPopup("<b>{{ $kost->name_kost }}</b><br>{{ $kost->location }}");
                @endforeach
            @endforeach
        });
    </script>
@endpush

<style>
    .mb-5 {
        margin-bottom: 50px;
    }
</style>
