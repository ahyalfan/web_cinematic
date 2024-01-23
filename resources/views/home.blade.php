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
            <div class="absolute top-1/2 -translate-y-1/2 translate-x-1/2" onclick="moveSlide(-1)">
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
      
      <div class="mt-10 ml-20 text-xl font-inter font-semibold">
         <h3 class="">Top 10 Movie</h3>
      </div>

      <div class="flex flex-nowrap overflow mt-3 ml-20 pb-5 font-inter mb-96">
         <a href="movie/id" class="group">
            <div class="min-w-52 min-h-72 p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col transition duration-200 overflow-hidden">
               <div class="overflow-hidden rounded-2xl">
                  <img class="rounded-2xl h-[300px] w-[210px] object-cover group-hover:scale-125" src="https://via.placeholder.com/210x300" alt="">
               </div>
               <h4 class="text-lg w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[3%] group-hover:line-clamp-none">nama</h4>
               <h6 class="text-sm font-normal pl-[3%]">2000</h6>
               <div class="flex flex-row pl-[3%] my-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                   </svg>
                   <p class="ml-2">rating</p>
               </div>
            </div>
         </a>
      </div>
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