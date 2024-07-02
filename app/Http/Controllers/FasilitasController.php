<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;   // Sesuaikan namespace dan import model di sini
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(5);
     
        return view('index', compact('fasilitas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
     
        Fasilitas::create($input);
      
        return redirect()->route('index')
                        ->with('success','Fasilitas created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        return view('show',compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::find($id);
        $editMode = true; // Tandai bahwa Anda sedang dalam mode pengeditan
    
        return view('edit', compact('fasilitas', 'editMode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'kategori' => 'required',
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
           
        $fasilitas->update($input);
     
        return redirect()->route('index')
                        ->with('success','Fasilitas updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
      
        return redirect()->route('index')
                        ->with('success','Product deleted successfully');
    }

    function fasilitas()
    {
        return view('pegawai/konsumsi');
    }
}
