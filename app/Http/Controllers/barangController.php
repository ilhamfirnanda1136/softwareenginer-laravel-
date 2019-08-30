<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use DB;
class barangController extends Controller
{
    public function index()
    {
    	$databarang=barang::paginate(10);
    	$url=request()->segment(1);
    	switch ($url) {
    		case 'admin':
    			$part='admin';
    			break;
    		case 'owner':
    			$part='owner';
    			break;
    		case 'staff':
    			$part= 'staff';
    			break;
    		default:
    			return redirect(404);
    			break;
    	}
    	return view('barang',['part'=>$part,'barangs'=>$databarang]);   							
    }

    public function editbarang($id)
    {
        $databarang=barang::find($id);
       return response()->json($databarang,200);
    }
    
    protected function kodeOtomatis()
    {
    	$kode_barang='kode_barang';
    	$barang=DB::table('barang')->select(DB::raw('MAX(RIGHT('.$kode_barang.',5)) as kd_max'));
        if($barang->count()>0)
        {
            foreach($barang->get() as $loopbarang)
            {
                $tmp = ((int)$loopbarang->kd_max)+1;
                $kode = "BRG".sprintf("%05s",$tmp);
            }
        }
        else
        {
            $kode = "BRG"."00001";
        }
        return $kode;
    }
    public function proses(Request $request)
    {
	   	if(is_null($request->idbarang))
	    {
	    	$barang=new barang();
	    	$barang->kode_barang=$this->kodeOtomatis();
	    }
	    else
	    {
	      $barang=barang::where('id','=',$request->idbarang)->first();
	    }
	  		$barang->nama_barang=$request->nama_barang;
	  		$barang->stok=$request->stok;
	  		$barang->harga_jual=$request->harga_jual;
	  		$barang->harga_beli=$request->harga_beli;
	  		$barang->save();
	  		return redirect()->back()->with('sukses','data berhasil dieksekusi');
    }
    public function hapusBarang($id)
    {
    	$barang=barang::find($id);
        $barang->delete();
        return redirect()->back()->with('sukses','data berhasil dihapus');
    }
}
