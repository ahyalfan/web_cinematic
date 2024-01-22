<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index(Request $request){
        // disini kita akan menggunakan api yg sudah kita bungkus dgn env
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = \env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        
        // max data
        $max = 3;

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
                    if (count($bannerArray) == 3) {
                        break;
                    }
                }
            } 
        }
// kemudian kita kirimkan ke viewnya
        return view('home',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'data' => $bannerArray,
            'data2' => $bannerResponse,
        ]);
    }
}