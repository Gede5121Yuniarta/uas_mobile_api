@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Daftar Kelas Kamar</h1>
            <a href="{{ route('room_classes.create') }}" class="btn btn-primary">Tambah Kelas Kamar</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roomClasses as $index => $roomClass)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $roomClass->classes_name }}</td>
                        <td>{{ $roomClass->price }}</td>
                        {{-- <td>{{ 'Rp' . number_format(preg_replace('/[^0-9]/', '', $roomClass->price), 0, ',', '.') }}</td> --}}
                        <td>
                            <a href="{{ route('room_classes.edit', $roomClass->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('room_classes.destroy', $roomClass->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this room class?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $roomClasses->links() }}
    </div>
@endsection
