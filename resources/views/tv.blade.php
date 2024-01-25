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
    <main class="min-h-screen w-full">
        {{-- nav --}}
        @include('header.navbar')

        {{-- sort --}}
        <section class="flex flex-row my-10 items-center ml-6 md:ml-20 lg:ml-28">
            <h4 class="text-2xl font-bold font-inter">Sort</h4>
            <div class="ml-4 relative group">
                <select onchange="changeSort(this)" name="selec" id="selec" class="block appearance-none bg-white hover:drop-shadow-2xl py-2 pr-7 px-4 rounded-lg focus:outline-none focus:bg-white">
                    {{-- this ini akan mengacu pada object yg dimuat this --}}
                    {{-- karena this ada di select maka select akan dikirim ke java script kemudian akan melakukan function changeSort --}}
                    <option value="popularity.desc" class="hover:bg-ahy-400">Popularity (desc)</option>
                    <option value="popularity.asc" class="hover:bg-ahy-400">Popularity (asc)</option>
                    <option value="vote_average.desc" class="hover:bg-ahy-400">Top Rate (desc)</option>
                    <option value="vote_average.asc" class="hover:bg-ahy-400">Top Rate (asc)</option>
                </select>
                <div class="pointer-events-auto absolute right-2 inset-y-0 flex items-center group-active:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                      </svg>                      
                </div>
            </div>
        </section>
        {{-- content --}}
        <section class="grid w-auto md:pl-20 lg:pl-28 grid-cols-2 sm:grid-cols-3 md:grid-cols-3 xl:grid-cols-5 gap-2 md:gap-5" id="dataWrapper">
            @foreach ($tvPage as $data)
            {{-- disini kita akan rubah format tanggalnya menjadi lebih menarik --}}
            @php
                $release = $data['first_air_date'];
                $timestaps = strtotime($release); //disini kita rubah ke timestamps dulu
                $newFormat = date('F j, o',$timestaps);
                $img = $imageBaseUrl.'/original/'.$data['poster_path'];
                $title = $data['original_name'];
            @endphp
            <a href="tv/{{$data['id']}}" class="group md:mr-6 rounded-2xl transition duration-1000">
                <div class="min-w-24 min-h-52 md:min-w-52 md:min-h-72 md:p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col overflow-hidden pl-2">
                   <div class="overflow-hidden ml-[7%] md:w-auto rounded-2xl">
                      <img class="rounded-2xl h-[200px] w-[164] sm:w-[180px] md:h-[300px] md:w-[210px] object-cover group-hover:scale-125 transition duration-500" src="{{$img}}" alt="">
                   </div>
                   <h4 class="text-lg w-[130px] md:w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[7%] group-hover:line-clamp-none">{{ $title }}</h4>
                   <h6 class="text-sm font-normal pl-[7%] w-[130px] md:w-[200px]">{{ $newFormat }}</h6>
                   <div class="flex flex-row pl-[7%] my-2 w-[130px] md:w-[200px]">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                       </svg>
                       <p class="md:ml-2">{{$data['vote_average']*10}}%</p>
                   </div>
                </div>
            </a>    
            @endforeach
            
        </section>

        {{-- loadingnya --}}
        <section class="flex justify-center my-10" id="loadingIcon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 animate-spin-slow">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
              </svg>              
        </section>
        {{-- errorNotifikasi --}}
        <section class="fixed text-center top-6 right-6 bg-red-600 w-72 min-h-5 rounded-lg p-3" id="notifikasi">
            <span id="notifikasiMessege" class="text-white"></span>
        </section>
        {{-- loadMore --}}
        <section class="flex justify-center my-10" id="loadMore">
            <button class="min-w-40 min-h-10 bg-ahy-400 font-inter text-xl font-medium text-white justify-center flex items-center rounded-lg" onclick="loadMore()">
                Load More
            </button>
        </section>

        {{-- footer --}}
        @include('header.footer')
    </main>

    <script>
        let baseUrl = "<?= $baseUrl ?>";
        let imageBaseUrl = "<?= $imageBaseUrl ?>";
        let apiKey = "<?= $apiKey ?>";
        let minimalVote = "<?= $minimalVote ?>";
        let page = "<?= $page ?>";
        let sortBy = "<?= $sortBy ?>";

        // hide loadingIcon
        $("#loadingIcon").hide();
        // hide error messege
        $("#notifikasi").hide();
        function loadMore() {
            // kita akan pakai ajax karena load more akan dijadikan asc realtime
            $.ajax({
                type: "get",
                url: `${baseUrl}/discover/tv?api_key=${apiKey}&page=${++page}&sort_by=${sortBy}&vote_count.gte=${minimalVote}`,
                dataType: "json",
                beforeSend:function(){
                    $("#loadingIcon").show();
                },
                success: function (response) {
                    $("#loadingIcon").hide();

                    // kita get data
                    if (response.results) {
                        var html= [];
                        response.results.forEach(item => {
                            let releaseDate = item.first_air_date;
                            let date = new Date(releaseDate);
                            let tvDate = date.toDateString();                
                            let tvTitle = item.original_name;
                            let tvId = item.id;
                            let tvImage = `${imageBaseUrl}/original/${item.poster_path}`;
                            let tvRating = item.vote_average *10;
                            html.push(`
                                <a href="movie/${tvId}" class="group md:mr-6 rounded-2xl transition duration-1000">
                                <div class="min-w-24 min-h-52 md:min-w-52 md:min-h-72 md:p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col overflow-hidden">
                                <div class="overflow-hidden ml-[7%] md:w-auto rounded-2xl">
                                    <img class="rounded-2xl h-[200px] w-[164] sm:w-[180px] md:h-[300px] md:w-[210px] object-cover group-hover:scale-125 transition duration-500" src="${tvImage}" alt="${tvTitle}">
                                </div>
                                <h4 class="text-lg w-[130px] md:w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[7%] group-hover:line-clamp-none">${tvTitle}</h4>
                                <h6 class="text-sm font-normal pl-[7%] w-[130px] md:w-[200px]">${ tvDate }</h6>
                                <div class="flex flex-row pl-[7%] my-2 w-[130px] md:w-[200px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>
                                    <p class="md:ml-2">${tvRating}%</p>
                                </div>
                                </div>
                                </a>
                            `);
                        });
                        $('#dataWrapper').append(html.join(""));
                    }
                },
                fail:function(jqHXR, ajaxOptions, thrownError){
                    $("#loadingIcon").hide();
                    $("#notifikasiMessege").text("terjadi kendala, coba beberapa saat lagi");
                    $("#notifikasi").show();
                    setTimeout(() => {
                        $("#notifikasi").hide();                        
                    }, 3000);
                },                              
            });
        }

        // disini kita langsung kirim lewat tag html
        function changeSort(component){
            if(component.value){
                // setnew value
                sortBy = component.value;

                // clear
                $('#dataWrapper').html("");
                // reset page nya dan 
                page = 0; //kenapa 0 karena defalutnya ditambah 1

                // getdata, tinggal panggil function loadmore
                loadMore();

            }
        }
    </script>
</body>
</html>