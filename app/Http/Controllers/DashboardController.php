<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; // Pastikan model Stock sudah ada

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data stocks dari database
        $stocks = Stock::all();

        // Kirim data ke view
        return view('auth.dashboard', ['stocks' => $stocks]);

        $query = Stock::query();

    // Filter berdasarkan kategori jika ada
    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    // Ambil data stok beserta kategori dan ingredient
    $stocks = $query->with(['category', 'ingredient'])->paginate(10);

    // Loop untuk menghitung stok akhir (misalnya, stok awal + barang masuk - barang keluar)
    foreach ($stocks as $stock) {
        $stock->stok_akhir = $stock->jumlah + $stock->barangMasuk()->sum('jumlah') - $stock->barangKeluar()->sum('jumlah');
    }

    return view('auth.dashboard', [
        'stocks' => $stocks,
        'categories' => Category::all()
    ]);

    }

        public function updateStock(Request $request, $id)
    {
        $stock = Stock::find($id);
        $stock->jumlah = $request->input('stock');
        $stock->save();

        return response()->json(['success' => true]);
    }

}
