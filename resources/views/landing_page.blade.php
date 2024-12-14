@extends('templates.app')
{{-- extends : mengimport/memanggil file view (biasanya untuk template nya, isi dr template merupakan content tetap/content yg selalu ada di setiap halaman) --}}

{{-- section : mengisi element html ke yield dengan nama yg sama ke file templatenya --}}
@section('content-dinamis')
@if (Session::get('failed'))
<div class="alert alert-danger">{{Session::get('failed')}}</div>
@endif
    <h1 class="mt-5">selamat datang , {{ Auth::user()->name }}</h1>
@endsection