<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::where('status', 1)->where('rating','>=',5.0)->get();
        
        return view('movies.index',compact('movies'));
    }

    public function indexJson()
    {
        $movies = Movie::where('status', 1)->where('rating','>=',5.0)->get();
        
        return response()->json($movies);
    }

    //Shoe opened-menu page
    public function showMenu()
    {
        return view('movies.menu');
    }

    //Store movies in database from url: /add-movie?name=name&rating=10.0&description=description&image=image
    public function storeJson(Request $request)
    {
        $validationArray = [
            'name' => 'required|max:64',
            'rating' => 'required|numeric|between:0,10.0',
            'description' => 'required|max:255',
            'image' => 'required|max:255'
        ];

        $validator = Validator::make($request->all(), $validationArray);
        if ($validator->fails()) {
            $response = $validator->messages()->first();
            return response()->json($response);
        }

        $movie = Movie::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'description' => $request->description,
            'image' => $request->image
        ]);

        return response()->json($movie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = [1, 2];

        return view('movies.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationArray = [
            'status' => 'required',
            'name' => 'required|max:64',
            'rating' => 'required|numeric|between:0,10.0',
            'description' => 'required|max:255',
            'image' => 'required'
        ];

        $validator = Validator::make($request->all(), $validationArray);
        if ($validator->fails()) {
            Session::flash('message', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
        
        $movie = Movie::create([
            'status' => $request->status,
            'name' => $request->name,
            'rating' => $request->rating,
            'description' => $request->description,
            'image' => $request->image ? $request->file('image')->getClientOriginalName() : null
        ]);
        Session::flash('message', 'Movie was added.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    // public function show(Movie $movie)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Movie  $movie
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Movie $movie)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Movie  $movie
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Movie $movie)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    //Delete movie from url: /delete-movie/{id?}
    public function destroy($id=null)
    {
        if($id != null){
            $movie = Movie::find($id);
            if($movie) {
                $movie->delete();
                if($movie->deleted_at != null)
                    return response()->json('This movie was deleted.'); 
            }else{
                return response()->json('Set another id.');
            }
        }else{
            return response()->json('Set an id.'); 
        }
    }
}
