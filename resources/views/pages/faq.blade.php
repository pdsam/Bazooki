@extends('layouts.app')

@section('title', 'Bazooki - FAQ')

@section('head')
    <link rel="stylesheet" href={{ asset('css/faq.css') }}>
@endsection

@section('content')
<div class="jumbotron section-jumbotron">
    <h1 class="display-4">FAQ <i class="fas fa-question-circle"></i></h1>
    <hr class="my-2">
    <p class="lead">“It is not the answer that enlightens, but the question.”</p>
    <p>- Eugene Ionesco</p>
</div>
<div class="row">
    <div class="col-12 mx-auto">
        <div class="accordion" id="faqExample">
            <div class="card">
                <div class="card-header p-2" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span>Q.</span> What is Bazooki?
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                    <div class="card-body">
                        Check out our <a href="/about">About page.</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span>Q.</span> Where can I check my bids?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                    <div class="card-body">
                        All of your activity is displayed on your profile! This includes your active bids, your past won auctions and auctions you have created!
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span>Q.</span> How are the deliveries affected by Covid-19?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                    <div class="card-body">
                        You should expect a delay of 1-2 weeks due to the current Covid-19 situation. But rest assured, your items will arrive!
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <span>Q.</span> How is your website so pretty?
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                    <div class="card-body">
                        It's all about the Panda!
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <span>Q.</span> How can I ask a question that is not listed here?
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqExample">
                    <div class="card-body">
                        Check out our <a href="/contact">Contacts page</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection