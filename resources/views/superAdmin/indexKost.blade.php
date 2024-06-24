@extends('layouts.superAdmin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Daftar Semua Kost</h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kost</th>
                    <th>Brand Name</th> <!-- Tambahkan kolom Brand Name -->
                    <th>Admin</th>
                    <th>Tipe Kost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kosts as $index => $kost)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $kost->name_kost }}</td> --}}
                        <td>
                            <a href="{{ route('kosts.show', Str::slug($kost->name_kost)) }}">{{ $kost->name_kost }}</a>
                        </td> 
                        {{-- <td>{{ $kost->admin->name }}</td> --}}
                        <td>{{ $kost->admin ? $kost->admin->brand_name : 'Tidak Ada Brand' }}</td>
                        <!-- Pengecekan relasi brand_name -->
                        <td>{{ $kost->admin ? $kost->admin->name : 'Tidak Ada Admin' }}</td>
                        <!-- Pengecekan relasi admin -->
                        <td>{{ $kost->kost_type }}</td>
                        <td>
                            <form action="{{ route('kosts.update.status', $kost->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $kost->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="confirm" {{ $kost->status == 'confirm' ? 'selected' : '' }}>Confirm
                                    </option>
                                    <option value="reject" {{ $kost->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $kosts->render() }} --}}
        {{ $kosts->links() }}
    </div>
@endsection
