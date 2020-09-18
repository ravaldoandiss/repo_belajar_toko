<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\product;
use Illuminate\Support\Facades\Validator;
class product extends Controller
{
    public function show()
{
 return product::all();
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
 $simpan = product::create([
 'nama_product' => $request->nama_product
 ]);
 if($simpan) {
 return Response()->json(['status'=>1]);
 }
 else {
 return Response()->json(['status'=>0]);
 }
 }
 public function destroy($id)
 {
 $hapus = product::where('id', $id)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }
}
