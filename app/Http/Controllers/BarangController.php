<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\BarangSatuan;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index() {    	
    	return View('barang.index');
    }

    public function get() {
    	$model = Barang::all();
    	return View('barang.get', compact('model'));
    }

    public function create() {
        return View('barang.create');
    }

    public function store(Request $request) { 
        $rules = self::validationRule($request->all());
        $message = self::validationMessage($request->all());           
        $validator = Validator::make($request->all(), $rules, $message);    
        if ($validator->fails()) {
            return response()->json([
                'message'  => 'Terjadi kesalahan input',
                'errors' => $validator->messages()
            ], 400);
        }    
        if ($barang = Barang::create($request->all())) {   
            if ($request->post('satuan')) {
                foreach ($request->post('satuan') as $satuan) {
                    $satuan['id_barang'] = $barang->id;
                    BarangSatuan::create($satuan);
                } 
            }
            return [
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data gagal disimpan'
            ];
        }
    }

    public function edit($id) {
        $model = Barang::findOrFail($id);
        $model->satuan = BarangSatuan::where('id_barang', $id)->get();        
        return View('barang.edit', compact('model'));
    }

    public function update(Request $request, $id) {   
        $rules = self::validationRule($request->all());
        $message = self::validationMessage($request->all()); 
        $model = Barang::findOrFail($id);
        if ($model->update($request->all())) {
            BarangSatuan::where('id_barang', $id)->delete();
            if ($request->post('satuan')) {
                foreach ($request->post('satuan') as $satuan) {
                    $satuan['id_barang'] = $model->id;
                    BarangSatuan::create($satuan);
                } 
            }    
            return [
                'success' => true,
                'message' => 'Data berhasil diperbarui'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Data gagal diperbarui'
            ];
        }
    }

    public function delete($id) {
    	$model = Barang::find($id);    	
    	if ($model) {
    		if ($model->delete()) {
    			return [
	    			'success' => true,
	    			'message' => 'Data berhasil dihapus'
	    		];
    		} else {
    			return [
	    			'success' => false,
	    			'message' => 'Data gagal dihapus'
	    		];
    		}
    	} else {
    		return [
    			'success' => false,
    			'message' => 'Data tidak ditemukan'
    		];
    	}
    }

    public function validationRule($data) {
        $rules = [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required'
        ];                
        if (isset($data['satuan'])) {
            foreach ($data['satuan'] as $key => $satuan) {
               $rules['satuan.'.$key.'.satuan'] = 'required'; 
               $rules['satuan.'.$key.'.x'] = 'required|numeric';
               $rules['satuan.'.$key.'.y'] = 'required|numeric';               
            }            
        }
        return $rules;
    }

    public function validationMessage($data) {        
        $messages = [];
        $countSatuan = 1;
        if (isset($data['satuan'])) {
            foreach ($data['satuan'] as $key => $satuan) {           
               $messages['satuan.'.$key.'.satuan.required'] = 'Satuan ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.x.required'] = 'X ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.y.required'] = 'Y ke-'.$countSatuan.' harus diisi.';
               $messages['satuan.'.$key.'.x.numeric'] = 'X ke-'.$countSatuan.' harus angka.';
               $messages['satuan.'.$key.'.y.numeric'] = 'Y ke-'.$countSatuan.' harus angka.';
               $countSatuan++;
            }   
            }         
        return $messages;
    }    
}
