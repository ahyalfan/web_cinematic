<!DOCTYPE html>
<html lang="en" class="">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>CINEMATION | Movie and tv preview</title>
   @vite('resources/css/app.css')
</head>
<body class="dark:bg-black dark:text-white">
   {{-- header --}}
   <section class="flex flex-col w-full h-auto min-h-screen">
      {{-- nav bar --}}
      @include('header.navbar')

      {{-- banner section--}}
      <div class="w-full h-[33rem] text-white">
         {{-- banner data --}}
         <div class="w-full h-full bg-cover relative">
            @foreach ($data as $item)
            <img src="{{$imageBaseUrl}}/original/{{$item['backdrop_path']}}" alt="contoh" class="brightness-50 absolute w-full h-full object-cover">
            <div class="flex flex-row w-full h-full">
               {{-- tombol --}}
               <div class="basis-1/12 flex flex-col justify-center items-center">
                  <button class="z-10 w-10 h-10 rounded-full hover:opacity-100 opacity-30 bg-white text-black">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                      </svg>                      
                  </button>
               </div>
               {{--  --}}
               <div class="flex flex-col basis-10/12 justify-center pl-10">
                  <div class="basis-1/12 z-10"></div>
                  <div class="basis-10/12 z-10 flex flex-col justify-center">
                     <h1 class="z-10 font-inter font-bold text-4xl">{{$item['title']}}</h1>
                     <p class="z-10 font-inter text-xl my-3 leading-7 w-1/2 line-clamp-2">{{ $item['overview'] }}</p>
                     <span class="h-9 w-24 mt-2 rounded-full flex bg-ahy-400 z-10 group">
                        <a href="/movie/{{$item['id']}}" class="font-inter m-auto font-sm font-medium text-white group-hover:text-black dark:hover:text-slate-800 transition duration-200 flex flex-row">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 scale-75 group-hover:fill-black">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                           </svg>                      
                           Detail                      
                        </a>
                     </span>
                  </div>
                  <div class="flex flex-row z-10 mx-auto w-[3.75rem]">
                     <div class="z-10 w-3 h-3 bg-slate-500 rounded-full cursor-pointer"></div>
                     <div class="z-10 mx-3 w-3 h-3 bg-slate-50 rounded-full cursor-pointer"></div>
                     <div class="z-10 w-3 h-3 bg-slate-500 rounded-full cursor-pointer"></div>
                  </div>
               </div>
               @endforeach
               {{-- tombol --}}
               <div class="basis-1/12 flex flex-col justify-center items-center">
                  <button class="z-10 w-10 h-10 rounded-full hover:opacity-100 opacity-30 bg-white text-black">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                      </svg>                                          
                  </button>
               </div>
            </div>
         </div>
      </div>
                          
   </section>
</body>  
</html>