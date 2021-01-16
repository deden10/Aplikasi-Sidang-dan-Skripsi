<?php

namespace App\Http\Controllers;

use App\Prasidang;
use App\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ViewprasidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Session::get('login')){
            if (Session::get('hak_akses') == 'mahasiswa'){
                    $data = DB::table('students')
                                ->join('auths', 'students.id_auth', '=', 'auths.id_auth')
                                ->select('students.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'dosen'){
                    $data = DB::table('lecturers')
                                ->join('auths', 'lecturers.id_auth', '=', 'auths.id_auth')
                                ->select('lecturers.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'lppm'){
                    $data = DB::table('institutions')
                                ->join('auths', 'institutions.id_auth', '=', 'auths.id_auth')
                                ->select('institutions.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                } else if(Session::get('hak_akses') == 'prodi'){
                    $data = DB::table('departments')
                                ->join('auths', 'departments.id_auth', '=', 'auths.id_auth')
                                ->select('departments.*', 'auths.*')
                                ->where('auths.id_auth', Session::get('id_auth'))
                                ->first();
                }
            return view('viewprasidang/index', compact('data'));
        }else{
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function dataTable()
    {
        if(Session::get('login')){
         $data = DB::table('prasidang')
        ->join('students','prasidang.nim','=','students.nim')
        ->select('students.*','prasidang.*')
        ->where([['students.jurusan', '=', 'Teknik Informatika'],['status' , '=', 'terima'],['students.tahun','=',date('Y')]])
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/prasidang/skripsi/'.$data->file_skripsi;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }else{
        return redirect('login');
    }
    }
    public function dataTable2()
    {
        if(Session::get('login')){
         $data = DB::table('prasidang')
        ->join('students','prasidang.nim','=','students.nim')
        ->select('students.*','prasidang.*')
        ->where([['students.jurusan', '=', 'Sistem Informasi'],['status' , '=', 'terima'],['students.tahun','=',date('Y')]])
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/prasidang/skripsi/'.$data->file_skripsi;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }else{
        return redirect('login');
    }
    }
    public function dataTable3()
    {
        if(Session::get('login')){
         $data = DB::table('prasidang')
        ->join('students','prasidang.nim','=','students.nim')
        ->select('students.*','prasidang.*')
        ->where([['students.jurusan', '=', 'Manajemen Informatika'],['status' , '=', 'terima'],['students.tahun','=',date('Y')]])
         ->get();
        return DataTables::of($data)
        ->addColumn('skripsi', function($data){
             $path = 'upload/prasidang/skripsi/'.$data->file_skripsi;
            return view('prasidang.link_download', [
                'data' => $data,
                'title' => $data->file_skripsi,
                'url_download' => $path
            ]);
        })
        ->addIndexColumn()
        ->rawColumns(['skripsi'])
        ->make(true);
    }else{
        return redirect('login');
    }
    }
    
}
