@extends('templates.app')

@section('content-dinamis')
<div class="container mt-5">
    <form action="{{ route('kasir.order.store') }}" class="card shadow-lg m-auto p-5 rounded-3" method="POST">
        @csrf
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @php
                $valueFormBefore = Session::get('valueFormBefore');
            @endphp
        @endif

        {{-- Validation error messages --}}
        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <p class="fw-bold">Penanggung Jawab : <span class="text-primary">{{ Auth::user()->name }}</span></p>

        {{-- Sponsor Section inside the form --}}
        <div class="text-center mb-4">
            <img src="https://sehatnegeriku.kemkes.go.id/wp-content/uploads/2016/12/logo-kemenkes_landscape.jpg"
                alt="Sponsor 1" class="sponsor-logo mx-2" />
            <img src="https://png.pngtree.com/template/20190926/ourmid/pngtree-medical-pharmacy-heart-healthcare-logo-vector-graphic-design-image_309769.jpg"
                alt="Sponsor 2" class="sponsor-logo mx-2" />
            <img src="https://marketplace.canva.com/EAFqaeC81y0/1/0/1600w/canva-ungu-biru-ilustrasi-sederhana-3d-elegan-kesehatan-logo-W4xcw7edlR0.jpg"
                alt="Sponsor 3" class="sponsor-logo mx-2" />
        </div>

        <div class="mb-4">
            <label for="name_customer" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control" id="name_customer"
                name="name_customer" placeholder="Masukkan Nama Pembeli" required
                value="{{ isset($valueFormBefore) ? $valueFormBefore['name_costumer'] : '' }}">
        </div>

        <div class="mb-4">
            <label for="phones" class="form-label">Handphone</label>
            <div id="phone-list">
                @if (isset($valueFormBefore))
                    @foreach ($valueFormBefore['phones'] as $key => $phone)
                        <div id="phones-{{ $key }}" class="d-flex align-items-center mb-2">
                            <select name="phones[]" id="phones-{{ $key }}" class="form-select">
                                @foreach ($phones as $item)
                                    <option value="{{ $item['id'] }}" {{ $phone == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}</option>
                                @endforeach
                            </select>
                            @if ($key > 0)
                                <span style="cursor:pointer" class="text-danger ms-2 remove-phone">X</span>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div id="phones-1" class="d-flex align-items-center mb-2">
                        <select name="phones[]" id="phones-1" class="form-select">
                            <option selected hidden disabled>Pesanan 1</option>
                            @foreach ($phones as $item)
                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>

        {{-- Wrapper for additional select inputs --}}
        <div id="wrap-phones"></div>

        <p style="cursor: pointer" class="text-primary" id="add-select">+ tambah handphone</p>

        <button type="submit" class="btn btn-primary btn-lg mt-4 w-100">Konfirmasi Pembelian</button>
    </form>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    let no = {{ isset($valueFormBefore) ? count($valueFormBefore['phones']) + 1 : 2 }};

    // Add new select input
    $("#add-select").on("click", function() {
        let html = `<br><div id="phones-${no}" class="d-flex align-items-center mb-2">
            <select name="phones[]" class="form-select me-2">
                <option selected hidden disabled>Pesanan ${no}</option>
                @foreach ($phones as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endforeach
            </select>
            <span style="cursor:pointer" class="text-danger remove-phone">X</span>
        </div>`;
        
        $("#wrap-phones").append(html);
        no++;
    });

    // Event for removing a medicine entry
    $(document).on("click", ".remove-phone", function() {
        $(this).closest("div").remove();
        no--;
    });
</script>
@endpush

<style>
    /* Sponsor Logo Styling */
    .sponsor-logo {
        max-width: 100px;
        height: auto;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.6);
    }

    .form-label {
        font-weight: 600;
        color: #343a40;
    }

    .form-control {
        border-radius: 0.5rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .text-primary {
        font-weight: bold;
    }

    #add-select {
        margin-top: 10px;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
