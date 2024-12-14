<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('user')->orderBy('name_customer', 'ASC')->get();
    }

    public function headings(): array
    {
        return [
            'ID Pembelian',
            'Nama Kasir',
            'Daftar Obat',
            'Total Harga',
            'Nama Pembeli',
            'Tanggal Pembelian'
        ];
    }

    public function map($order): array
    {
        $daftarobat = "";

        foreach ($order->medicines as $key => $value) {
            $format = $key +1 . "." . $value['name_medicine'] . " (" . $value['qty'] . ") : Rp. " . number_format($value['sub_price'], 0, ',', '.');
            
            $daftarobat .= $format;
        }
        return [
            $order->id,
            $order->user->name,
            $daftarobat,
            number_format($order->total_price, 0, ',', '.'),
            $order->name_customer,
            $order->created_at->locale('id')->translatedFormat('l, j F Y H:i:s'),
        ];
    }

    
}
