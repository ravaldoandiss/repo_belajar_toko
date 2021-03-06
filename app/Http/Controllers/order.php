<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\order;
use Illuminate\Support\Facades\Validator;
class order extends Controller
{
    public function show()
{
 return order::all();
}

 public function store(Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_order' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = order::create([
 'nama_order' => $request->nama_kelas
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
 $hapus = order::where('id', $id)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }

}
