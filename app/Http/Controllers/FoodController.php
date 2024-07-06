<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Food::paginate(10);
        // dd($data);
        return view('food.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            
            'name'=> 'required',
            'description'=> 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
            'harga'=> 'required|numeric',
            
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(), 422
            );
        }

        $input = $request->all();

        if ($request->has('image')) {
            $gambar = $request->file('image');
            $nama_gambar = time() . '_' . preg_replace('/\s+/', '_', $gambar->getClientOriginalName());
            $gambar->move('uploads', $nama_gambar);
            $input['image'] = $nama_gambar;
        }
 
        Food::create($input);
          // Tambahkan pesan sukses ke sesi
         $request->session()->flash('success', 'Data berhasil disimpan.');

        return redirect('food');
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
        $data = Food::where('id',$id)->first();
     
        return view('food.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,webp',
            'harga' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $input = $request->all();

        // Hapus input yang tidak relevan
        unset($input['_token']);
        unset($input['_method']);
    
        // Handle upload gambar jika ada
    if ($request->hasFile('image')) {
        $food = Food::find($id);
        
        // Hapus gambar lama jika ada
        if ($food->image && File::exists(public_path('uploads/' . $food->image))) {
            File::delete(public_path('uploads/' . $food->image));
        }

        // Simpan gambar baru
        $gambar = $request->file('image');
        $nama_gambar = time() . '_' . preg_replace('/\s+/', '_', $gambar->getClientOriginalName());
        $gambar->move(public_path('uploads'), $nama_gambar);
        $input['image'] = $nama_gambar;
        } else {
            // Jika tidak ada gambar baru, hapus 'image' dari input
            unset($input['image']);
        }

        // Lakukan update data berdasarkan id yang diberikan
        Food::where('id', $id)->update($input);
    
        // Tambahkan pesan sukses ke sesi
        $request->session()->flash('success', 'Data berhasil diupdate.');
    
        return redirect('food');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($food->image && File::exists(public_path('uploads/' . $food->image))) {
            File::delete(public_path('uploads/' . $food->image));
        }

        // Hapus data dari database
        $food->delete();

        // Tambahkan pesan sukses ke dalam session
        session()->flash('success', 'Data berhasil dihapus.');

        return redirect('food');
        }
}
