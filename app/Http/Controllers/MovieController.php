<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    // halaman index
    public function hitApi(int $maxData, string $path, string $baseUrl = "https://api.themoviedb.org/3",string $apiKey = "ce93db84d29dc9c031bdb1a42790f20b"){
        // hit api buat banner
        $bannerResponse = Http::get("$baseUrl".$path,[
            'api_key' => "$apiKey"
        ]); //ini kita coba tangkep data dari api dari movie db tentang trending movie, kemudian kita ambil data yg trending, contohnya judul movie yg saat ini trending ,gmabarnya dll. ini ada banyak sekali

        $bannerArray = []; //ini untuk mengisi data api yg akan kita ambil, kenapa array karena kita ingin ambil data dari api lebih dari satu

        // kita check dahulu karena bisa jadi api nya error
        if ($bannerResponse->successful()) {
            // artinya jika responya seccess maka kita akan masukan data api ke result
            // $bannerArray[] = $bannerResponse->object()->results; ini cara pertama pengambilan data results dari api
            $result = $bannerResponse->json()['results']; // ini cara kedua
            // kita cek lagi apakah datanya sudah masuk
            if(isset($bannerArray)){
                // kita lakukan pengmabilan dgn pengulangan
                // dan akan menyimpan ke bannerArray, dengan beberapa data saja
                foreach ($result as $item) {
                    // save ke bannerArray
                    \array_push($bannerArray,$item);
                    // cek jika data sudah lebih dari 3, maka langsung kembalikan
                    if (count($bannerArray) == $maxData) {
                        break;
                    }
                }
            } 
        }
        return $bannerArray;
    }

    // api buat halaman movie
    public function hitApiMoviesTv(string $sortby, int $page,int $minimalVote,string $path='/discover/movie' ,string $baseUrl = "https://api.themoviedb.org/3",string $apiKey = "ce93db84d29dc9c031bdb1a42790f20b" ){
        // hit api buat banner
        $bannerResponse = Http::get("$baseUrl".$path,[
            'api_key' => "$apiKey",
            'page' => $page,
            'sort_by' => $sortby,
            'vote_count.gte' => $minimalVote
        ]); //ini kita coba tangkep data dari api dari movie db tentang trending movie, kemudian kita ambil data yg trending, contohnya judul movie yg saat ini trending ,gmabarnya dll. ini ada banyak sekali

        $bannerArray = []; //ini untuk mengisi data api yg akan kita ambil, kenapa array karena kita ingin ambil data dari api lebih dari satu

        // kita check dahulu karena bisa jadi api nya error
        if ($bannerResponse->successful()) {
            // artinya jika responya seccess maka kita akan masukan data api ke result
            // $bannerArray[] = $bannerResponse->object()->results; ini cara pertama pengambilan data results dari api
            $result = $bannerResponse->json()['results']; // ini cara kedua
            // kita cek lagi apakah datanya sudah masuk
            if(isset($bannerArray)){
                // kita lakukan pengmabilan dgn pengulangan
                // dan akan menyimpan ke bannerArray, dengan beberapa data saja
                foreach ($result as $item) {
                    // save ke bannerArray
                    \array_push($bannerArray,$item);                    
                }
            } 
        }
        return $bannerArray;
    }

    // api buat detail movie and tv
    public function getDetails(string $path, string $baseUrl = "https://api.themoviedb.org/3",string $apiKey = "ce93db84d29dc9c031bdb1a42790f20b"){
        // hit api buat banner
        $response = Http::get("$baseUrl".$path,[
            'api_key' => "$apiKey",
            'append_to_response' => "videos"
        ]); //ini kita coba tangkep data dari api dari movie db tentang trending movie, kemudian kita ambil data yg trending, contohnya judul movie yg saat ini trending ,gmabarnya dll. ini ada banyak sekali

        // kita check dahulu karena bisa jadi api nya error
        if ($response->successful()) {
            // artinya jika responya seccess maka kita akan masukan data api ke result
            // $detailArray[] = $response->object()->results; ini cara pertama pengambilan data results dari api
            $result = $response->json(); // ini cara kedua            
        }
        return $result;
    }


    public function index(Request $request){
        // ini contoh hit api satu persatu
        // disini kita akan menggunakan api yg sudah kita bungkus dgn env
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        // max data
        $maxBanner = 3;
        // hit api buat banner
        $bannerResponse = Http::get("$baseUrl/trending/movie/week",[
            'api_key' => "$apiKey"
        ]); //ini kita coba tangkep data dari api dari movie db tentang trending movie, kemudian kita ambil data yg trending, contohnya judul movie yg saat ini trending ,gmabarnya dll. ini ada banyak sekali
        $bannerArray = []; //ini untuk mengisi data api yg akan kita ambil, kenapa array karena kita ingin ambil data dari api lebih dari satu
        // kita check dahulu karena bisa jadi api nya error
        if ($bannerResponse->successful()) {
            // artinya jika responya seccess maka kita akan masukan data api ke result
            // $bannerArray[] = $bannerResponse->object()->results; ini cara pertama pengambilan data results dari api
            $result = $bannerResponse->json()['results']; // ini cara kedua
            // kita cek lagi apakah datanya sudah masuk
            if(isset($bannerArray)){
                // kita lakukan pengmabilan dgn pengulangan
                // dan akan menyimpan ke bannerArray, dengan beberapa data saja
                foreach ($result as $item) {
                    // save ke bannerArray
                    \array_push($bannerArray,$item);
                    // cek jika data sudah lebih dari 3, maka langsung kembalikan
                    if (count($bannerArray) == $maxBanner) {
                        break;
                    }
                }
            } 
        }

        // sedangkan ini hit api menggunakan method leboh cepat
        // hit api buat top movie, coba buat method agar tidak mengulang ulang karena hit api nya sama saja caranya
        // data movie top
        $dataSection = $this->hitApi(maxData:10,path:"/movie/top_rated");
        // data tv top
        $dataSectionTv = $this->hitApi(maxData:10,path:"/tv/top_rated");


        // kemudian kita kirimkan ke viewnya
        return view('home',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            // banner data
            'dataBanner' => $bannerArray,
            // section data top 10 tv
            'dataSection' => $dataSection,
            'dataSectionTv' => $dataSectionTv
        ]);
    }

    public function getAllMovie(){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $dataMovies = $this->hitApiMoviesTv(sortby:'popularity.desc',page:1,minimalVote:100);
        return \view('movie',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'sortBy'=>'popularity.desc',
            'page'=>1,
            'minimalVote'=>100,

            // data movie page 1
            'moviesPage1'=>$dataMovies,
        ]);
    }
    public function getAllTv(){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $dataTV = $this->hitApiMoviesTv(sortby:'popularity.desc',page:1,minimalVote:100,path:'/discover/tv');
        return \view('tv',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'sortBy'=>'popularity.desc',
            'page'=>1,
            'minimalVote'=>100,

            // data movie page 1
            'tvPage'=>$dataTV,
        ]);
    }

    public function search(){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
    
        return \view('search',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
        ]);
    }

    public function getMovieById(int $id){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        // data lengkap
        $dataMovie = $this->getDetails("/movie/$id");

        if($dataMovie){
            // data satuans
            if($dataMovie['backdrop_path']){
                $img = $dataMovie['backdrop_path'];
            }else{$img = "";}
            if($dataMovie['original_title']){
                $title = $dataMovie['original_title'];
            }else{$title = "";}
            if($dataMovie['overview']){
                $overview = $dataMovie['overview'];
            }else{$overview = $dataMovie['tagline'];}
            if($dataMovie['tagline']){
                $tagline = $dataMovie['tagline'];
            }else{$tagline = "";}
            if($dataMovie['runtime']){
                $runtime = $dataMovie['runtime'];
                $haur = floor($runtime / 60);
                $minute = ($runtime % 60);
                $duration = $haur."h ".$minute.'m';
            }else{$runtime = "";}
            if($dataMovie['status']){
                $status = $dataMovie['status'];
            }else{$status = "";}
            if($dataMovie['vote_average']){
                $ratingOld = $dataMovie['vote_average'] * 10;
                $rating = floor($dataMovie['vote_average'] * 10);
            }else{$rating = '';}
            $date = $dataMovie['release_date'];
            $timestamps = \strtotime($date);
            $dateString = \date('m/j/o',$timestamps);
            if($dataMovie['genres']){
                $genres = $dataMovie['genres'];
            }else{$genres = [];}
        }else{$dataMovie = [];}

        // buat data lingkarannya
        $lingkaran = 2 * 3.14 * 32; //kita buat di 32px
        $ratingLingkaran = $lingkaran - ($rating/100 * $lingkaran);
        $lingkaran2 = 2 * 3.14 * 23; //kita buat di 16px untuk ponsel
        $ratingLingkaran2 = $lingkaran2 - ($rating/100 * $lingkaran2);

        return \view('movie_by_id',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'dataMovie' => $dataMovie,
            'img' => $img,
            'title' => $title,
            'duration' => $duration,
            'overview' => $overview,
            'tagline'=>$tagline, // untuk hp
            'status' => $status,
            'rating' => $rating,
            'lingkaran' => $lingkaran,
            'lingkaran2' => $lingkaran2,
            'ratingLingkaran' => $ratingLingkaran,
            'ratingLingkaran2' => $ratingLingkaran2,
            'release' => $dateString,
            'genres' => $genres,
        ]);
    }

    public function getTvById(int $id){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        // data lengkap
        $dataTv = $this->getDetails("/tv/$id");
        if($dataTv){
            // data satuan
            if($dataTv['backdrop_path']){
                $img = $dataTv['backdrop_path'];
            }else{$img = "";}
            if($dataTv['original_name']){
                $title = $dataTv['original_name'];
            }else{$title = "";}
            if($dataTv['overview']){
                $overview = $dataTv['overview'];
            }else{$overview = $dataTv['tagline'];}
            if($dataTv['episode_run_time']){
                $episode_run_time = $dataTv['episode_run_time'];
            }else{$episode_run_time = "";}
            if($dataTv['status']){
                $status = $dataTv['status'];
            }else{$status = "";}
            if($dataTv['seasons']){
                $seasons = $dataTv['seasons'];
            }else{$seasons = [];}
            $date = $dataTv['first_air_date'];
            $timestamps = \strtotime($date);
            $dateString = \date('m/j/o',$timestamps);
            if($dataTv['genres']){
                $genres = $dataTv['genres'];
            }else{$genres = [];}
        }else{$dataTv = [];}

        return \view('tv_by_id',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'dataTv' => $dataTv,
            'img' => $img,
            'title' => $title,
            'overview' => $overview,
            'status' => $status,
            'seasons' => $seasons,
            'dateString' => $dateString,
            'genres' => $genres,
        ]);
    }
}