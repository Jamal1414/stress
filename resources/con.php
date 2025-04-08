<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BurikController extends Controller
{
   public function index()
   {
    return view('suki');
   }

   public function logika(Request $request)
   {
        $request->validate([
            'angka1' => 'required|numeric',
            'angka2' => 'required|numeric',
            'operator' => 'required|in:+,-,*,/',
        ]);

        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $operator = $request->operator;
        $hasil = 0;

        switch ($operator) {
            case '+':
                $hasil = $angka1 + $angka2;
                break;
            case '-':
                $hasil = $angka1 - $angka2;
                break;
            case '*':
                $hasil = $angka1 * $angka2;
                break;
            case '/':
                $hasil = $angka2 !=0 ? $angka1 / $angka2 : 'Tidak dpt membagi 0';
                break;
        }
        return view('fix', compact('hasil'));
   }
}
