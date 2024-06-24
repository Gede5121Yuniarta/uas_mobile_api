@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Kost</h1>
        <form id="kostForm" action="{{ route('kosts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_kost">Name:</label>
                        <input type="text" id="name_kost" name="name_kost" required class="form-control"
                            value="{{ old('name_kost') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kost_type">Type:</label>
                        <select id="kost_type" name="kost_type" class="form-control">
                            <option value="campuran" {{ old('kost_type') == 'campuran' ? 'selected' : '' }}>Campuran
                            </option>
                            <option value="laki-laki" {{ old('kost_type') == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="perempuan" {{ old('kost_type') == 'perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="facilities">Facilities:</label>
                        <div id="facilities-container" class="mb-2">
                            @if (old('facilities'))
                                @foreach (old('facilities') as $facility)
                                    <div class="input-group mb-2">
                                        <input type="text" name="facilities[]" class="facility-input form-control"
                                            value="{{ $facility }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeFacility(this)">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="facilities[]" class="facility-input form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger"
                                            onclick="removeFacility(this)">-</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addFacility()" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Add Facility
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="rules">Rules:</label>
                        <div id="rules-container" class="mb-2">
                            @if (old('rules'))
                                @foreach (old('rules') as $rule)
                                    <div class="input-group mb-2">
                                        <input type="text" name="rules[]" class="rule-input form-control"
                                            value="{{ $rule }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeRule(this)">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="rules[]" class="rule-input form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="removeRule(this)">-</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addRule()" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Add Rule
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="whatsapp_number">WhatsApp Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control"
                                placeholder="8xxxxxxxxxx" required value="{{ old('whatsapp_number') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="media">Media:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="media" name="media[]" multiple
                                onchange="showUploadedFiles(this)">
                            <label class="custom-file-label" id="selectedFiles" for="media">Choose files</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook Link:</label>
                        <input type="url" id="facebook" name="facebook" class="form-control"
                            value="{{ old('facebook') }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram">Instagram Link:</label>
                        <input type="url" id="instagram" name="instagram" class="form-control"
                            value="{{ old('instagram') }}">
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter Link:</label>
                        <input type="url" id="twitter" name="twitter" class="form-control"
                            value="{{ old('twitter') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" class="form-control mb-2"
                            value="{{ old('location') }}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="search" placeholder="Search for a place" class="form-control mb-2">
                    </div>
                    <div id="map-container" style="border: 1px solid #ccc; position: relative;">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="latitude">Latitude:</label>
                        <input type="text" id="latitude" name="latitude" readonly class="form-control"
                            value="{{ old('latitude') }}">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" name="longitude" readonly class="form-control"
                            value="{{ old('longitude') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Kost</button>
        </form>
    </div>
@endsection

@section('leaflet')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial coordinates
            var initialLat = {{ old('latitude', -8.117650703287469) }};
            var initialLng = {{ old('longitude', 115.0880413875853) }};

            // Initialize Leaflet map
            var map = L.map('map').setView([initialLat, initialLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], {
                draggable: true
            }).addTo(map);

            // Update marker position and input fields on dragend
            marker.on('dragend', function(e) {
                var position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });

            // Update marker position and input fields on map click
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
            });

            // Geocode search functionality
            document.getElementById('search').addEventListener('input', function() {
                var query = this.value;
                if (query.length > 2) {
                    fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + query)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                var lat = data[0].lat;
                                var lon = data[0].lon;
                                map.setView([lat, lon], 13);
                                marker.setLatLng([lat, lon]);
                                document.getElementById('latitude').value = lat;
                                document.getElementById('longitude').value = lon;
                            }
                        });
                }
            });

            // Add and remove facility input fields
            window.addFacility = function() {
                var container = document.getElementById('facilities-container');
                var div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" name="facilities[]" class="facility-input form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" onclick="removeFacility(this)">-</button>
                    </div>
                `;
                container.appendChild(div);
            }

            window.removeFacility = function(button) {
                var container = document.getElementById('facilities-container');
                container.removeChild(button.parentElement.parentElement);
            }

            // Add and remove rule input fields
            window.addRule = function() {
                var container = document.getElementById('rules-container');
                var div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" name="rules[]" class="rule-input form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger" onclick="removeRule(this)">-</button>
                    </div>
                `;
                container.appendChild(div);
            }

            window.removeRule = function(button) {
                var container = document.getElementById('rules-container');
                container.removeChild(button.parentElement.parentElement);
            }

            // Set initial marker position in input fields
            document.getElementById('latitude').value = initialLat;
            document.getElementById('longitude').value = initialLng;
        });

        // Concatenate +62 with the input value before form submission
        document.getElementById('kostForm').addEventListener('submit', function(e) {
            var whatsappNumberInput = document.getElementById('whatsapp_number');
            whatsappNumberInput.value = '+62' + whatsappNumberInput.value;
        });

        function showUploadedFiles(input) {
            var files = input.files;
            if (files.length > 0) {
                var filenames = [];
                for (var i = 0; i < files.length; i++) {
                    filenames.push(files[i].name);
                }
                document.getElementById('selectedFiles').textContent = filenames.join(", ");
            } else {
                document.getElementById('selectedFiles').textContent = "Choose files";
            }
        }
    </script>
@endsection
