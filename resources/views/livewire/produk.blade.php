<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="fas fa-list"></i> Semua Produk
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu=='tambah' ? 'btn-success' : 'btn-outline-success' }}">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>
                <button wire:loading class="btn btn-info">
                    <i class="fas fa-spinner fa-spin"></i> Loading....
                </button>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                @if($pilihanMenu=='lihat')
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-box"></i> Daftar Produk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" style="width: 50px">No</th>
                                        <th>Nama Produk</th>
                                        <th>Kode</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center" style="width: 200px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $produk->name }}</td>
                                            <td>{{ $produk->kode }}</td>
                                            <td class="text-end">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $produk->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $produk->stok }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @elseif ($pilihanMenu=='tambah')
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-plus-circle"></i> Tambah Produk Baru
                        </h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpan" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        <input type="text" class="form-control" wire:model="name" placeholder="Masukkan nama produk">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode / Barcode</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                        <input type="text" class="form-control" wire:model="kode" placeholder="Masukkan kode produk">
                                    </div>
                                    @error('kode')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <input type="number" class="form-control" wire:model="harga" placeholder="Masukkan harga">
                                    </div>
                                    @error('harga')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-cubes"></i>
                                        </span>
                                        <input type="number" class="form-control" wire:model="stok" placeholder="Masukkan jumlah stok">
                                    </div>
                                    @error('stok')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button type="button" wire:click='batal' class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Produk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @elseif ($pilihanMenu=='edit')
                <div class="card border-warning">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="fas fa-edit"></i> Edit Produk
                        </h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpanEdit" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        <input type="text" class="form-control" wire:model="name" placeholder="Masukkan nama produk">
                                    </div>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode / Barcode</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-barcode"></i>
                                        </span>
                                        <input type="text" class="form-control" wire:model="kode" placeholder="Masukkan kode produk">
                                    </div>
                                    @error('kode')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <input type="number" class="form-control" wire:model="harga" placeholder="Masukkan harga">
                                    </div>
                                    @error('harga')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-cubes"></i>
                                        </span>
                                        <input type="number" class="form-control" wire:model="stok" placeholder="Masukkan jumlah stok">
                                    </div>
                                    @error('stok')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button type="button" wire:click='batal' class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @elseif ($pilihanMenu=='hapus')
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-trash"></i> Hapus Produk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Anda yakin akan menghapus produk ini?
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kode</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $produkTerpilih->name }}</td>
                                        <td>{{ $produkTerpilih->kode }}</td>
                                        <td>Rp {{ number_format($produkTerpilih->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produkTerpilih->stok }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button class="btn btn-secondary" wire:click='batal'>
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button class="btn btn-danger" wire:click='hapus'>
                                <i class="fas fa-trash"></i> Hapus Produk
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
