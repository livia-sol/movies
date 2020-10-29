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
        $movies = Movie::where('status', 1)->where('rating','>=',5.0)->paginate(3);//->simplePaginate(3)
        //dd($movies);
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
    public function show($id)
    {   
        if($id){
            try {
                $id = decrypt($id);
            } catch(\Exception $e) {
                abort(403, __('app.invalid_data_received'));
            }
        }

        $movie = Movie::find($id);
        //dd($movie);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = decrypt($id);
        } catch(\Exception $e) {
            abort(403, __('app.invalid_data_received'));
        }
    
        $movie = Movie::find($id);
        $status = [1, 2];

        return view('movies.edit', compact('movie', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        try {
            $id = decrypt($id);
        } catch(\Exception $e) {
            abort(403, __('app.invalid_data_received'));
        }

        $movie = Movie::find($id);

        $movie->status = $request->status;
        $movie->name = $request->name;
        $movie->rating = $request->rating;
        $movie->description = $request->description;
        $movie->save();

        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    //Delete movie from url: /delete-movie/{id?}
    public function delete($id=null)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    //Delete movie from url: /delete-movie/{id?}
    public function destroy($id)
    {
        if($id)
        {
            try {
                $id = decrypt($id);
            } catch(\Exception $e) {
                abort(403, __('app.invalid_data_received'));
            }
        }

        if($id){
            $movie = Movie::find($id);
            if($movie) {
                $movie->delete();
            }
        }

        return redirect()->route('movies.index');
    }
}
