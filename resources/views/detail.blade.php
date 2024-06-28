@extends('layouts.frontend')

@section('header')
    <header class="header" id="header">
        <div class="nav">
            <a href="{{ route('homepage') }}">Pakom<span>kost</span> <i class="bx bxs-home-heart"></i></a>
        </div>
    </header>
@endsection

@section('content')
    {{-- <section class="home section" id="home">
        <div class="home__container container grid">
            <h1 class="home__title">{{ $kost->name_kost }}</h1>
            @php
                $mediaFiles = is_array($kost->media) ? $kost->media : explode(',', $kost->media);
            @endphp
            @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                <img class="home__img" src="{{ asset($mediaFiles[0]) }}" alt="{{ $kost->name_kost }}" />
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
                    <div id="map"></div>
                    <div class="location-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                        <span>{{ $kost->location }}</span>
                    </div>
                    <div class="facilities-rules-container">
                        <div class="facilities-section">
                            <h5>Facilities:</h5>
                            <ul>
                                @foreach (json_decode($kost->facilities) as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="rules-section">
                            <h5>Rules:</h5>
                            <ul>
                                @foreach (json_decode($kost->rules) as $rule)
                                    <li>{{ $rule }}</li>
                                @endforeach
                            </ul>
                        </div>
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
    </section> --}}

    <section class="home section" id="home">
        <div class="home__container container grid">
            <h1 class="home__title">{{ $kost->name_kost }}</h1>
        </div>
    </section>

    <div class="content-wrapper">
        <div class="media-section">
            <div class="home__img-container">
                <!-- Gambar utama -->
                @php
                    $mediaFiles = is_array($kost->media) ? $kost->media : explode(',', $kost->media);
                @endphp
                @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                    <img class="home__img" src="{{ asset($mediaFiles[0]) }}" alt="{{ $kost->name_kost }}" />
                @else
                    <p>No media available.</p>
                @endif
            </div>

            <section class="galleries container" style="margin-top: 20px; font-size: 0.8em;">
                @if (!empty($mediaFiles))
                    @foreach ($mediaFiles as $index => $media)
                        <img class="{{ $index === 0 ? 'active' : '' }}" src="{{ asset($media) }}" alt="Gallery Image" />
                    @endforeach
                @else
                    <p>No media available.</p>
                @endif
            </section>
        </div>

        <div class="info-section">
            <article class="description__content">
                <div class="description__header">
                    <!-- header content -->
                </div>
                <p class="description__text" style="text-align: justify;">
                <div>{{ strip_tags($kost->description) }}</div>
                </p>
                <div class="description__footer">
                    <div id="map"></div>
                    <div class="location-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                        <span>{{ $kost->location }}</span>
                    </div>
                    <div class="facilities-rules-container">
                        <div class="facilities-section">
                            <h5>Facilities:</h5>
                            <ul>
                                @foreach (json_decode($kost->facilities) as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="rules-section">
                            <h5>Rules:</h5>
                            <ul>
                                @foreach (json_decode($kost->rules) as $rule)
                                    <li>{{ $rule }}</li>
                                @endforeach
                            </ul>
                        </div>
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
    </div>

    <!-- Menampilkan daftar kamar -->
    {{-- <section class="container">
        <h3 class="section__title">Daftar Kamar</h3>
        <div class="popular__container grid">
            @foreach ($rooms as $room)
                <article class="property__card">
                    <a href="{{ route('rooms.show', $room->slug) }}">
                        <div class="property__images">
                            @php
                                $mediaFiles = json_decode($room->rooms_media, true);
                            @endphp
                            @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                                <img class="property__img" src="{{ asset($mediaFiles[0]) }}"
                                    alt="{{ $room->rooms_name }}" />
                            @else
                                <p>No media available.</p>
                                <img src="{{ asset('placeholder.jpg') }}" alt="No Room Image" class="property__img" />
                            @endif
                            <span class="property__badge">{{ $room->status }}</span>
                        </div>
                        <div class="property__data">
                            <h3 class="property__title">{{ $room->rooms_name }}</h3>
                            <span class="property__description">{{ $room->roomClass->price }}</span>
                            <span class="property__description">{{ $room->roomClass->classes_name }}</span>
                        </div> 
                        <div class="property__data">
                            <h3 class="property__title">{{ $room->rooms_name }}</h3>
                            <span class="property__description"><b>{{ $room->roomClass->price }}</b></span>
                            <span class="property__description">{{ $room->roomClass->classes_name }}</span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section> --}}

    <section class="container">
        <h3 class="section__title">Daftar Kamar</h3>
        <div class="popular__container grid">
            @foreach ($rooms as $room)
                <article class="property__card">
                    <a href="{{ route('rooms.show', $room->slug) }}">
                        <div class="property__images">
                            @php
                                $mediaFiles = json_decode($room->rooms_media, true);
                            @endphp
                            @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                                <img class="property__img" src="{{ asset($mediaFiles[0]) }}"
                                    alt="{{ $room->rooms_name }}" />
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="No Room Image" class="property__img" />
                            @endif
                            <span class="property__badge">
                                {{ $room->status }}
                                <br>
                                <small>{{ $room->jumlah_kamar }} Kamar Tersedia</small> <!-- Menampilkan jumlah kamar -->
                            </span>
                        </div>
                        <div class="property__data">
                            <h3 class="property__title">{{ $room->rooms_name }}</h3>
                            <span class="property__description"><b>{{ $room->roomClass->price }}</b></span>
                            <span class="property__description">{{ $room->roomClass->classes_name }}</span>
                        </div>
                    </a>
                </article>
            @endforeach
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

@push('script-alt')
    <script>
        //   hide
        const hideButton = document.getElementById('hide');
        const alert = document.querySelector('.alert');
        if (hideButton && alert) {
            hideButton.addEventListener('click', () => {
                alert.classList.add('hide');
            })
        }
        // end
        const largeImage = document.querySelector(".home__img");
        const images = document.querySelectorAll(".galleries img");
        images.forEach((image, i) => {
            image.addEventListener("click", () => {
                largeImage.src = image.src;
                image.style.transition = ".2s";
                const current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(
                    "active",
                    ""
                );
                image.className += " active";
            });
        });

        const socialMediaLinks = document.querySelectorAll('.social-media-link a');

        socialMediaLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default link behavior
                // Optionally, perform your own action here (e.g., open in new tab)
            });
        });
    </script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" defer></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial coordinates
            var initialLat = {{ $kost->latitude }};
            var initialLng = {{ $kost->longitude }};

            // Initialize Leaflet map
            var map = L.map('map').setView([initialLat, initialLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], {
                draggable: false
            }).addTo(map);

            // marker.bindPopup("{{ $kost->location }}").openPopup();


            // Ensure map resizes correctly
            setTimeout(function() {
                map.invalidateSize();
            }, 500); // Adjust the timeout if needed
        });
    </script>
@endpush

<style>
    .location-container {
        display: flex;
        align-items: center;
        margin-top: 1rem;
    }

    .location-container svg {
        margin-right: 0.5rem;
    }


    .social-media-links {
        display: flex;
        justify-content: center;
    }

    .social-media-link {
        margin: 10px;
        title: "Click to connect";
    }

    .social-media-link a:visited {
        color: inherit;
        /* Inherit the color from the parent element */
    }

    .social-media-link i {
        color: #333 !important;
        /* Replace with your desired color */
        font-size: 32px;
    }

    .social-media-link a:active i {
        color: inherit;
        /* Inherit color from parent element */
    }


    .no-social-media-message {
        display: none;
    }

    .social-media-link:hover.no-social-media-message {
        display: block;
    }

    /* .facilities-rules-container {
        display: flex;
        flex-direction: row;
    } */


    .facilities-rules-container {
        display: flex;
        flex-direction: row;
        width: 100%;
        margin-top: 1rem;
    }

    /* .facilities-section,
    .rules-section {
        flex: 1;
        margin: 20px;
    } */

    .facilities-section,
    .rules-section {
        flex: 1;
        margin: 0.5rem;
        background-color: #f9f9f9;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .facilities-section h5,
    .rules-section h5 {
        margin-bottom: 0.5rem;
    }

    .facilities-section ul,
    .rules-section ul {
        list-style: none;
        padding: 0;
    }

    .facilities-section ul li,
    .rules-section ul li {
        margin-bottom: 0.5rem;
        padding-left: 1rem;
        position: relative;
    }

    .facilities-section ul li::before,
    .rules-section ul li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: #ff5c6f;
    }

    #map {
        width: 100%;
        height: 300px;
        /* Adjust height as needed */
        max-width: 100%;
        /* Ensure the map doesn't exceed its container */
        overflow: hidden;
        border-radius: 0.5rem;
        /* Optional for rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Optional for shadow */
        margin-top: 1rem;
    }

    .popular__container {
        padding: 1rem 0 5rem;
        row-gap: 2rem;
    }

    /* property style */
    .property__container {
        padding: 1rem 0 5rem;
        column-gap: 0.5rem;
        row-gap: 2rem;
    }

    .property__card {
        width: 290px;
        background-color: var(--container-color);
        padding: 0.5rem 0.5rem 1.5rem;
        border-radius: 1rem;
        margin: 0 auto;
        transition: 0.4s;
    }

    .property__images {
        position: relative;
    }

    .property__img {
        position: relative;
        border-radius: 1rem;
        margin-bottom: 1rem;
        height: 200px;
        object-fit: cover;
    }

    .property__data {
        padding: 0 1rem 0 0.5rem;
    }

    .property__price {
        font-size: var(--h2-font-size);
        color: #ff5c6f;
        margin-bottom: 0.25rem;
    }

    .property__title {
        font-size: var(--h3-font-size);
        margin-bottom: 0.75rem;
        color: #23262f;
    }

    .property__description {
        font-size: var(--small-font-size);
    }

    .property__card {
        box-shadow: 0 3px 24px hsla(225, 66%, 45%, 0.1);
    }

    .property__card a {
        color: var(--text-color);
    }

    .property__card:hover {
        box-shadow: 8px 8px 0 hsla(353, 100%, 68%, 1);
    }

    .property__badge {
        background-color: #ff5e72;
        position: absolute;
        top: 0;
        right: 0;
        color: #fff;
        border-radius: 0 1rem 0 1rem;
        padding: 0.5rem 1.75rem;
    }

    .popular__container {
        grid-template-columns: repeat(3, 1fr);
    }

    ////

    .home__title {
        text-align: center;
    }

    .content-wrapper {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .media-section {
        /* width: 45%; */
        width: 50%;
        display: flex;
        flex-direction: column;
    }

    .info-section {
        width: 50%;
        display: flex;
        flex-direction: column;
        /* margin-left: 2%; */
        justify-content: flex-start;
    }

    .home__img-container {
        /* text-align: left; */
        text-align: center;
    }

    .home__img-container img {
        max-width: 100%;
        /* or a fixed width, e.g. 300px */
        max-height: 300px;
        /* or a fixed height */
        object-fit: cover;
        /* keep the image aspect ratio */
    }

    .galleries {
        margin-top: 1rem;
        text-align: left;
        display: flex;
        flex-wrap: wrap;
    }

    .galleries img {
        width: 100px;
        /* width: 45%; */
        /* Ubah ukuran gambar galeri */
        margin: 0.5rem;
    }

    .description__content {
        order: 1;
        /* margin-top: 2rem; */
    }

    .contact__content {
        order: 2;
        margin-top: 2rem;
    }
</style>
