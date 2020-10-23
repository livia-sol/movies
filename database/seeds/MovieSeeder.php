<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Movie::truncate();
        // $movies = [
        //     ['status' => 1,'name' => 'Space Force', 'rating' => 6.9, 'description' => 'description 1', 'image' => 'space-force.jpg'],
        //     ['status' => 1,'name' => 'Forest Gump', 'rating' => 8.8, 'description' => 'description 2', 'image' => 'forest-gump.jpg'],
        //     ['status' => 1,'name' => 'Joker', 'rating' => 7.0, 'description' => 'description 3', 'image' => 'joker.jpg'],
        //     ['status' => 0,'name' => 'Rebecca', 'rating' => 4.9, 'description' => 'description 4', 'image' => 'rebecca.jpg'],
        //     ['status' => 0,'name' => 'Honest Thief', 'rating' => 4.2, 'description' => 'description 5', 'image' => 'honest-thief.jpg']
        // ];
        // foreach($movies as $item){
        //     Movie::create($item);
        // }

        // DB::table('movies')->insert([
        //     'status' => 1,'name' => 'Space Force', 'rating' => 6.9, 'description' => 'description 1', 'image' => 'space-force.jpg'
        // ]);
        
        DB::table('movies')->insert([
                ['status' => 1,'name' => 'Space Force', 'rating' => 6.9, 'description' => '<b>Director:</b> Robert Zemeckis', 'image' => 'space-force.jpg'],
                ['status' => 1,'name' => 'Forest Gump', 'rating' => 8.8, 'description' => '<b>Director:</b> Robert Zemeckis<br/><b>Writers:</b> Winston Groom<br/><b>Stars:</b> Tom Hanks, Robin Wright, Gary Sinise', 'image' => 'forest-gump.jpg'],
                ['status' => 1,'name' => 'Joker', 'rating' => 7.0, 'description' => '<b>Stars:</b> Tom Hanks, Robin Wright, Gary Sinise', 'image' => 'joker.jpg'],
                ['status' => 2,'name' => 'Rebecca', 'rating' => 4.9, 'description' => 'description', 'image' => 'rebecca.jpg'],
                ['status' => 2,'name' => 'Honest Thief', 'rating' => 4.2, 'description' => 'description', 'image' => 'honest-thief.jpg']
            ]);

        // $movies = [
        //     ['status' => 1,'name' => 'Space Force', 'rating' => 6.9, 'description' => 'description 1', 'image' => 'space-force.jpg'],
        //     ['status' => 1,'name' => 'Forest Gump', 'rating' => 8.8, 'description' => 'description 2', 'image' => 'forest-gump.jpg'],
        //     ['status' => 1,'name' => 'Joker', 'rating' => 7.0, 'description' => 'description 3', 'image' => 'joker.jpg'],
        //     ['status' => 2,'name' => 'Rebecca', 'rating' => 4.9, 'description' => 'description 4', 'image' => 'rebecca.jpg'],
        //     ['status' => 2,'name' => 'Honest Thief', 'rating' => 4.2, 'description' => 'description 5', 'image' => 'honest-thief.jpg']
        // ];
        // DB::table('movies')->insert($movies);
    }
}
