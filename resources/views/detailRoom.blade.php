@extends('layouts.frontend')

@section('header')
    <header class="header" id="header">
        <div class="nav">
            <a href="{{ route('homepage') }}">Pakom<span>kost</span> <i class="bx bxs-home-heart"></i></a>
        </div>
    </header>
@endsection

@section('content')
    <section class="home section" id="home">
        <div class="home__container container grid">
            <h1 class="home__title">{{ $kost->name_kost }}</h1>
            <h2>{{ $room->rooms_name }}</h2>
            @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                <img class="home__img" src="{{ asset($mediaFiles[0]) }}" alt="{{ $room->rooms_name }}" />
            @else
                <p>No media available.</p>
            @endif
        </div>
    </section>

    <section class="galleries container">
        @if (!empty($mediaFiles))
            @foreach ($mediaFiles as $index => $media)
                <img class="{{ $index === 0 ? 'active' : '' }}" src="{{ asset($media) }}" alt="Gallery Image" />
            @endforeach
        @else
            <p>No media available.</p>
        @endif
    </section>

    <section class="container">
        <h3 class="section__title">Description</h3>
        @if (session()->has('message'))
            <div class="alert"
                style="position: relative; text-align: center; background-color: lightgreen; padding: 1rem; margin-bottom: .5rem; color: green; border-radius: .25rem;">
                {{ session()->get('message') }}
                <i id="hide"
                    style="font-size: 1.5rem; cursor: pointer; position: absolute; top: .25rem; right: .25rem;"
                    class='bx bx-x'></i>
            </div>
        @endif

        <div class="card__container">
            <article class="description__content">
                <div class="description__header">
                    <!-- header content -->
                </div>
                <p class="description__text" style="text-align: justify;">
                <div>{{ $kost->description }}</div>
                </p>
                <div class="description__footer">
                    {{-- <div class="location-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                        <span>{{ $kost->location }}</span>
                    </div> --}}
                    <div class="facilities-rules-container">
                        <div class="facilities-section">
                            <h5>Facilities:</h5>
                            <ul>
                                @foreach (json_decode($room->facilities) as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- <div class="rules-section">
                            <h5>Rules:</h5>
                            <ul>
                                @foreach (json_decode($kost->rules) as $rule)
                                    <li>{{ $rule }}</li>
                                @endforeach
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </article>
            <article class="contact__content">
                <div class="contact__header">
                    <h3>Contact Owner</h3>
                </div>
                <div class="social-media-links d-flex justify-content-center">
                    @if ($kost->whatsapp_number)
                        <a href="https://wa.me/{{ $kost->whatsapp_number }}" class="social-media-link"
                            title="Chat with us on WhatsApp" target="blank">
                            <i class='bx bxl-whatsapp' style="font-size: 32px;"></i>
                        </a>
                    @else
                        <a href="#" class="social-media-link" title="Kost doesn't have WhatsApp number">
                            <i class='bx bxl-whatsapp' style="font-size: 32px;"></i>
                            <span class="no-social-media-message" style="display: none;">Kost doesn't have WhatsApp
                                number.</span>
                        </a>
                    @endif

                    @if ($kost->facebook)
                        <a href="{{ $kost->facebook }}" class="social-media-link" title="Visit our Facebook page">
                            <i class='bx bxl-facebook' style="font-size: 32px;"></i>
                        </a>
                    @else
                        <a href="#" class="social-media-link" title="Kost doesn't have Facebook link">
                            <i class='bx bxl-facebook' style="font-size: 32px;"></i>
                            <span class="no-social-media-message" style="display: none;">Kost doesn't have Facebook
                                link.</span>
                        </a>
                    @endif

                    @if ($kost->instagram)
                        <a href="{{ $kost->instagram }}" class="social-media-link" title="Follow us on Instagram">
                            <i class='bx bxl-instagram' style="font-size: 32px;"></i>
                        </a>
                    @else
                        <a href="#" class="social-media-link" title="Kost doesn't have Instagram link">
                            <i class='bx bxl-instagram' style="font-size: 32px;"></i>
                            <span class="no-social-media-message" style="display: none;">Kost doesn't have Instagram
                                link.</span>
                        </a>
                    @endif

                    @if ($kost->twitter)
                        <a href="{{ $kost->twitter }}" class="social-media-link" title="Follow us on Twitter">
                            <i class='bx bxl-twitter' style="font-size: 32px;"></i>
                        </a>
                    @else
                        <a href="#" class="social-media-link" title="Kost doesn't have Twitter link">
                            <i class='bx bxl-twitter' style="font-size: 32px;"></i>
                            <span class="no-social-media-message" style="display: none;">Kost doesn't have Twitter
                                link.</span>
                        </a>
                    @endif
                </div>
            </article>
        </div>
    </section>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/detail.css') }}" />
    <style>
        .hide {
            display: none;
        }
    </style>
@endpush

<style>

</style>
