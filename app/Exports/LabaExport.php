<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromView;

use App\Models\Users;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductsPurchase;

class LabaExport implements FromView, WithColumnWidths
{

    public function columnWidths(): array{
        return [
            'A' => 15,
            'B' => 15,
            'C' => 20,
            'D' => 35,
            'E' => 23,
            'F' => 23,
            'G' => 23,
            'H' => 23,
            'I' => 23,
            'J' => 23,
            'K' => 23,
            'L' => 23,
            'M' => 23,
            'N' => 23,
            'O' => 23,
            'P' => 23,
            'Q' => 23,
            'R' => 23,
            'S' => 23,
            'T' => 23,
            'U' => 23,
            'V' => 23,
            'W' => 23,
            'X' => 23,
            'Y' => 23,
            'Z' => 23,
            'AA' => 23,
            'AB' => 23,
            'AC' => 23,
            'AD' => 23,
            'AE' => 23,
            'AF' => 23,
            'AG' => 23,
            'AH' => 23,
            'AI' => 23,
            'AJ' => 23,
            'AK' => 23,
            'AL' => 23,
            'AM' => 23,
            'AN' => 23,
            'AO' => 23,
            'AP' => 23,
            'AQ' => 23,
            'AR' => 23,
            'AS' => 23,
            'AT' => 23,
            'AU' => 23,
            'AV' => 23,
            'AW' => 23,
            'AX' => 23,
            'AY' => 23,
            'AZ' => 23,
            'BA' => 23,
        ];
    }

    public function view(): View
    {
        $users = Users::all();
        $invoice = Invoice::where('status_pembayaran', 'Paid')->where('status_pembayaran', 'Paid')->get();
        $products = ProductsPurchase::all();
        return view('exports/laba_exports', [
            'invoice' => $invoice, 
        ]);
    }
}