<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Carbon\Carbon;

class Laporan extends Component
{
    public $tanggalMulai;
    public $tanggalAkhir;
    public $printTanggalMulai;
    public $printTanggalAkhir;
    public $transaksi;

    public function mount()
    {
        $this->tanggalMulai = Carbon::today()->format('Y-m-d');
        $this->tanggalAkhir = Carbon::today()->format('Y-m-d');
        $this->filterTransaksi();
    }

    public function filterTransaksi()
    {
        $this->transaksi = Transaksi::where('status', 'selesai')
            ->when($this->tanggalMulai, function($query) {
                return $query->whereDate('created_at', '>=', $this->tanggalMulai);
            })
            ->when($this->tanggalAkhir, function($query) {
                return $query->whereDate('created_at', '<=', $this->tanggalAkhir);
            })
            ->latest()
            ->get();
    }

    public function resetFilter()
    {
        $this->tanggalMulai = Carbon::today()->format('Y-m-d');
        $this->tanggalAkhir = Carbon::today()->format('Y-m-d');
        $this->filterTransaksi();
    }

    public function printLaporan()
    {
        $this->printTanggalMulai = $this->printTanggalMulai ?? $this->tanggalMulai;
        $this->printTanggalAkhir = $this->printTanggalAkhir ?? $this->tanggalAkhir;

        // Redirect ke halaman cetak dengan parameter tanggal
        return redirect()->route('cetak', [
            'tanggal_mulai' => $this->printTanggalMulai,
            'tanggal_akhir' => $this->printTanggalAkhir
        ]);
    }

    public function render()
    {
        return view('livewire.laporan');
    }
}
