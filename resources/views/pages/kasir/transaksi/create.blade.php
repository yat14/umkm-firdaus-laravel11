@extends('layouts.kasir.main')
@section('title', 'Kasir Tambah Transaksi')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Transaksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('kasir.dashboard') }}" style="color: #1A5F3C;">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('kasir.transaksi.index') }}" style="color: #1A5F3C;">Transaksi</a></div>
                <div class="breadcrumb-item">Tambah Transaksi</div>
            </div>
        </div>

        <a href="{{ route('kasir.transaksi.index') }}" class="btn btn-icon icon-left" style="background-color: #1A5F3C; color: #fff; box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);">Kembali</a>
        
        <div class="card mt-4">
            <form action="{{ route('kasir.transaksi.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kasir">Kasir</label>
                                <input type="text" class="form-control" id="kasir" value="{{ Auth::user()->nama }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status Transaksi</label>
                                <select id="status" name="status" class="form-control" required="">
                                    <option value="pending">Pending</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Status transaksi harus dipilih!
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk produk -->
                    <div id="produk_section">
                        <div class="row produk_row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="produk[]">Produk</label>
                                    <select name="produk[]" class="form-control" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Produk harus dipilih!
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="total_barang[]">Jumlah</label>
                                    <input type="number" name="total_barang[]" class="form-control" min="1" required>
                                    <div class="invalid-feedback">
                                        Jumlah produk harus diisi!
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-danger remove-produk" style="margin-top: 32px;">Hapus</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add_more_produk" class="btn mt-3" style="background-color: #1A5F3C; color: #fff; box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5); margin-right: 25px;">Tambah Produk</button>

                    <button type="submit" class="btn btn-icon icon-left mt-3" style="background-color: #1A5F3C; color: #fff; box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    // Event listener untuk menambah baris produk
    document.getElementById('add_more_produk').addEventListener('click', function () {
        // Clone row template
        const produkRow = document.querySelector('.produk_row');
        const newProdukRow = produkRow.cloneNode(true);

        // Reset nilai input pada row baru
        const inputs = newProdukRow.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (input.tagName === 'INPUT') input.value = '';
            if (input.tagName === 'SELECT') input.selectedIndex = 0;
        });

        // Tambahkan row baru ke container
        document.getElementById('produk_section').appendChild(newProdukRow);

        // Tambahkan event listener untuk tombol hapus pada row baru
        newProdukRow.querySelector('.remove-produk').addEventListener('click', function () {
            this.closest('.produk_row').remove();
        });
    });

    // Event listener untuk tombol hapus pada row pertama
    document.querySelector('.remove-produk').addEventListener('click', function () {
        this.closest('.produk_row').remove();
    });
</script>
@endsection
