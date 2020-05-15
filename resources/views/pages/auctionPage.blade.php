@extends('layouts.app')

@section('head')
<link rel="stylesheet" href={{ asset('css/product.css') }}>
<script src="{{ asset('js/auction_page.js') }}" defer></script>
@endsection

@section('content')
<div class="row" id="product-details">
    <div class="col-lg-7">
        <div class="card">
            <div class="shadow-lg">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425/" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center card-c-element card-body">{{ $name }}</h3>
                <div class="card-c-element card-body">
                    <h3 class="card-title text-center" id="price">{{ $base_bid }}</h3>
                    <h3 id="duration-place" class="card-title text-center"></h3>
                    <p hidden id="timer-start-time">{{ $start_time }}</p>
                    <p hidden id="timer-duration">{{ $duration }}</p>
                    <script>
                        let start_time = document.getElementById("timer-start-time").textContent;
                        let duration = document.getElementById("timer-duration").textContent;
                        let output = document.getElementById("duration-place");
                        let t = start_time.split(/[- :]/)
                        let x = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]))
                        start_time = x.getTime()
                        let end_time = start_time + parseInt(duration)

                        let f = setInterval(function() {
                            let now = new Date().getTime()
                            let distance = end_time - now
                            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            if(distance > 0 ){
                                output.innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s "
                            }
                            else{
                                output.innerHTML = "Expired"
                                clearInterval(f)
                            }
                        }, 1000)
                    </script>
                </div>
                <div class="card-body w-100">
                    <div class="row">
                        <form id="bid-form" class="form-inline" action="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="form-id" value="{{ $id }}">
                                <input id="money" type="number" class="form-control text-center col-12 col-md-8" name="amount" value="110"></input>
                                <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-purple w-100" id="bid-button" value="Bid Now"></input>
                                    <script>
                                        let button = document.getElementById("bid-button");
                                        button.addEventListener("click",
                                            (e)=>{
                                                e.preventDefault();
                                                let value = parseInt(document.getElementById("money").value)
                                                let baseBid = parseInt(document.getElementById("price").innerText)
                                                if(value <= baseBid){
                                                    alert("Temp error msg, but invalid bid")
                                                }

                                                else{
                                                    let request = new XMLHttpRequest()
                                                    request.open("POST",window.location.href+"/bid",true)
                                                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
                                                    request.send(JSON.stringify({bid: value}))
                                                }
                                        })
                                    </script>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">Details </h3>
        <p class="card-text">{{ $description }}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Price variation</h3>
        <img src="../assets/chart.png" class="img-responsive" width="100%" />
    </div>

</div>
@endsection