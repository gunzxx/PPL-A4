<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class PengelolaInventoryController extends Controller
{
    public function showInventory()
    {
        $inventories = Inventory::where('user_id', auth()->user()->id)->paginate(10);
        return view('inventory.pengelola.inventory', [
            "css" => ['main', 'inventory/inventory'],
            'inventories' => $inventories,
        ]);
    }

    public function create()
    {
        return view('inventory.pengelola.create', [
            "css" => ['main', 'inventory/inventory']
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "bean_type" => "required|max:255",
            "stok" => "required|numeric",
        ]);
        $validated['user_id'] = auth()->user()->id;

        Inventory::create($validated);

        return redirect(auth()->user()->getRoleNames()[0] . '/inventory')->with('sukses', 'Data has been added');
    }

    public function manage()
    {
        $inventories = Inventory::where('user_id', auth()->user()->id)->paginate(10);
        return view('inventory.pengelola.manage', [
            "css" => ['main', 'inventory/inventory', 'inventory/manage'],
            'inventories' => $inventories,
        ]);
    }

    public function edit(Inventory $inventory)
    {
        if ($inventory->user_id != auth()->user()->id) {
            return abort(403);
        }
        return view('inventory.pengelola.edit', [
            "css" => ['main', 'inventory/inventory', 'inventory/edit'],
            "inventory" => $inventory,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "bean_type" => "required|max:255",
            "stok" => "required|numeric",
        ]);

        $id = $request->only('inv_id');

        Inventory::where('id', $id)->update($validated);
        return redirect(auth()->user()->getRoleNames()[0] . '/inventory/update')->with(['success', 'Data berhasil diperbarui!']);
    }

    public function delete(Request $request)
    {
        if (!$request->post('id')) {
            return response()->json([
                'message' => "Id not found",
            ], 401);
        }

        $id = $request->post('id');

        Inventory::find($id)->delete();
        return response()->json([$id, 'data' => 'data1','message'=>"Data berhasil dihapus"], 200);
    }
}
