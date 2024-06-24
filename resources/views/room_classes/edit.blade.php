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
                                value="{{ $roomClass->price }}">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Kelas Kamar</button>
        </form>
    </div>
@endsection

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
