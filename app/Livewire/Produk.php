<?php

namespace App\Livewire;

use App\Models\Produk as ModelProduk;
use App\Models\User as ModelUser;
use Livewire\Component;

class Produk extends Component
{
    public $pilihanMenu = 'lihat';
    public $name;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;

public function pilihEdit($id)
{
    $this->produkTerpilih = ModelProduk::findOrFail($id);
    $this->name = $this->produkTerpilih->name;
    $this->kode = $this->produkTerpilih->kode;
    $this->stok = $this->produkTerpilih->stok;
    $this->harga = $this->produkTerpilih->harga;
    $this->pilihanMenu = 'edit';
}

public function simpanEdit()
{
    $rules = [
        'name' => 'required',
        'kode' => 'required|unique:produks,kode,' . $this->produkTerpilih->id,
        'harga' => 'required|numeric',
        'stok' => 'required|numeric'
    ];
    $this->validate($rules);

    $this->produkTerpilih->name = $this->name;
    $this->produkTerpilih->kode = $this->kode;
    $this->produkTerpilih->harga = $this->harga;
    $this->produkTerpilih->stok = $this->stok;
    $this->produkTerpilih->save();

    session()->flash('message', 'Produk berhasil diupdate');
    $this->reset(['name', 'kode', 'harga', 'stok', 'produkTerpilih']);
    $this->pilihanMenu = 'lihat';
}

public function pilihMenu($menu)
{
        $this->pilihanMenu = $menu;
}

public function pilihHapus($id)
{
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
}


public function hapus()
{
    $this->produkTerpilih->delete();
    $this->reset();
}

    public function batal()
    {
        $this->reset();
    }

    public function simpan()
    {
        $this->validate([
            'name' => 'required',
            'kode' => 'required|unique:produks',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        ModelProduk::create([
            'name' => $this->name,
            'kode' => $this->kode,
            'harga' => $this->harga,
            'stok' => $this->stok
        ]);

        session()->flash('message', 'Produk berhasil ditambahkan');
        $this->reset(['name', 'kode', 'harga', 'stok']);
        $this->pilihanMenu = 'lihat';
    }
    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}
