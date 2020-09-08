<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Kelas;
use Illuminate\Support\Facades\Validator;
class product extends Controller
{
    public function show()
{
 return Kelas::all();
}

 public function store(Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_product' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = Kelas::create([
 'nama_product' => $request->nama_product
 ]);
 if($simpan) {
 return Response()->json(['status'=>1]);
 }
 else {
 return Response()->json(['status'=>0]);
 }
 }
}
