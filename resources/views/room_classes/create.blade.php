@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Tambah Kelas Kamar</h1>
        <form action="{{ route('room_classes.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="classes_name">Nama:</label>
                        <input type="text" id="classes_name" name="classes_name" required class="form-control"
                            value="{{ old('classes_name') }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="price">Harga:</label>
                        <input type="number" id="price" name="price" required class="form-control" value="{{ old('price') }}">
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Rp">
                    </div> --}}
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Enter price">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Kelas Kamar</button>
        </form>
    </div>
@endsection

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function() {
                var value = this.value.replace(/[^0-9]/g, '');
                this.value = 'Rp.' + value;
            });
        });
    </script>
@endsection --}}

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^\d]/g, ''); // Hanya menerima digit
            });
        });
    </script>
@endsection
