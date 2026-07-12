<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengeluaran = DB::table('expenses')
            ->when($search, function ($query, $search) {
                return $query->where('notes', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%");
            })
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        return view('dashboard.pengeluaran.index', compact('pengeluaran', 'search'));
    }

    public function create()
    {
        return view('dashboard.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'category' => 'required|string|max:100',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $expense = DB::table('expenses')->insertGetId([
            'amount' => $request->amount,
            'category' => $request->category,
            'notes' => $request->notes,
            'expense_date' => $request->expense_date,
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Log aktivitas
        ActivityLogger::log(
            'create',
            'Mencatat pengeluaran: ' . ($request->notes ?: $request->category) . ' sebesar Rp ' . number_format($request->amount),
            'expenses',
            $expense
        );

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dicatat!');
    }

    public function edit($id)
    {
        $pengeluaran = DB::table('expenses')->where('id', $id)->first();
        return view('dashboard.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'category' => 'required|string|max:100',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        DB::table('expenses')->where('id', $id)->update([
            'amount' => $request->amount,
            'category' => $request->category,
            'notes' => $request->notes,
            'expense_date' => $request->expense_date,
            'updated_at' => now(),
        ]);

        // Log aktivitas
        ActivityLogger::log(
            'update',
            'Mengupdate pengeluaran: ' . ($request->notes ?: $request->category),
            'expenses',
            $id
        );

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $expense = DB::table('expenses')->where('id', $id)->first();

        // Log aktivitas sebelum delete
        ActivityLogger::log(
            'delete',
            'Menghapus pengeluaran: ' . ($expense->notes ?? $expense->category ?? 'Unknown'),
            'expenses',
            $id
        );

        DB::table('expenses')->where('id', $id)->delete();

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
