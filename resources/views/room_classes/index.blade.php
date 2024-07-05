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
                    <th>Kost</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roomClasses as $index => $roomClass)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $roomClass->classes_name }}</td>
                        <td>{{ $roomClass->kost->name_kost }}</td>
                        <td>{{ $roomClass->price }}</td>
                        <td>
                            <a href="{{ route('room_classes.edit', $roomClass->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete('{{ $roomClass->id }}')">Delete</button>
                            <form id="delete-form-{{ $roomClass->id }}"
                                action="{{ route('room_classes.destroy', $roomClass->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $roomClasses->links() }}
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(roomClassId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + roomClassId).submit();
                }
            });
        }
    </script>
@endsection
