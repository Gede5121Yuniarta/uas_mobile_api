@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Kelas Kamar</h1>
        <form action="{{ route('room_classes.update', $roomClass->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kost_id">Kost:</label>
                        <select id="kost_id" name="kost_id" class="form-control" required>
                            <option value="">Pilih Kost</option>
                            @foreach ($kosts as $kost)
                                <option value="{{ $kost->id }}"
                                    {{ $kost->id == $roomClass->kost_id ? 'selected' : '' }}>
                                    {{ $kost->name_kost }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classes_name">Nama:</label>
                        <input type="text" id="classes_name" name="classes_name" required class="form-control"
                            value="{{ old('classes_name', $roomClass->classes_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ old('price', $roomClass->raw_price) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facilities">Facilities:</label>
                        <div id="facilities-container" class="mb-2">
                            @if (old('facilities', json_decode($roomClass->facilities, true)))
                                @foreach (old('facilities', json_decode($roomClass->facilities, true)) as $facility)
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
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
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

        document.addEventListener('DOMContentLoaded', function() {
            var priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function() {
                // Hapus semua karakter yang bukan digit
                var value = this.value.replace(/[^\d]/g, '');
                this.value = value;
            });
        });
    </script>
@endsection
