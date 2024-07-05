@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Daftar Kamar</h1>
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Kamar</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Kamar</th>
                    <th>Nama Kost</th>
                    <th>Kelas Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Status</th>
                    <th>Jumlah Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->rooms_name }}</td>
                        <td>{{ $room->kost->name_kost }}</td>
                        <td>{{ $room->roomClass->classes_name }}</td>
                        <td>{{ $room->roomClass->price }}</td>
                        <td>
                            <form action="{{ route('rooms.update.status', $room->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <select name="status" style="width: 100px;" onchange="this.form.submit()">
                                    <option value="Tersedia" {{ $room->status == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="Penuh" {{ $room->status == 'Penuh' ? 'selected' : '' }}>Penuh</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('rooms.update.jumlah_kamar', $room->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="jumlah_kamar" value="{{ $room->jumlah_kamar }}" style="width: 100px;"
                                    onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Edit</a>
                            {{-- <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form> --}}
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete('{{ $room->id }}')">Delete</button>
                            <form id="delete-form-{{ $room->id }}"
                                action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rooms->links() }}
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(roomsId) {
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
                    document.getElementById('delete-form-' + roomsId).submit();
                }
            });
        }
    </script>
@endsection