@extends('templates.app')

@section('content-dinamis')
    <div class="container mt-5">
        <div class="d-flex justify-content-end align-items-center mb-5 fade-in">
            <a href="{{ route('kasir.order.create') }}"
                class="btn btn-gradient-primary shadow-lg rounded-pill px-5 py-3 d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle fs-5"></i>
                <span class="fw-bold">Tambah Order</span>
            </a>
        </div>
        <h1>DATA PEMBELIAN : {{ Auth::user()->name }}</h1>
        <form action="{{ route('kasir.order') }}" method="GET" class="d-flex mb-3 mt-3 justify-content-end">
            <input type="date" name="date" class="btn me-2" value="{{ request('date') }}">
            <button type="submit" class="btn btn-primary me-2">cari</button>
            <a href="{{ route('kasir.order') }}" class="btn btn-danger">reset</a>
        </form>
        <table class="table table-stripped table-bordered">
            <thead>
                <th>#</th>
                <th>Pembeli</th>
                <th>Obat</th>
                <th>Total Harga</th>
                <th>Tanggal Pembelian</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ ($orders->currentPage() - 1) * $orders->perpage() + ($index + 1) }}</td>
                        <td>{{ $order['name_customer']}}</td> <!-- Display buyer's name -->
                        <td>
                            @foreach ($order->phones as $phone)
                                <li>{{ $phone['name_phone'] }} ({{ $phone['qty'] }}) : Rp. {{number_format($phone['sub_price'], 0, ',', '.')}}</li>
                            @endforeach
                        </td>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::create($order->created_at)->locale('id')->translatedFormat('l, d F Y H:i:s') }}</td>

                        <td>
                            <a href="{{ route('kasir.download', $order['id']) }}" class="btn btn-secondary">Cetak Struk</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">{{ $orders->links() }}</div>
    </div>

    <style>
        .btn-gradient-primary {
            background: linear-gradient(45deg, #1e90ff, #007bff);
            color: white;
            transition: all 0.3s ease-in-out;
            border: none;
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(45deg, #007bff, #0056b3);
            transform: scale(1.05);
        }
    </style>
@endsection
