<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\customers;
use Illuminate\Support\Facades\Validator;
class customers extends Controller
{
    public function show()
 {
 $data_siswa = customers::join('kelas', 'kelas.id_order', 'siswa.id_order')->get();
 return Response()->json($data_siswa);
 }
 public function detail($id)
 {
 if(customers::where('id', $id)->exists()) {
 $data_siswa = customers::join('kelas', 'kelas.id_order', 'siswa.id_order')
 ->where('siswa.id', '=', $id)
 ->get();

 return Response()->json($data_siswa);
 }
 else {
 return Response()->json(['message' => 'Tidak ditemukan' ]);
 }
 }
 public function store(Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_customer' => 'required',
 'tanggal_lahir' => 'required',
 'gender' => 'required',
 'alamat' => 'required',
 'id_order' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $simpan = customers::create([
 'nama_customer' => $request->nama_customer,
 'tanggal_lahir' => $request->tanggal_lahir,
 'gender' => $request->gender,
 'alamat' => $request->alamat,
 'id_order' => $request->id_order
 ]);
 if($simpan)
 {
 return Response()->json(['status' => 1]);
 }
 else
 {
 return Response()->json(['status' => 0]);
 }
 }
 public function update($id, Request $request)
 {
 $validator=Validator::make($request->all(),
 [
 'nama_customer' => 'required',
 'tanggal_lahir' => 'required',
 'gender' => 'required',
 'alamat' => 'required',
 'id_order' => 'required'
 ]
 );
 if($validator->fails()) {
 return Response()->json($validator->errors());
 }
 $ubah = customers::where('id', $id)->update([
 'nama_customer' => $request->nama_customer,
 'tanggal_lahir' => $request->tanggal_lahir,
 'gender' => $request->gender,
 'alamat' => $request->alamat,
 'id_order' => $request->id_order
 ]);
 if($ubah) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }
 public function destroy($id)
 {
 $hapus = customers::where('id', $id)->delete();
 if($hapus) {
 return Response()->json(['status' => 1]);
 }
 else {
 return Response()->json(['status' => 0]);
 }
 }
}
