@extends('templates.app')

@section('content-dinamis')
    <div class="container mt-5">
        <form action="{{ route('order.data') }}" method="GET" class="d-flex mb-3 mt-3 justify-content-end">
            <input type="date" name="date" class="btn me-2" value="{{ request('date') }}">
            <button type="submit" class="btn btn-primary me-2">cari</button>
            <a href="{{ route('order.data') }}" class="btn btn-danger">reset</a>
        </form>
        <div class="d-flex justify-content-end align-items-center mb-5 fade-in"> 
        </div>
        <h1 style="align-items: center">daftar pembelian</h1>
        {{-- <form action="" method="GET" class="d-flex mb-3 mt-3 justify-content-end">
            <input type="date" name="date" class="btn me-2" value="{{ request('date') }}">
            <button type="submit" class="btn btn-primary me-2">cari</button>
            <a href="" class="btn btn-danger">reset</a>
        </form> --}}
        {{-- buatkan button untuk export  excel di atas table--}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('order.export') }}" class="btn btn-primary">Export to Excel</a>
        </div>
        <br>

       
        
        <table class="table table-stripped table-bordered">
            <thead>
                <th>#</th>
                <th>Pembeli</th>
                <th>Handphone</th>
                <th>Kasir</th>
                <th>Tanggal Pembelian</th>
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
                        <td>{{ $order['user'] ['name'] }}</td>
                        <td>{{ \Carbon\Carbon::create($order->created_at)->locale('id')->translatedFormat('l, d F Y H:i:s') }}</td>
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
