<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Login2;
use Illuminate\Http\Request;

class penggunaController extends Controller
{
    public function index()
    {
        $data = Login2::orderBy('nama','asc')-> get();
        return response()->json([
            'status' => true,
            'massage' => 'data ditemukan',
            'data'=>$data
        ],200);  
    }

    public function destroy($id)
    {
        $fashion = Login2::findOrFail($id);
        $fashion->delete();
    
        return response()->json(['success' => 'Item deleted successfully!']);
    }
}
