@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Produk</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari SKU / Nama Produk..." value="{{ request('search') }}">
            </div>
            <div class="col-md-5">
                <select name="category_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><code>{{ $product->sku }}</code></td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $product->category->name }}</span></td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            @if($product->stock <= $product->minimum_stock)
                                <span class="badge bg-danger">{{ $product->stock }} (Stok Menipis)</span>
                            @else
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#stockModal{{ $product->id }}">
                                + / - Stok
                            </button>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Kelola Stok -->
                    <div class="modal fade" id="stockModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('products.stock.store', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Kelola Stok - {{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Transaksi</label>
                                            <select name="type" class="form-select" required>
                                                <option value="IN">Stok Masuk (IN)</option>
                                                <option value="OUT">Stok Keluar (OUT)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah</label>
                                            <input type="number" name="quantity" class="form-control" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catatan / Keterangan</label>
                                            <textarea name="notes" class="form-control" rows="2" placeholder="Contoh: Restock barang / Penjualan"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection