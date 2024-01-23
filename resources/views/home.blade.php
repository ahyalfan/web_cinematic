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
      {{-- navbar --}}
      @include('header.navbar')
      {{-- banner --}}
      <main class="w-full h-[33rem] bg-slate-400">
         <div class="w-full h-full relative">
            {{-- data iisi --}}
            @foreach ($dataBanner as $item)
            <div class="slide h-full text-white transition duration-500">
               <img src="{{$imageBaseUrl}}/original/{{$item['backdrop_path']}}" alt="" class="brightness-50 absolute w-full h-full object-cover bg-">

               <div class="h-full flex flex-row justify-center">
                  <div class="flex flex-col justify-center basis-10/12 p-5">
                     <h1 class="z-10 font-inter font-bold text-4xl">{{$item['title']}}</h1>
                     <p class="z-10 font-inter text-xl leading-7 line-clamp-2 pr-1/2">{{$item['overview']}}</p>
                     <span class="h-9 w-24 mt-4 rounded-full flex bg-ahy-400 z-10 group">
                        <a href="/movie/{{$item['id']}}" class="font-inter m-auto font-sm font-medium text-white group-hover:text-black dark:hover:text-slate-800 transition duration-200 flex flex-row">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 scale-75 group-hover:fill-black">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                           </svg>                      
                           Detail                      
                        </a>
                     </span>
                  </div>
               </div>
            </div>
            @endforeach
            {{-- data tombol preview--}}
            <div class="absolute top-1/2 -translate-y-1/2 translate-x-1/6 md:translate-x-1/2" onclick="moveSlide(-1)">
               <button class="z-10 w-10 h-10 rounded-full hover:opacity-100 opacity-30 bg-white text-black">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                  </svg>                      
               </button>
            </div>
            {{-- next --}}
            <div class="absolute top-1/2 right-0 -translate-y-1/2 -translate-x-1/2" onclick="moveSlide(1)">
               <button class="z-10 w-10 h-10 rounded-full hover:opacity-100 opacity-30 bg-white text-black">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto rotate-180">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                  </svg>                      
               </button>
            </div>
            {{-- titik buton --}}
            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex flex-row">
               @for ($index = 1 ;$index <= count($dataBanner);$index++)                  
                  <div class="z-10 mx-2 w-3 h-3 bg-slate-50 rounded-full cursor-pointer poin" onclick="curentSlide({{$index}})"></div>               
               @endfor               
            </div>
         </div>
      </main>
      {{-- top movie --}}
      <div class="mt-10 pl-4 lg:pl-20 font-inter w-full">
         <h3 class="font-semibold text-xl leading-7">Top 10 Movie</h3>
         <div class="flex flex-nowrap overflow-x-auto pb-5 font-inter mb-10">
            @foreach ($dataSection as $data )
            {{-- disini kita akan rubah format tanggalnya menjadi lebih menarik --}}
            @php
               $release = $data['release_date'];
               $timestaps = strtotime($release); //disini kita rubah ke timestamps dulu
               $newFormat = date('F j, o',$timestaps);
            @endphp


            <a href="movie/{{$data['id']}}" class="group mr-6 rounded-2xl transition duration-1000">
               <div class="min-w-52 min-h-72 p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col overflow-hidden">
                  <div class="overflow-hidden rounded-2xl">
                     <img class="rounded-2xl h-[300px] w-[210px] object-cover group-hover:scale-125 transition duration-500" src="{{$imageBaseUrl}}/original/{{$data['poster_path']}}" alt="">
                  </div>
                  <h4 class="text-lg w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[3%] group-hover:line-clamp-none">{{$data['title']}}</h4>
                  <h6 class="text-sm font-normal pl-[3%]">{{ $newFormat }}</h6>
                  <div class="flex flex-row pl-[3%] my-2">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                      </svg>
                      <p class="ml-2">{{$data['vote_average']}}%</p>
                  </div>
               </div>
            </a>
            @endforeach
         </div>
         
      </div>
      {{-- top tv --}}
      <div class="mt-1 pl-4 lg:pl-20 font-inter w-full">
         <h3 class="font-semibold text-xl leading-7">Top 10 TV SHOWS</h3>
         <div class="flex flex-nowrap overflow-x-auto pb-5 font-inter mb-10">
            @foreach ($dataSectionTv as $data )
            {{-- disini kita akan rubah format tanggalnya menjadi lebih menarik --}}
            @php
               $release = $data['first_air_date'];
               $timestaps = strtotime($release); //disini kita rubah ke timestamps dulu
               $newFormat = date('F j, o',$timestaps);
            @endphp


            <a href="tv/{{$data['id']}}" class="group mr-6 rounded-2xl transition duration-1000">
               <div class="min-w-52 min-h-72 p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col overflow-hidden">
                  <div class="overflow-hidden rounded-2xl">
                     <img class="rounded-2xl h-[300px] w-[210px] object-cover group-hover:scale-125 transition duration-500" src="{{$imageBaseUrl}}/original/{{$data['poster_path']}}" alt="">
                  </div>
                  <h4 class="text-lg w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[3%] group-hover:line-clamp-none">{{$data['name']}}</h4>
                  <h6 class="text-sm font-normal pl-[3%]">{{ $newFormat }}</h6>
                  <div class="flex flex-row pl-[3%] my-2">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                      </svg>
                      <p class="ml-2">{{$data['vote_average']}}%</p>
                  </div>
               </div>
            </a>
            @endforeach
         </div>   
      </div>
      {{-- footer --}}
      <footer class="bg-ahy-700 h-[20rem] w-full font-inter flex flex-col justify-end text-white">
         <div class="basis-10/12 flex flex-row">
            <div class="flex-col flex basis-2/4 justify-start items-center">
               <span class="flex flex-row md:justify-end w-full pl-2">
                  <h1 class="text-2xl md:text-4xl basis-4/5 font-bold">CINEMATION</h1>
               </span>
               <span class="flex flex-row md:justify-end pl-2 mt-2">
                  <p class="basis-4/5 text-lg md:text-xl">Kami menyediakan review film dan TV Series yang bisa jadi acuan tontonanmu #BetterMovieBetterLife</p>
               </span>
               <span class="flex flex-row md:justify-end pl-2 mt-2 w-full">               
                  <h6 class="basis-4/5 text-lg md:text-xl">&copy;2024 CINEMATION</h6>
               </span>
            </div>
            <div class="flex-col flex basis-1/4 justify-start items-center">
               <h6 class="text-xl md:text-2xl">Website</h6>
               <a class="text-sm md:text-lg hover:text-ahy-400 mt-4" href="">Home</a>
               <a class="text-sm md:text-lg hover:text-ahy-400 mt-4" href="movies">Movies</a>
               <a class="text-sm md:text-lg hover:text-ahy-400 mt-4" href="tv-show">TV Show</a>
            </div>
            <div class="flex-col flex basis-1/6 md:basis-1/4 justify-start items-center">
               <h6 class="text-xl md:text-2xl">Sosial</h6>
               <span class="mt-4 flex flex-row">
                  <a href="https://www.instagram.com/ahm4d_alf/?hl=en" class="text-sm md:text-lg hover:text-ahy-400">Instagram</a>
                  <a href="https://www.instagram.com/ahm4d_alf/?hl=en" class="text-center md:pl-3">
                     <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50" class="fill-white hidden md:block hover:fill-ahy-400">
                     <path d="M 16 3 C 8.8545455 3 3 8.8545455 3 16 L 3 34 C 3 41.145455 8.8545455 47 16 47 L 34 47 C 41.145455 47 47 41.145455 47 34 L 47 16 C 47 8.8545455 41.145455 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.054545 5 45 9.9454545 45 16 L 45 34 C 45 40.054545 40.054545 45 34 45 L 16 45 C 9.9454545 45 5 40.054545 5 34 L 5 16 C 5 9.9454545 9.9454545 5 16 5 z M 37 11 C 35.9 11 35 11.9 35 13 C 35 14.1 35.9 15 37 15 C 38.1 15 39 14.1 39 13 C 39 11.9 38.1 11 37 11 z M 25 14 C 18.954545 14 14 18.954545 14 25 C 14 31.045455 18.954545 36 25 36 C 31.045455 36 36 31.045455 36 25 C 36 18.954545 31.045455 14 25 14 z M 25 16 C 29.954545 16 34 20.045455 34 25 C 34 29.954545 29.954545 34 25 34 C 20.045455 34 16 29.954545 16 25 C 16 20.045455 20.045455 16 25 16 z"></path>
                     </svg>
                  </a>
               </span>
               <span class="mt-4 flex flex-row">
                  <a href="https://github.com/ahyalfan" class="text-sm md:text-lg hover:text-ahy-400">Github</a>         
                  <a href="https://github.com/ahyalfan" class="text-center md:pl-3">
                     <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 50 50" class="fill-white hidden md:block hover:fill-ahy-400">
                        <path d="M 25 2 C 12.311335 2 2 12.311335 2 25 C 2 37.688665 12.311335 48 25 48 C 37.688665 48 48 37.688665 48 25 C 48 12.311335 37.688665 2 25 2 z M 25 4 C 36.607335 4 46 13.392665 46 25 C 46 25.071371 45.994849 25.141688 45.994141 25.212891 C 45.354527 25.153853 44.615508 25.097776 43.675781 25.064453 C 42.347063 25.017336 40.672259 25.030987 38.773438 25.125 C 38.843852 24.634651 38.893205 24.137377 38.894531 23.626953 C 38.991361 21.754332 38.362521 20.002464 37.339844 18.455078 C 37.586913 17.601352 37.876747 16.515218 37.949219 15.283203 C 38.031819 13.878925 37.910599 12.321765 36.783203 11.269531 L 36.494141 11 L 36.099609 11 C 33.416539 11 31.580023 12.12321 30.457031 13.013672 C 28.835529 12.386022 27.01222 12 25 12 C 22.976367 12 21.135525 12.391416 19.447266 13.017578 C 18.324911 12.126691 16.486785 11 13.800781 11 L 13.408203 11 L 13.119141 11.267578 C 12.020956 12.287321 11.919778 13.801759 11.988281 15.199219 C 12.048691 16.431506 12.321732 17.552142 12.564453 18.447266 C 11.524489 20.02486 10.900391 21.822018 10.900391 23.599609 C 10.900391 24.111237 10.947969 24.610071 11.017578 25.101562 C 9.2118173 25.017808 7.6020996 25.001668 6.3242188 25.046875 C 5.3845143 25.080118 4.6454422 25.135713 4.0058594 25.195312 C 4.0052628 25.129972 4 25.065482 4 25 C 4 13.392665 13.392665 4 25 4 z M 14.396484 13.130859 C 16.414067 13.322043 17.931995 14.222972 18.634766 14.847656 L 19.103516 15.261719 L 19.681641 15.025391 C 21.263092 14.374205 23.026984 14 25 14 C 26.973016 14 28.737393 14.376076 30.199219 15.015625 L 30.785156 15.273438 L 31.263672 14.847656 C 31.966683 14.222758 33.487184 13.321554 35.505859 13.130859 C 35.774256 13.575841 36.007486 14.208668 35.951172 15.166016 C 35.883772 16.311737 35.577304 17.559658 35.345703 18.300781 L 35.195312 18.783203 L 35.494141 19.191406 C 36.483616 20.540691 36.988121 22.000937 36.902344 23.544922 L 36.900391 23.572266 L 36.900391 23.599609 C 36.900391 26.095064 36.00178 28.092339 34.087891 29.572266 C 32.174048 31.052199 29.152663 32 24.900391 32 C 20.648118 32 17.624827 31.052192 15.710938 29.572266 C 13.797047 28.092339 12.900391 26.095064 12.900391 23.599609 C 12.900391 22.134903 13.429308 20.523599 14.40625 19.191406 L 14.699219 18.792969 L 14.558594 18.318359 C 14.326866 17.530484 14.042825 16.254103 13.986328 15.101562 C 13.939338 14.14294 14.166221 13.537027 14.396484 13.130859 z M 8.8847656 26.021484 C 9.5914575 26.03051 10.40146 26.068656 11.212891 26.109375 C 11.290419 26.421172 11.378822 26.727898 11.486328 27.027344 C 8.178972 27.097092 5.7047309 27.429674 4.1796875 27.714844 C 4.1152068 27.214494 4.0638483 26.710021 4.0351562 26.199219 C 5.1622058 26.092262 6.7509972 25.994233 8.8847656 26.021484 z M 41.115234 26.037109 C 43.247527 26.010033 44.835728 26.108156 45.962891 26.214844 C 45.934234 26.718328 45.883749 27.215664 45.820312 27.708984 C 44.24077 27.41921 41.699674 27.086688 38.306641 27.033203 C 38.411945 26.739677 38.499627 26.438219 38.576172 26.132812 C 39.471291 26.084833 40.344564 26.046896 41.115234 26.037109 z M 11.912109 28.019531 C 12.508849 29.215327 13.361516 30.283019 14.488281 31.154297 C 16.028825 32.345531 18.031623 33.177838 20.476562 33.623047 C 20.156699 33.951698 19.86578 34.312595 19.607422 34.693359 L 19.546875 34.640625 C 19.552375 34.634325 19.04975 34.885878 18.298828 34.953125 C 17.547906 35.020374 16.621615 35 15.800781 35 C 14.575781 35 14.03621 34.42121 13.173828 33.367188 C 12.696283 32.72356 12.114101 32.202331 11.548828 31.806641 C 10.970021 31.401475 10.476259 31.115509 9.8652344 31.013672 L 9.7832031 31 L 9.6992188 31 C 9.2325521 31 8.7809835 31.03379 8.359375 31.515625 C 8.1485707 31.756544 8.003277 32.202561 8.0976562 32.580078 C 8.1920352 32.957595 8.4308563 33.189581 8.6445312 33.332031 C 10.011254 34.24318 10.252795 36.046511 11.109375 37.650391 C 11.909298 39.244315 13.635662 40 15.400391 40 L 18 40 L 18 44.802734 C 10.967811 42.320535 5.6646795 36.204613 4.3320312 28.703125 C 5.8629338 28.414776 8.4265387 28.068108 11.912109 28.019531 z M 37.882812 28.027344 C 41.445538 28.05784 44.08105 28.404061 45.669922 28.697266 C 44.339047 36.201504 39.034072 42.31987 32 44.802734 L 32 39.599609 C 32 38.015041 31.479642 36.267712 30.574219 34.810547 C 30.299322 34.368135 29.975945 33.949736 29.615234 33.574219 C 31.930453 33.11684 33.832364 32.298821 35.3125 31.154297 C 36.436824 30.284907 37.287588 29.220424 37.882812 28.027344 z M 23.699219 34.099609 L 26.5 34.099609 C 27.312821 34.099609 28.180423 34.7474 28.875 35.865234 C 29.569577 36.983069 30 38.484177 30 39.599609 L 30 45.398438 C 28.397408 45.789234 26.72379 46 25 46 C 23.27621 46 21.602592 45.789234 20 45.398438 L 20 39.599609 C 20 38.508869 20.467828 37.011307 21.208984 35.888672 C 21.950141 34.766037 22.886398 34.099609 23.699219 34.099609 z M 12.308594 35.28125 C 13.174368 36.179258 14.222525 37 15.800781 37 C 16.579948 37 17.552484 37.028073 18.476562 36.945312 C 18.479848 36.945018 18.483042 36.943654 18.486328 36.943359 C 18.36458 37.293361 18.273744 37.645529 18.197266 38 L 15.400391 38 C 14.167057 38 13.29577 37.55443 12.894531 36.751953 L 12.886719 36.738281 L 12.880859 36.726562 C 12.716457 36.421191 12.500645 35.81059 12.308594 35.28125 z"></path>
                        </svg>
                  </a>
               </span>
            </div>
         </div>
      </footer>
   </section>

   <script>
      let slideSide = 1;
      showSlide(slideSide);

      function showSlide(posisi){
         const slide = document.querySelectorAll('.slide');
         const poin = document.querySelectorAll('.poin');

         // hidden all
         for (let index = 0; index < slide.length; index++) {
            slide[index].classList.add('hidden');
            poin[index].classList.remove('bg-slate-500');   
         }
         
         if (posisi < 1) {
            slideSide = slide.length; 
         }
         if (posisi > slide.length) {
            slideSide = 1;
         }
         const showActive = slide[slideSide-1].classList.remove('hidden')
         if(true){
            poin[slideSide-1].classList.add('bg-slate-500');
         }
      }

      function moveSlide(moveStep){
         showSlide(slideSide += moveStep)
      }

      function curentSlide(index){
         showSlide(slideSide = index)
      }
   </script>
</body>  
</html>