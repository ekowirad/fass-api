<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\LaborFile;
use Illuminate\Support\Facades\Input;

class LaborFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $this->validate($request, [
        //     'files' => 'required',
        //     'files.*.filename' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048'
        // ]);


        // if ($request->hasFile('files')) {
        //     foreach ($request->file('files') as $key => $image) {
        //     // filenaming purpose
        //     if($request->type == "profile"){
        //         $profilename =  $request->labor_id. '_' .$request->type;
        //     }else{
        //         $profilename =  $request->labor_id. '_' .$request->type. '_' .$key;
        //     }
        //         $file = new LaborFile;
        //         $file->name = $profilename. '.' .$image->getClientOriginalExtension();
        //         $file->type = $request->type;
        //         $file->labor_id = $request->labor_id;
        //         $image->storeAs('public/images', $file->name);
        //         $file->save();
        //     }
        //     return response()->json(['message' => 'success'], 200);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $files = Image::findOrFail($id);
        // $fileArray = json_decode($files->filename);
        // foreach ($fileArray as $key => $file) {
        //     $img = asset("storage/images/$file");
        //     $data[] = $img;
        // }
        // return response()->json(['data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $files = LaborFile::findOrFail($id);
        Storage::delete('public/images/'. $files->name);
        // return response()->json(['message' => 'success'], 200);
    }
}
