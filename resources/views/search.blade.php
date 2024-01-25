<!DOCTYPE html>
<html lang="en" class="">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>ScreenV | Movie and TV preview</title>
   @vite('resources/css/app.css')
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body class="dark:bg-black dark:text-white">
   {{-- header --}}
   <section class="flex flex-col w-full h-auto min-h-screen">
      {{-- navbar --}}
    @include('header.navbar')
      {{-- search wrapper --}}
    <section class="h-min-screen h-auto w-full flex flex-col">
        <div class="px-10 md:px-20 py-10 relative drop-shadow-[0_0px_4px_rgba(0,0,0,.50)] mx-auto md:mx-0">
            <div class="absolute pointer-events-auto bottom-2/3 px-1 translate-y-3 ">
                <svg class="absolute text-slate-400 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" class="">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </div>
              <input type="search" placeholder="Search" class="pl-9 py-2 focus:outline-none rounded-md" id="keyword">
        </div>

        {{-- content section --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 lg:gap-5 px-0 md:pl-29" id="dataWrapper">            
        </div>

        {{-- loadingnya --}}
        <section class="flex justify-center my-10" id="loadingIcon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 animate-spin-slow">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
              </svg>              
        </section>
        {{-- errorNotifikasi --}}
        <section class="fixed text-center top-25 md:top-6 right-6 bg-red-600 w-32 lg:w-72 min-h-2 rounded-lg p-0 md:p-3" id="notifikasi">
            <span id="notifikasiMessege" class="text-white"></span>
        </section>
    </section>

      {{-- footer --}}
    @include('header.footer')
   </section>

   <script>
    let baseUrl = "<?= $baseUrl ?>";
    let imageBaseUrl = "<?= $imageBaseUrl ?>";
    let apiKey = "<?= $apiKey ?>";
    let searchKeyword = "";

    // hide loadingIcon
    $("#loadingIcon").hide();
    // hide error messege
    $("#notifikasi").hide();

    $('#keyword').on('keyup',function(event){
        // show loading 
        $("#loadingIcon").show();

        console.log("a");
        // tangkep
        searchKeyword = $("#keyword").val();        
        if(searchKeyword){
            search();
            console.log(searchKeyword);
        }
        if((event.which) == 13){
            search();
            $("#loadingIcon").hide();
        }
        return false
    });

    function search(){
        $.ajax({
            type: "get",
            url: `${baseUrl}/search/multi?api_key=${apiKey}&page=1&query=${searchKeyword}`,
            dataType: "json",
            beforeSend:function(){
                    // $("#loadingIcon").show();
                    // clear content 
                    $("#dataWrapper").html('');

                },
                success: function (response) {
                    $("#loadingIcon").hide();
                    if (response.results) {
                        var html= [];
                        response.results.forEach(item => {
                            if(item.media_type == "tv" || item.media_type == "movie"){
                                let searchTitle = "";
                                let detailsUrl= "";
                                let originalDate = "";
                                
                                if(item.media_type == "movie"){
                                    searchTitle = item.title;
                                    detailsUrl = `/movie/${item.id}`;
                                    originalDate = item.release_date;
                                }else{
                                    searchTitle = item.original_name;
                                    detailsUrl = `/tv/${item.id}`;
                                    originalDate = item.first_air_date;
                                }

                                let date = new Date(originalDate);
                                let searchDate = date.toDateString();  
                                let searchImage = `${imageBaseUrl}/original/${item.poster_path}`;
                                let searchRating = item.vote_average *10;

                                html.push(`
                                        <a href="${detailsUrl}" class="group md:mr-6 rounded-2xl transition duration-1000">
                                        <div class="min-w-24 min-h-52 md:min-w-52 md:min-h-72 md:p-5 bg-white drop-shadow-lg rounded-2xl group-hover:drop-shadow-2xl felx flex-col overflow-hidden">
                                        <div class="overflow-hidden ml-[7%] md:w-auto rounded-2xl">
                                            <img class="rounded-2xl h-[200px] w-[180px] sm:w-[160px] sm:h-[190px] md:h-[300px] md:w-[210px] object-cover group-hover:scale-125 transition duration-500" src="${searchImage}" alt="${searchTitle}">
                                        </div>
                                        <h4 class="text-lg w-[130px] md:w-[200px] h-full text-wrap line-clamp-1 font-medium mt-4 mb-1 pl-[7%] group-hover:line-clamp-none">${searchTitle}</h4>
                                        <h6 class="text-sm font-normal pl-[7%] w-[130px] md:w-[200px]">${ searchDate }</h6>
                                        <div class="flex flex-row pl-[7%] my-2 w-[130px] md:w-[200px]">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:fill-ahy-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                            </svg>
                                            <p class="md:ml-2">${searchRating}%</p>
                                        </div>
                                        </div>
                                        </a>
                                    `);
                                    
                            }
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
   </script>
</body>  
</html>