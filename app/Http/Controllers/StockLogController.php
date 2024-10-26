<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use Illuminate\Http\Request;

class StockLogController extends Controller
{
    public function index()
    {
        $stockLogs = StockLog::paginate(10);

        return view('dashboard.stock-log.index', [
            'nav' => 'Riwayat Stok',
            'stockLogs' => $stockLogs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'stock_change' => 'required|integer|min:1',
            'type' => 'required|in:masuk,keluar',
            'information' => 'required|string|max:255',
        ]);

        // Create a new stock log
        $stockLog = StockLog::create($validatedData);

        // Return json response
        return response()->json(['success' => true, 'log' => $stockLog]);
    }
}
