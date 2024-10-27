@extends('layouts.dashboard-app')

@section('content')
    <div class="d-flex gap-2 mb-2">

        <button class="btn btn-outline-dark d-flex align-items-center" id="print-button" onclick="printTable()">
            <div class="pt-1"><span class="material-symbols-rounded">print</span></div>
            <div class="ms-2">Cetak</div>
        </button>

    </div>

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
        <table class="table table-striped table-bordered table-hover p-4" id="printTable">
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

    <script>
        // print data
        function printTable() {
            const table = $('#printTable');
            const newTable = $('<table>').addClass('table table-striped table-bordered table-hover');
            const nowDate = new Date().toLocaleDateString('id-ID');
            newTable.html(table.html());

            const newWin = window.open('', '', 'height=1123,width=794');
            newWin.document.write('<html><head><title>Print</title>');
            newWin.document.write(
                '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">'
            );
            newWin.document.write('</head><body>');
            newWin.document.write('<div class="container p-5"><h1 class="text-center">Data Pegawai ' + nowDate +
                '</h1><br>');
            newWin.document.write(newTable[0].outerHTML);
            newWin.document.write('</div></body></html>');
            newWin.document.close();
            newWin.print();
        }
    </script>
@endsection
