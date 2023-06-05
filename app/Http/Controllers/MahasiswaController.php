<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
{
return view('index');
}

    public function read()
    {
        $model=new Mahasiswa();
        $datax=$model->all();
        foreach($datax as $dt){
            $data[]=[
                'nim'=>$dt->nim,
                'nama'=>$dt->nama,
                'umur'=>$dt->umur,
                'alamat'=>$dt->alamat,
                'kota'=>$dt->kota,
                'kelas'=>$dt->kelas,
                'jurusan'=>$dt->jurusan
            ];
        }

        if (!empty($data)){
            $success = true;
            $massage = "Data berhasil dibaca";
        }else{
            $success = false;
            $massage = "Data tidak ditemukan/kosong";
        }
        $balikan = [
            "success"=>$success,
            "massage"=>$massage,
            "data"=> @$data
        ];

        return response()->json($balikan);
    }

    public function create(Request $req)
    {
        $model=new Mahasiswa();
        $model->nim=$req->nim;
        $model->nama=$req->nama;
        $model->umur=$req->umur;
        $model->alamat=$req->alamat;
        $model->kota=$req->kota;
        $model->kelas=$req->kelas;
        $model->jurusan=$req->jurusan;
        if($model->save()){
            $success=true;
            $massage="Data berhasil disimpan";
        }else{
            $success=false;
            $massage="Data gagal disimpan";
        }

        $balikan = [
            "success"=>$success,
            "massage"=>$massage,
            "data"=> @$req->all()
        ];

        return response()->json($balikan);
    }
}