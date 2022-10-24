<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $project = Project::all();
        return view('home', compact('project'));
    }

    public function index()
    {
        $project = Project::all();
        return view('dashboard.index', compact('project'));
    }

    public function post(Request $request)
    {
        $date = date('Ymd His gis');
        $project = new Project();
        $project->kategori = $request->kategori;
        $project->judul = $request->judul;
        $project->deskripsi = $request->deskripsi;

        if($request->hasFile('gambar')){
            $request->file('gambar')->move('app/assets/images/others/', $date.$request->file('gambar')->getClientOriginalName());
            $project->gambar = $date.$request->file('gambar')->getClientOriginalName();
            $project->save();

            return redirect()->back()->with('success', 'Project telah ditambahkan');
        }

        return redirect()->back()->with('info', 'Project gagal ditambahkan');
    }

    public function delete($id)
    {
        $deleted = Project::where('id', $id)->delete();
        if($deleted){
            return redirect()->back()->with('success', 'Project telah dihapus');
        }
        return redirect()->back()->with('info', 'Project gagal dihapus');
    }
}
