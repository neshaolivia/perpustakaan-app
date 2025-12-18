<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index($id_user)
    {
        return Favorite::where('id_user', $id_user)->with('book')->get();
    }

    public function store(Request $request)
    {
        return Favorite::create($request->all());
    }

    public function destroy($id)
    {
        Favorite::destroy($id);
        return response()->json(['message' => 'Favorite dihapus']);
    }
}
