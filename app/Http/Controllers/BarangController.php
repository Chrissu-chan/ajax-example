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
}
