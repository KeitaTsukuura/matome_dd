<?php

namespace App\Http\Controllers;

use App\Http\Requests\GearRequest;
use Illuminate\Http\Request;
use App\Models\Gear;
use Cloudinary;

class GearController extends Controller
{
    public function index(Gear $gear)
    {
        return view('gears.index')->with(['gears' => $gear->getPaginateBylimit()]);
    }
    public function create()
    {
        return view('gears.create');   
    }
    public function store(Request $request, Gear $gear)
    {
        $userId = auth()->id();
        $gear->user_id = $userId;
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        
        $input = $request['gear'];
        $input += ['image_url' => $image_url]; 
        $gear->fill($input)->save();
        return redirect('/gears/'. $gear->id);
    }
    public function show(Gear $gear)
    {
        return view('gears.show', ['gear' => $gear]);
    }
    public function edit(Gear $gear)
    {
        return view('gears.edit')->with(['gear' => $gear]);
    }
    public function update(GearRequest $request, Gear $gear)
    {
        $input_gear = $request['gear'];
        $gear->fill($input_gear)->save();
        return redirect('/gears/' . $gear->id);
    }
    public function delete(Gear $gear)
    {
        $gear->delete();
        return redirect('/gears/index');
    }
}
