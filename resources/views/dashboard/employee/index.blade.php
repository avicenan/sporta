@extends('layouts.dashboard-app')

@section('content')
    {{-- Success Alert Category --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Error Alert Category --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endisset

    {{-- Employees List --}}
    <div class="card p-3 mb-2">
        <table class="table table-striped table-bordered table-hover p-4">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Peran</th>
                    <th scope="col">Jumlah transaksi</th>
                    <th scope="col">Nilai transaksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($employees->isEmpty())
                    <tr>
                        <td colspan="8">Tidak ada akun karyawan ditemukan</td>
                    </tr>
                @else
                    @foreach ($employees as $employee)
                        <tr class="">
                            <th scope="row">{{ $employee->id }}</th>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->role->name }}</td>
                            <td>{{ $employee->orders->count() }}</td>
                            <td>Rp. {{ number_format($employee->orders->sum('total_price'), 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Pagination Nav --}}
    <div class="mb-2"><i>Menampilkan hasil dari {{ $employees->firstItem() }} sampai {{ $employees->lastItem() }}
            dari
            {{ $employees->total() }}</i>
    </div>
    <div class="d-flex">
        {{ $employees->links() }}
    </div>
@endsection
