<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

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
        $request->validate(self::validationRule());
        if (Barang::create($request->all())) {    
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
        return View('barang.edit', compact('model'));
    }

    public function update(Request $request, $id) {   
        $request->validate(self::validationRule());
        $model = Barang::findOrFail($id);
        if ($model->update($request->all())) {    
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

    public function validationRule() {
        return [
            'nama' => 'required',
            'harga' => 'required|numeric',
        ];
    }
}
