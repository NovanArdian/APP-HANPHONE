@extends('templates.app')


@section('content-dinamis')
{{-- <div class="container">
    <h1>Create</h1>
</div> --}}

<form action="{{ route('data_hp.ubah.proses', $phone['id'])}}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Obat: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $phone['name'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jenis Obat: </label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disabled hidden>Pilih</option>
                <option value="64 gb" {{ $phone['type'] == "64 gb" ? 'selected' : '' }}>64 gb</option>
                <option value="128 gb" {{ $phone['type'] == "128 gb" ? 'selected' : '' }}>128 gb</option>
                <option value="256 gb" {{ $phone['type'] == "256 gb" ? 'selected' : '' }}>256 gb</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Harga: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="price" value="{{ $phone['price'] }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
