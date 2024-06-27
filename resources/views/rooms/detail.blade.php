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
            <h2 class="home__title2">{{ $room->rooms_name }}</h2>
            @php
                $mediaFiles = json_decode($room->rooms_media, true);
            @endphp
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
                <div class="description__header" style="display: flex; flex-direction: column;">
                    <div class="price-section">
                        <span class="price-label">Harga: </span>
                        <span class="price-data">{{ $room->roomClass->price }}</span>
                    </div>
                    <br>
                    <div class="class-section">
                        <span class="class-label">Class: </span>
                        <span class="class-data">{{ $room->roomClass->classes_name }}</span>
                    </div>
                </div>

                <p class="description__text" style="text-align: justify;">
                <div>{{ $room->description }}</div>
                </p>
                <div class="description__footer">
                    <div class="facilities-rules-container">
                        <div class="facilities-section">
                            <h5>Fasilitas Kost:</h5>
                            <ul>
                                @foreach (json_decode($kost->facilities) as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="rules-section">
                            <h5>Fasilitas Kamar:</h5>
                            <ul>
                                @foreach (json_decode($room->facilities) as $facilitiesRoom)
                                    <li>{{ $facilitiesRoom }}</li>
                                @endforeach
                            </ul>
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
            <h2 class="home__title2">{{ $room->rooms_name }}</h2>
        </div>
    </section>

    <div class="content-wrapper">
        <div class="media-section">
            <div class="home__img-container">
                @php
                    $mediaFiles = json_decode($room->rooms_media, true);
                @endphp
                @if (!empty($mediaFiles) && $mediaFiles[0] != '')
                    <img class="home__img" src="{{ asset($mediaFiles[0]) }}" alt="{{ $room->rooms_name }}" />
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
                <div class="description__header" style="display: flex; flex-direction: column;">
                    <div class="price-section">
                        <span class="price-label">Harga: </span>
                        <span class="price-data">{{ $room->roomClass->price }}</span>
                    </div>
                    <br>
                    <div class="class-section">
                        <span class="class-label">Class: </span>
                        <span class="class-data">{{ $room->roomClass->classes_name }}</span>
                    </div>
                </div>

                <p class="description__text" style="text-align: justify;">
                <div>{{ $room->description }}</div>
                </p>
                <div class="description__footer">
                    <div class="facilities-rules-container">
                        <div class="facilities-section">
                            <h5>Fasilitas Kost:</h5>
                            <ul>
                                @foreach (json_decode($kost->facilities) as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="rules-section">
                            <h5>Fasilitas Kamar:</h5>
                            <ul>
                                @foreach (json_decode($room->facilities) as $facilitiesRoom)
                                    <li>{{ $facilitiesRoom }}</li>
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
                <div class="social-media-links d-flex justify-content-center" style="margin-bottom: 20px;">
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
    <!-- Menambahkan kamar lain yang tersedia -->
    {{-- <section class="container">
        <h3 class="section__title">Kamar Lain yang Tersedia</h3>
        <div class="popular__container grid">
            @foreach ($otherAvailableRooms as $otherRoom)
                <article class="property__card">
                    <a href="{{ route('rooms.show', $otherRoom->slug) }}" class="other-room-link"
                        data-room-slug="{{ $otherRoom->slug }}">
                        <div class="property__images">
                            @php
                                $otherRoomMediaFiles = json_decode($otherRoom->rooms_media, true);
                            @endphp

                            @if (!empty($otherRoomMediaFiles) && $otherRoomMediaFiles[0] != '')
                                <img src="{{ asset($otherRoomMediaFiles[0]) }}" alt="{{ $otherRoom->rooms_name }}"
                                    class="property__img" />
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="No Room Image" class="property__img" />
                            @endif
                            <span class="property__badge">{{ $otherRoom->status }}</span>
                        </div>
                        <div class="property__data">
                            <h3 class="property__title">{{ $otherRoom->rooms_name }}</h3>
                            <span class="property__description">{{ $otherRoom->description }}</span>
                            <span class="property__description">{{ $otherRoom->roomClass->classes_name }}</span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section> --}}

    <section class="container">
        <h3 class="section__title">Kamar Lain yang Tersedia</h3>
        @if ($otherAvailableRooms->where('status', 'Tersedia')->count() > 0)
            <div class="popular__container grid">
                @foreach ($otherAvailableRooms->where('status', 'Tersedia') as $otherRoom)
                    <article class="property__card">
                        <a href="{{ route('rooms.show', $otherRoom->slug) }}" class="other-room-link"
                            data-room-slug="{{ $otherRoom->slug }}">
                            <div class="property__images">
                                @php
                                    $otherRoomMediaFiles = json_decode($otherRoom->rooms_media, true);
                                @endphp

                                @if (!empty($otherRoomMediaFiles) && $otherRoomMediaFiles[0] != '')
                                    <img src="{{ asset($otherRoomMediaFiles[0]) }}" alt="{{ $otherRoom->rooms_name }}"
                                        class="property__img" />
                                @else
                                    <img src="{{ asset('placeholder.jpg') }}" alt="No Room Image"
                                        class="property__img" />
                                @endif
                                <span class="property__badge">{{ $otherRoom->status }}</span>
                            </div>
                            <div class="property__data">
                                <h3 class="property__title">{{ $otherRoom->rooms_name }}</h3>
                                <span class="property__description">{{ $otherRoom->description }}</span>
                                <span class="property__description">{{ $otherRoom->roomClass->classes_name }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <p>Tidak ada kamar yang kosong</p>
        @endif

        <h3 class="section__title">Kamar Lain</h3>
        <div class="popular__container grid">
            @foreach ($otherAvailableRooms as $otherRoom)
                <article class="property__card">
                    <a href="{{ route('rooms.show', $otherRoom->slug) }}" class="other-room-link"
                        data-room-slug="{{ $otherRoom->slug }}">
                        <div class="property__images">
                            @php
                                $otherRoomMediaFiles = json_decode($otherRoom->rooms_media, true);
                            @endphp

                            @if (!empty($otherRoomMediaFiles) && $otherRoomMediaFiles[0] != '')
                                <img src="{{ asset($otherRoomMediaFiles[0]) }}" alt="{{ $otherRoom->rooms_name }}"
                                    class="property__img" />
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="No Room Image" class="property__img" />
                            @endif
                            <span class="property__badge">{{ $otherRoom->status }}</span>
                        </div>
                        <div class="property__data">
                            <h3 class="property__title">{{ $otherRoom->rooms_name }}</h3>
                            <span class="property__description">{{ $otherRoom->description }}</span>
                            <span class="property__description">{{ $otherRoom->roomClass->classes_name }}</span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.other-room-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                var roomSlug = this.getAttribute('data-room-slug');

                fetch('/rooms/' + roomSlug)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('.home__title').textContent = data.kost.name_kost;
                        document.querySelector('.home__container h2').textContent = data.room
                            .rooms_name;
                        document.querySelector('.home__img').src = data.mediaFiles[0];
                        document.querySelector('.home__img').alt = data.room.rooms_name;

                        var galleryContainer = document.querySelector('.galleries.container');
                        galleryContainer.innerHTML = '';
                        data.mediaFiles.forEach(function(media, index) {
                            var img = document.createElement('img');
                            img.src = media;
                            img.alt = "Gallery Image";
                            if (index === 0) img.classList.add('active');
                            galleryContainer.appendChild(img);
                        });

                        document.querySelector('.description__text div').textContent = data.kost
                            .description;
                        document.querySelector('.location-container span').textContent = data.kost
                            .location;

                        var facilitiesSection = document.querySelector('.facilities-section ul');
                        facilitiesSection.innerHTML = '';
                        data.kost.facilities.forEach(function(facility) {
                            var li = document.createElement('li');
                            li.textContent = facility;
                            facilitiesSection.appendChild(li);
                        });

                        var rulesSection = document.querySelector('.rules-section ul');
                        rulesSection.innerHTML = '';
                        data.kost.rules.forEach(function(rule) {
                            var li = document.createElement('li');
                            li.textContent = rule;
                            rulesSection.appendChild(li);
                        });

                        updateSocialMediaLink('.social-media-link.bxl-whatsapp', data.kost
                            .whatsapp_number, 'https://wa.me/');
                        updateSocialMediaLink('.social-media-link.bxl-facebook', data.kost.facebook);
                        updateSocialMediaLink('.social-media-link.bxl-instagram', data.kost.instagram);
                        updateSocialMediaLink('.social-media-link.bxl-twitter', data.kost.twitter);
                    });
            });
        });

        function updateSocialMediaLink(selector, contact, prefix = '') {
            var link = document.querySelector(selector);
            if (contact) {
                link.href = prefix + contact;
                link.querySelector('.no-social-media-message').style.display = 'none';
            } else {
                link.href = '#';
                link.querySelector('.no-social-media-message').style.display = 'inline';
            }
        }
    </script>
@endsection


@section('scripts')
    <script>
        // Menambahkan event listener untuk link kamar lain yang tersedia
        document.querySelectorAll('.other-room-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Mengambil slug kamar dari data atribut
                var roomSlug = this.getAttribute('data-room-slug');

                // Mengirim permintaan AJAX untuk mendapatkan data kamar baru
                fetch('/rooms/' + roomSlug)
                    .then(response => response.json())
                    .then(data => {
                        // Memperbarui konten halaman dengan data kamar baru
                        document.querySelector('.home__title').textContent = data.kost.name_kost;
                        document.querySelector('.home__container h2').textContent = data.room
                            .rooms_name;
                        document.querySelector('.home__img').src = data.mediaFiles[0];
                        document.querySelector('.home__img').alt = data.room.rooms_name;

                        // Memperbarui galeri gambar
                        var galleryContainer = document.querySelector('.galleries.container');
                        galleryContainer.innerHTML = '';
                        data.mediaFiles.forEach(function(media, index) {
                            var img = document.createElement('img');
                            img.src = media;
                            img.alt = "Gallery Image";
                            if (index === 0) img.classList.add('active');
                            galleryContainer.appendChild(img);
                        });

                        // Memperbarui deskripsi dan detail lainnya
                        document.querySelector('.description__text div').textContent = data.kost
                            .description;
                        document.querySelector('.location-container span').textContent = data.kost
                            .location;

                        // Memperbarui fasilitas dan aturan
                        var facilitiesSection = document.querySelector('.facilities-section ul');
                        facilitiesSection.innerHTML = '';
                        data.kost.facilities.forEach(function(facility) {
                            var li = document.createElement('li');
                            li.textContent = facility;
                            facilitiesSection.appendChild(li);
                        });

                        var rulesSection = document.querySelector('.rules-section ul');
                        rulesSection.innerHTML = '';
                        data.kost.rules.forEach(function(rule) {
                            var li = document.createElement('li');
                            li.textContent = rule;
                            rulesSection.appendChild(li);
                        });

                        // Memperbarui kontak pemilik
                        updateSocialMediaLink('.social-media-link.bxl-whatsapp', data.kost
                            .whatsapp_number, 'https://wa.me/');
                        updateSocialMediaLink('.social-media-link.bxl-facebook', data.kost.facebook);
                        updateSocialMediaLink('.social-media-link.bxl-instagram', data.kost.instagram);
                        updateSocialMediaLink('.social-media-link.bxl-twitter', data.kost.twitter);
                    });
            });
        });

        function updateSocialMediaLink(selector, contact, prefix = '') {
            var link = document.querySelector(selector);
            if (contact) {
                link.href = prefix + contact;
                link.querySelector('.no-social-media-message').style.display = 'none';
            } else {
                link.href = '#';
                link.querySelector('.no-social-media-message').style.display = 'inline';
            }
        }
    </script>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.other-room-link').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    const slug = this.getAttribute('data-room-slug');
                    const url = `{{ route('rooms.show', ':slug') }}`.replace(':slug', slug);
                    window.location.href = url;
                });
            });
        });
    </script>
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

    .price-section,
    .class-section {
        /* margin-bottom: 10px; */
        font-weight: bold;
        margin-top: 10px;
        /* Add space below the price section */
    }

    .price-data,
    .class-data {
        color: rgb(0, 0, 0);
        /* Set price color to red */
    }

    .price-label,
    .class-label {
        font-weight: normal;
        color: rgb(0, 0, 0);
        font-weight: bold;
        /* Less emphasis than price data */
    }

    ////////
    .home__title,
    .home__title2 {
        text-align: center;
    }

    .content-wrapper {
        display: flex;
        justify-content: space-between;
    }

    .media-section {
        width: 50%;
        display: flex;
        flex-direction: column;
    }

    .info-section {
        width: 50%;
        display: flex;
        flex-direction: column;
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
        text-align: left;
        margin-top: 1rem;
        /* Tambahkan jarak dari gambar utama */
        display: flex;
        flex-wrap: wrap;
    }

    .galleries img {
        width: 45%;
        /* Ubah ukuran gambar galeri */
        margin: 0.5rem;
    }

    .description__content {
        order: 1;
        /* Memastikan deskripsi berada di atas contact owner */
    }

    .contact__content {
        order: 2;
        margin-top: 2rem;
        /* Memastikan contact owner berada di bawah deskripsi */
    }
</style>
