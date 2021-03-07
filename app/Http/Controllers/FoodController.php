<?php

/**
 * Food Controller
 *
 * Handles the logic behind the Food Model
 *
 * @author  Rheanne McIntosh <rheanne.mcintosh@outlook.com>
 * @version 07-03-2021
 */

namespace App\Http\Controllers;

// Use Statements
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::latest()->simplePaginate(10);

        return view('food.index', compact('foods'));
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
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|integer',
            'category'    => 'required',
            'image'       => 'required|mimes:png,jpeg,jpg',
        ]);

        $image           = $request->file('image');
        $imageName       = time().'_'.$image->getClientOriginalExtension();
        $destinationPath = public_path('\images');

        $image->move($destinationPath, $imageName);

        Food::create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'price'       => $request->get('price'),
            'category_id' => $request->get('category'),
            'image'       => $imageName,
        ]);

        return redirect()->route('food.index')->with('message', 'Food Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);

        return view('food.detail', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::find($id);

        return view('food.edit', compact('food'));
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
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|integer',
            'category'    => 'required',
            'image'       => 'mimes:png,jpeg,jpg',
        ]);

        $food      = Food::find($id);
        $imageName = $food->image;

        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $imageName       = time().'_'.$image->getClientOriginalExtension();
            $destinationPath = public_path('\images');
    
            $image->move($destinationPath, $imageName);
        }

        $food->update([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'price'       => $request->get('price'),
            'category_id' => $request->get('category'),
            'image'       => $imageName,
        ]);

        return redirect()->route('food.index')->with('message', 'Food Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        $food->delete();

        return redirect()->route('food.index')->with('message', 'Food Deleted');
    }

    /**
     * Display the list of Categories with their foods
     * 
     * @return \Illuminate\Http\Response
     */
    public function listFood()
    {
        $categories = Category::with('food')->get();

        return view('food.list', compact('categories'));
    }
}
