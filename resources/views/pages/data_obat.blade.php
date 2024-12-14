@extends('templates.app')

@section('content-dinamis')
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form class="d-flex me-3" action="{{ route('data_hp.data') }}" method="GET">
                {{-- 1. tag form harus ada action sama method
                    2. value method GET/POST
                        - GET : form yg fungsinya untuk mencari
                        - POST : form yg fungsinya untuk menambah/menghapus/mengubah
                    3. input harus ada attr name, name => mengambil data dr isian input agar bisa di proses di controller
                    4. ada button/input yg type="submit"
                    5. action
                        - form untuk mencari : action ambil route yg menampilkan halaman blade ini (return view blade ini)
                        - form bukan mencari : action terpisah dengan route return view bladenya
                 --}}
                @if (Request::get('sort_stock') == 'stock')
                    <input type="hidden" name="sort_stock" value="stock">
                @endif
                <input type="text" name="cari" placeholder="Cari Nama Obat..." class="form-control me-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <form action="{{ route('data_hp.data') }}" method="GET" class="me-2">
                <input type="hidden" name="sort_stock" value="stock">
                <button type="submit" class="btn btn-primary">Urutkan Stok</button>
            </form>
            {{-- <button class="btn btn-success">+ Tambah</button> --}}

            <a href="{{ route('data_hp.tambah') }}" class="btn btn-success">+ Tambah</a>
        </div>
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>No</th>
                <th>Nama Handphone</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                {{-- jika data obat kosong --}}
                @if (count($phones) < 0)
                    <tr>
                        <td colspan="6">Data Handphone Kosong</td>
                    </tr>
                @else
                    {{-- $medicines : dari compact controller nya, diakses dengan loop karna data $medicines banyak (array) --}}
                    @foreach ($phones as $index => $item)
                        <tr>
                            <td>{{ ($phones->currentPage() - 1) * $phones->perpage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }}" style="cursor: pointer" onclick="showModalStock({{$item['id']}}, {{$item['stock']}})">{{ $item['stock'] }}</td>
                            {{-- $item['column_di_migration'] --}}
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('data_hp.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="showModalDelete('{{ $item->id }}','{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        


        {{-- memanggil pagination --}}
        <div class="d-flex justify-content-end my-3">
            {{ $phones->links() }}
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS DATA HANDPHONE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        apakah anda yakin ingin menghapus Data Handphone <b id="nama_obat"></b>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                        <button type="submit" class="btn btn-danger">hapus</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- modal stok --}}
        <div class="modal fade" id="modalEditStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT STOCK OBAT</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control">
                        </div>
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModalDelete(id, name) {
            $('#nama_obat').text(name);
            $('#exampleModal').modal('show');
            let url = "{{ route('data_hp.hapus' , ':id')}}";
            url = url.replace(':id', id);
            $("form").attr('action',url);
            $("exampleModal").modal('show');
        }

        function showModalStock(id, stock) {
            $('#stock').val(stock);
            let url = "{{ route('data_hp.ubah.stock' ,':id')}}";
            url = url.replace(':id', id);
            $("form").attr('action',url);
            $("#modalEditStock").modal('show');
        }

        @if (Session::get('failed')) 
        $(document).ready(function() {
            let id = "{{Session::get('id')}}";
            let stock = "{{Session::get('stock')}}";
            showModalStock(id, stock);
        })
        @endif
            
        
    </script>
@endpush
