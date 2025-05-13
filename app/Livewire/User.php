<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as UserModel;

class User extends Component
{
    public $pilihanMenu = 'lihat';
    public $name;
    public $email;
    public $password;
    public $peran;
    public $penggunaTerpilih;

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function pilihHapus($id){
        $this->penggunaTerpilih = UserModel::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

public function hapus()
{
    $this->penggunaTerpilih->delete();
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'peran' => 'required|in:admin,kasir'
        ]);

        UserModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'peran' => $this->peran
        ]);

        session()->flash('message', 'Pengguna berhasil ditambahkan');
        $this->reset(['name', 'email', 'password', 'peran']);
        $this->pilihanMenu = 'lihat';
    }

    public function render()
    {
        return view('livewire.user', [
            'semuaPengguna' => UserModel::all()
        ]);
    }
}
