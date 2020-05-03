@extends('layouts.app')

@section('title', 'Bazooki - Faq')

@section('head')
@endsection

@section('content')
<div class="jumbotron">
    <h1 class="display-4">FAQ <i class="fas fa-question-circle"></i></h1>
    <hr class="my-4">
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
                            Q: Who are we?
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Q: What is Bootstrap 4?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Q. What is another question?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                    <div class="card-body">
                        The answer to the question can go here.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-2" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Q. What is the next question?
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection