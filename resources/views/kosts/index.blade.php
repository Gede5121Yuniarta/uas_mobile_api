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
            @foreach($kosts as $index => $kost)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kost->name_kost }}</td>
                    <td>{{ $kost->kost_type }}</td>
                    <td>{{ $kost->status }}</td>
                    <td>
                        <a href="{{ route('kosts.edit', $kost->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kosts.destroy', $kost->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this kost?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $kosts->links() }}
</div>
@endsection