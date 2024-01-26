<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>ScreenV | Movie and TV preview</title>
   @vite('resources/css/app.css')
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

    {{-- kita akan simpan variabelnya dahulu yg sudah kita ambil di api --}}
    @php
        $backdrop_path = $imageBaseUrl."/original/".$img;        
    @endphp


    <section class="h-screen w-full flex flex-col relative">
        <img src="{{$backdrop_path}}" alt="" class="h-screen w-full absolute object-cover md:object-fill">
        <div class="w-full h-screen absolute bg-black opacity-30 z-10">a</div>

        {{-- header --}}
        <nav class="w-full h-[5rem] bg-transparent text-white dark:bg-black drop-shadow-lg dark:shadow-slate-300 dark:text-white z-10">
            <ul class="h-full flex flex-row items-center">
               <li class="basis-1/4 pl-2 md:pl-7">
                  <a href="/tvshow" class="uppercase font-inter text-small md:text-lg md:font-medium md:mx-5 hover:text-ahy-400 dark:hover:text-ahy-700 transition duration-200">
                    Tv Show
                  </a>
                  <a href="/movies" class="uppercase font-inter text-small md:text-lg md:font-medium md:mx-5 hover:text-ahy-400 dark:hover:text-ahy-700 transition duration-200">
                    Movies
                  </a>
               </li>
               <li class="basis-1/2 text-center">
                  <a href="/" class="uppercase font-quicksand font-semibold text-2xl md:text-5xl hover:text-ahy-400 dark:hover:text-ahy-700 transition duration-200">
                     ScreenV
                  </a>
               </li>
               <li class="basis-1/4 flex justify-end pr-3 md:pr-7">
                  <a href="/search">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:stroke-ahy-400 dark:hover:stroke-ahy-700 dark:stroke-white transition duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                     </svg>                   
                  </a>
               </li>
            </ul>
        </nav>

        {{-- content --}}
        <section class="w-full md:-mt-10 h-full flex flex-col z-10 justify-center pl-12 md:px-28 text-white">
         <h1 class="font-quicksand font-bold text-4xl md:text-6xl ">{{$title}}</h1>
         <h4 class="font-inter italic hidden mt-3 md:block text-xl max-w-2xl line-clamp-2 text-white">{{$overview}}</h4>
         <h4 class="font-inter italic mt-3 md:hidden text-xl ">{{$tagline}}</h4>

         <div class="flex flex-row mt-3">
            <span class="rounded-full w-14 md:w-20 h-1w-14 md:h-20 flex justify-center items-center bg-gray-800">
               <svg class="-rotate-90 w-14 md:w-20 h-1w-14 md:h-20 hidden md:block">
                  <circle 
                  style="color: #004F80;"
                  stroke-width = "8"
                  stroke="currentColor"
                  fill="transparent"
                  r="32"
                  cx="40"
                  cy="40"               
                  ></circle>              
                  <circle 
                  style="color: #6FCF97;"               
                  stroke-width = "8"
                  stroke-dasharray="{{$lingkaran}}px"                  
                  stroke-dashoffset="{{$ratingLingkaran}}px"
                  stroke-linecap ='round'
                  stroke="currentColor"
                  fill="transparent"
                  r="32"
                  cx="40"
                  cy="40"               
                  ></circle>                                                                        
               </svg>
               {{-- ketika di hp --}}
               <svg class="-rotate-90 w-14 md:w-20 h-14 md:h-20 md:hidden">
                  <circle 
                  style="color: #004F80;"
                  stroke-width = "6"
                  stroke="currentColor"
                  fill="transparent"
                  r="23"
                  cx="28"
                  cy="28"                  
                  ></circle>
                  <circle 
                  style="color: #6FCF97;"               
                  stroke-width = "6"
                  stroke-dasharray="{{$lingkaran2}}px"                  
                  stroke-dashoffset="{{$ratingLingkaran2}}px"
                  stroke-linecap ='round'
                  stroke="currentColor"
                  fill="transparent"
                  r="23"
                  cx="28"
                  cy="28"               
                  ></circle>
               </svg>
               {{-- rating --}}
               <span class="absolute font-inter font-medium text-sm md:text-xl">{{$rating}}%</span>
            </span>   
            {{-- date --}}
            <span class="flex justify-center items-center mx-4 text-sm md:text-xl">
               <h6 class="font-inter text-sm md:text-xl text-white bg-transparent rounded-md border h-auto border-white p-2">{{ $release }}</h6>    
            </span>      
            {{-- duration --}}
            @if($duration != "")
            <span class="flex justify-center items-center text-sm md:text-xl">
               <h6 class="font-inter text-sm md:text-xl text-white bg-transparent rounded-md border h-auto border-white p-2 mr-4">{{ $duration }}</h6>    
            </span>
            @endif
                  
         </div>
         
         {{-- play trailer --}}
         @if ($video != "")
         <div class="flex items-center mt-3">
            <button class="group md:text-lg font-semibold flex items-center justify-center hover:text-black bg-ahy-400 dark:hover:text-slate-800 rounded-xl min-h-12 md:min-h-12 min-w-28 md:min-w-36" onclick="showTrailer(true)">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 scale-75 fill-white group-hover:fill-black">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
               </svg>                      
               Play Trailer
            </button>
         </div>
         @endif
         
        </section>
        
        {{-- trailer --}}
        <section id="trailer" class="absolute z-10 bg-black w-full h-screen flex flex-col pb-20 px-20">
         <button class="ml-auto mt-24 group" onclick="showTrailer(false)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white group-hover:text-ahy-400">
               <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
             </svg>             
         </button>

         {{-- trailer youteube --}}
         <iframe src="https://www.youtube.com/embed/{{$video}}?enablejsapi=1" frameborder="0" id="youtubeId" class="w-full h-full" title="{{$title}}"></iframe>
        </section>
    </section>
    
    <script>
      $("#trailer").hide();

      function showTrailer(bool) { 
         if(bool == true ){
            $("#trailer").show();
         }else{
            // stop youtubenya, karena tanpa ini walaupun kita close youtube tetap berjalan
            $("#youtubeId")[0].contentWindow.postMessage('{"event":"command","func":"'+'stopVideo'+'","args":""}','*');

            // sembunyikan
            $("#trailer").hide();
         }
      }
    </script>
</body>
</html>