@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Daftar Kost : {{ Auth::user()->brand_name ?? '' }}</h1>
            <a href="{{ route('kosts.create') }}" class="btn btn-primary">Tambah Kost</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kost</th>
                    <th>Tipe Kost</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kosts as $index => $kost)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kost->name_kost }}</td>
                        <td>{{ $kost->kost_type }}</td>
                        <td>{{ $kost->status }}</td>
                        <td>
                            <a href="{{ route('kosts.edit', $kost->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            {{-- <form action="{{ route('kosts.destroy', $kost->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this kost?')">Delete</button>
                        </form> --}}
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete('{{ $kost->id }}')">Delete</button>
                            <form id="delete-form-{{ $kost->id }}"
                                action="{{ route('kosts.destroy', $kost->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kosts->links() }}
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(kostsId) {
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
                    document.getElementById('delete-form-' + kostsId).submit();
                }
            });
        }
    </script>
@endsection