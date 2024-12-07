<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    // Menampilkan halaman kategori
    public function index()
    {
        $categories = Category::all(); // Ambil semua data kategori
        return view('kategori.index', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('kategori.show', compact('categories'));
    }

    // Method untuk generate PDF report
    public function generateReport()
    {
        $categories = Category::all(); // Ambil semua data kategori

        // Load view dan render ke dalam PDF
        $pdf = PDF::loadView('kategori.report', compact('categories'));

        // Return PDF sebagai response
        return $pdf->download('kategori_report.pdf');
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg',
            'categories' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
        ]);

        $photo = $request->file('photo')->store('uploads');

        Category::create([
            'photo' => $photo,
            'categories' => $request->categories,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('kategori.edit', compact('categories'));
    }

    // Memperbarui data kategori
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
            'categories' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('uploads');
        } else {
            $photo = $category->photo;
        }

        $category->update([
            'photo' => $photo,
            'categories' => $request->categories,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
