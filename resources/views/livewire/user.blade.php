<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah pengguna
                </button>
                <button wire:loading class="btn btn-info">
                    Loading....
                </button>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-12">
                @if($pilihanMenu=='lihat')
                <div class="card border-primary">
                <div class="card-header">
                    Semua pengguna
                </div>
                    <div class="card-body">
                        test
                    </div>
                </div>
                    <div class="my-2">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                @foreach ($semuaPengguna as $pengguna)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->name }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>{{ $pengguna->peran }}</td>
                                        <td>
                                            <button wire:click="pilihMenu('edit')"
                                                 class="btn {{ $pilihanMenu=='edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                     Edit pengguna
                                             </button>
                                             <button wire:click="pilihHapus({{ $pengguna->id }})"
                                             class="btn {{ $pilihanMenu=='hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                 hapus pengguna
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
                <div class="card border-primary">
                <div class="card-header">
                    Tambah pengguna
                </div>
                    <div class="card-body">
                        <form wire:submit="simpan">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Peran</label>
                                <select class="form-control" wire:model="peran">
                                    <option value="">Pilih Peran</option>
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('peran')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
                @elseif ($pilihanMenu=='edit')
                <div class="card border-primary">
                <div class="card-header">
                    Edit pengguna
                </div>
                    <div class="card-body">
                        test
                    </div>
                </div>
                @elseif ($pilihanMenu=='hapus')
                <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Hapus pengguna
                </div>
                        <div class="card-header">
                         Anda yakin akan menghapus user ini?
                        </div>
                        <div class="my-2">
                            <div class="card-body">
                                <table class="table table-bordered">
                                     <thead>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Peran</th>
                                     </thead>
                                     <tbody>
                                            <tr>
                                                <td>{{ $penggunaTerpilih->name }}</td>
                                                <td>{{ $penggunaTerpilih->email }}</td>
                                                <td>{{ $penggunaTerpilih->peran }}</td>
                                                <td>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-end mb-4 pe-5">
                            <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                            <button class="btn btn-secondary" wire:click='batal'>Batal</button>
                        </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
