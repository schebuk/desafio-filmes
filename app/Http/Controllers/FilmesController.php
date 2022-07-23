<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
Use App\Models\Filmes;
Use App\Models\Genre;
Use App\Models\Favorito;
use Auth;

class FilmesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmes = Filmes::orderby('popularity','DESC')->paginate(20);
        $favoritos = Favorito::where('userid', Auth::user()->id  )->get();
        //dump($favoritos);
        return view('index',[
            'filmes' => $filmes,
            'favoritos' => $favoritos,
        ]);
    }
    /**
     * importar filmes.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        $movies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json();
        $total_pages = $movies['total_pages'];

        for ($page=1;$page<=$total_pages;$page++){
            $movies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular/', ['page' => $page])
            ->json();
            if (isset($movies['results'])){
                $movieinfo = $movies['results'];
                foreach ($movieinfo as $movie){
                    if (!isset($movie["release_date"])){
                        $movie["release_date"] = NULL;
                    }
                    $generos = '';
                    foreach($movie["genre_ids"] as $genreId){
                        $nomeGenero = Genre::where('id', '=', $genreId)->first();
                        $generos = $generos . ", " . $nomeGenero->name;
                    }
                    $info = ["id" => $movie["id"],
                            "original_language" => $movie["original_language"],
                            "original_title" => $movie["original_title"],
                            "overview" => $movie["overview"],
                            "poster_path" => $movie["poster_path"],
                            "release_date" => $movie["release_date"],
                            "title" => $movie["title"],
                            "popularity" => $movie["popularity"],
                            "genre_ids" => substr($generos, 1)
                            ];

                    $filme = Filmes::where('id', '=', $movie["id"])->first();
                    if ($filme === null) {
                        Filmes::insert($info);
                    }
                    else{
                        $filme->popularity = $movie["popularity"];
                        $filme->vote_average = $movie["vote_average"];
                        $filme->genre_ids = substr($generos, 1);
                        $filme->save();
                    }
                }
            }

        }


        return redirect('/filmes');
    }

    /**
    * importar filmes.
    *
    * @return \Illuminate\Http\Response
    */
   public function importGenre()
   {

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json();
        foreach ($genres['genres'] as $genre){
            $info = ["id" => $genre["id"],
                    "name" => $genre["name"]
                    ];
            Genre::insert($info);
        }


        return redirect('/filmes');
   }

   /**
    * favoritos.
    *
    * @return \Illuminate\Http\Response
    */
    public function favorito(Request $request, $filmeid, $userid)
    {


        $favoritos = Favorito::where('userid', Auth::user()->id  )->where('filmeid',$filmeid)->first();
        if ($favoritos){
            $favoritos->delete();
        }
        else{
            $info = ["userid" => $userid,
                    "filmeid" => $filmeid
                        ];
            Favorito::insert($info);
        }

         return back();
    }



   /**
    * favoritos.
    *
    * @return \Illuminate\Http\Response
    */
    public function favoritos()
    {
        $favoritos = Favorito::where('userid', Auth::user()->id  )->get();
        $filmes = Filmes::orderby('popularity','DESC')
                    ->join('favoritos', 'favoritos.filmeid', '=', 'filmes.id')
                    ->select('filmes.id AS id', 'filmes.*')
                    ->where('favoritos.userid', Auth::user()->id)
                    ->paginate(20);

        return view('index',[
            'filmes' => $filmes,
            'favoritos' => $favoritos,
        ]);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
