<?php

namespace App\Http\Controllers;

use PDF;
use data;
use Dompdf\Dompdf;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Svg\Tag\Rect;

class EmployeeController extends Controller
{
    public function index(Request $request){

        if($request->has('search')){
            $data = Employee::where('nama','LIKE','%' .$request->search. '%')->paginate(10);
        }else{
            $data = Employee::paginate(5);
        }

        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());
        $data=Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success','Data Berhasil di Tambah');
    }

    public function tampildata($id){
        $data = Employee::find($id);
        return view('editdata', compact('data'));
    }

    public function updatedata(Request $request, $id){
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success','Data Berhasil di Update');
    }

    public function delete($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success','Data Berhasil di Hapus');
    }

    public function exportpdf(){
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    public function exportexcel(){
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport,\public_path('/EmployeeData/'.$namafile));
        return redirect()->back();
    }

}
