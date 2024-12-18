<?php 
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil semua item untuk ditampilkan di halaman kasir
        $items = Item::all();

        // Mengambil semua transaksi untuk riwayat kasir
        $transactions = Transaction::with('item')->get();

        return view('kasir.index', compact('items', 'transactions'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1', // Validasi jumlah barang
        ]);

        // Mendapatkan item terkait
        $item = Item::findOrFail($request->item_id);

        // Menghitung total harga berdasarkan harga item dan quantity
        $total_harga = $item->harga * $request->quantity;

        // Membuat transaksi baru
        $transaction = Transaction::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'total_harga' => $total_harga,
        ]);

        // Mengurangi stok item
        $item->stok -= $request->quantity; // Kurangi stok
        $item->save(); // Simpan perubahan stok

        // Catat barang keluar ke StockHistory
        StockHistory::create([
            'ingredient_id' => $item->ingredient_id, // Ambil ingredient_id terkait item
            'kategori_id' => $item->category_id, // Ambil category_id terkait item
            'jumlah' => $request->quantity, // Jumlah yang keluar
            'unit' => $item->unit, // Satuan barang
            'tanggal' => now(), // Tanggal transaksi
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil ditambahkan!',
            'data' => $transaction,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $transaction = Transaction::findOrFail($id);
    
        // Mendapatkan item terkait
        $item = Item::findOrFail($request->item_id);
    
        // Menghitung total harga baru berdasarkan harga item dan quantity
        $total_harga = $item->harga * $request->quantity;
    
        // Mengupdate transaksi
        $transaction->update([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'total_harga' => $total_harga,
        ]);
    
        // Mengupdate stok item
        $item->stok -= $request->quantity; // Kurangi stok
        $item->save(); // Simpan perubahan stok
    
        // Catat barang keluar ke StockHistory
        StockHistory::create([
            'ingredient_id' => $item->ingredient_id,
            'kategori_id' => $item->category_id,
            'jumlah' => $request->quantity,
            'unit' => $item->unit,
            'tanggal' => now(),
        ]);
    
        return response()->json([
            'message' => 'Transaksi berhasil diperbarui!',
            'data' => $transaction,
        ]);
    }
    

        public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Mendapatkan item terkait untuk mengembalikan stok
        $item = Item::findOrFail($transaction->item_id);
        $item->stok += $transaction->quantity; // Kembalikan stok
        $item->save(); // Simpan perubahan stok

        // Menghapus transaksi
        $transaction->delete();

        return response()->json([
            'message' => 'Transaksi berhasil dihapus!',
        ]);
    }


    // Fungsi baru untuk menampilkan halaman summary
    public function summary()
    {
        // Ambil data transaksi terakhir atau yang sesuai
        $transactions = Transaction::latest()->get(); // Atau logika lain sesuai kebutuhan

        return view('summary', compact('transactions'));
    }
}
