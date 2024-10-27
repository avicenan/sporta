<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockLogController extends Controller
{
    public function index()
    {
        $stockLogs = StockLog::orderBy('created_at', 'desc')->paginate(10);

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
        DB::beginTransaction();
        try {
            $stockLog = StockLog::create($validatedData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

        // Return json response
        return response()->json(['success' => true, 'log' => $stockLog]);
    }
}
