@extends('layout.base', ['title'=>@$title,'description'=>@$description])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/card-flickity.css') }}">
@endsection

@section('js_head')

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.pkgd.min.js'></script>
    <script src='https://npmcdn.com/flickity@2/dist/flickity.pkgd.js'></script><script  src="./script.js"></script>

@endsection


@section('content')
    <div class="my-4 px-3 py-1">
        <h3 class="">Lançamentos</h3>
    </div>

    <div class="carousel">
        <div class="slider">

            @forelse($filmes->lancamentos as $filme)
                <div class="card">
                    @if($filme->imagem)
                        <div class="card-bg position-relative" style="background-image: url({{$filme->imagem[0]->imagem_url}});">
                            {{-- Caso o filme ainda não tenha lançado --}}
                            @if($filme->dataLancamento > date("Y-m-d"))
                                <span class="badge rounded-pill bg-black border border-primary position-absolute" style="top: 10px; left: 10px;">
                                    {{ $filme->dataLancamento }}
                                </span>
                            @endif
                        </div>
                    @else
                        <div class="card-bg" style="background-image: url();">
                            {{-- Caso o filme ainda não tenha lançado --}}
                            @if($filme->dataLancamento > date("Y-m-d"))
                                <span class="badge rounded-pill bg-black border border-primary position-absolute" style="top: 10px; left: 10px;">
                                    {{ $filme->dataLancamento }}
                                </span>
                            @endif
                        </div>
                    @endif
                    <div class="card-body card-glass w-100 rounded-0">
                        <p class="card-title">{{ $filme->nome }}</p>
                        @if($filme->dataLancamento <= date("Y-m-d"))
                            <button type="button" class="btn btn-outline-primary w-100">Ver Sessões</button>
                        @else
                            <button type="button" class="btn btn-warning w-100">
                                <i class="fa-solid fa-circle-info"></i>
                                Informações
                            </button>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>

    <div class="my-4 px-6 py-6">
        <h3 class="">Cinemas</h3>

        @forelse($filmes->lancamentos as $filme)
        <div class="card">
            @if($filme->imagem)
                <div class="card-bg position-relative" style="background-image: url({{$filme->imagem[0]->imagem_url}});">
                    {{-- Caso o filme ainda não tenha lançado --}}
                    @if($filme->dataLancamento > date("Y-m-d"))
                        <span class="badge rounded-pill bg-black border border-primary position-absolute" style="top: 10px; left: 10px;">
                            {{ $filme->dataLancamento }}
                        </span>
                    @endif
                </div>
            @else
                <div class="card-bg" style="background-image: url();">
                    {{-- Caso o filme ainda não tenha lançado --}}
                    @if($filme->dataLancamento > date("Y-m-d"))
                        <span class="badge rounded-pill bg-black border border-primary position-absolute" style="top: 10px; left: 10px;">
                            {{ $filme->dataLancamento }}
                        </span>
                    @endif
                </div>
            @endif
            <div class="card-body card-glass w-100 rounded-0">
                <p class="card-title">{{ $filme->nome }}</p>
                @if($filme->dataLancamento <= date("Y-m-d"))
                    <button type="button" class="btn btn-outline-primary w-100">Ver Sessões</button>
                @else
                    <button type="button" class="btn btn-warning w-100">
                        <i class="fa-solid fa-circle-info"></i>
                        Informações
                    </button>
                @endif
            </div>
        </div>
    @empty
    @endforelse
    </div>

@endsection

@section('js_foot')
    <script>
        (function ($) {
        $(function () {
          var slider = $(".slider").flickity({
            imagesLoaded: true,
            percentPosition: false,
            prevNextButtons: false, //true = enable buttons
            initialIndex: 3,
            pageDots: false, //true = enable dots
            groupCells: 1,
            selectedAttraction: 0.2,
            friction: 0.8,
            draggable: true
          });

          //this enables clicking on cards
          slider.on(
            "staticClick.flickity",
            function (event, pointer, cellElement, cellIndex) {
              console.log(cellElement)
              if (typeof cellIndex == "number") {
                slider.flickity("selectCell", cellIndex);
              }
            }
          );

          //this resizes the cards and centers the carousel because it tends to move a few pixels to the right if .resize() and .reposition() aren't used
          var flkty = slider.data("flickity");
          flkty.selectedElement.classList.add("is-custom-selected");
          flkty.resize();
          flkty.reposition();
          let time = 0;
          function reposition() {
            flkty.reposition();
            if (time++ < 10) {
              requestAnimationFrame(reposition);
            } else {
              $(".flickity-prev-next-button").css("pointer-events", "auto");
            }
          }
          requestAnimationFrame(reposition);

          // this expands the cards when in focus
          flkty.on("settle", () => {
            $(".card").removeClass("is-custom-selected");
            $(".flickity-prev-next-button").css("pointer-events", "none");
            flkty.selectedElement.classList.add("is-custom-selected");

            let time = 0;
            function reposition() {
              flkty.reposition();
              if (time++ < 10) {
                requestAnimationFrame(reposition);
              } else {
                $(".flickity-prev-next-button").css("pointer-events", "auto");
              }
            }
            requestAnimationFrame(reposition);
          });

          //this reveals the carousel
          $(".carousel").addClass("animation-reveal");
          $(".carousel").css("opacity", "0");
          flkty.resize();
          flkty.reposition();
          setTimeout(() => {
            $(".carousel").removeClass("animation-reveal");
            $(".carousel").css("opacity", "1");
            flkty.resize();
            flkty.reposition();
            let time = 0;
            function reposition() {
              flkty.reposition();
              if (time++ < 10) {
                requestAnimationFrame(reposition);
              }
            }
            requestAnimationFrame(reposition);
          }, 10);
        });
      })(jQuery);

    </script>
@endsection