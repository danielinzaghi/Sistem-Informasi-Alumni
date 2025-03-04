<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function handleForm(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'date' => 'required|date',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        // Mengambil data dari form
        $title = $request->input('name');
        $phoneNumber = $request->input('phone_number');
        $date = $request->input('date');
        $category = $request->input('category');
        $description = $request->input('description');

        // Format data menjadi "title|phone_number|date|category|desc"
        $formattedData = "$title|$phoneNumber|$date|$category|$description";

        // Tampilkan data yang diformat menggunakan dd()
        dd($formattedData);
        return ke view yang namanya broadcast lalu ke dalam input yang ini
    }
}