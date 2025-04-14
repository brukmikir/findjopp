@extends('layouts.app')

@section('content')


<div class="container mt-5">
  @if(Session::has('message'))
  <div class="alert alert-warning text-center">{{Session::get('message')}}</div>
  @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">weekly-20$</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.weekly')}}" class="card-link">
                        <button class="btn btn-success"> pay </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">monthly-100$</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.monthly')}}" class="card-link">
                        <button class="btn btn-success"> pay </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">yearly-200$</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body text-center">
                    <a href="{{route('pay.yearly')}}" class="card-link">
                        <button class="btn btn-success"> pay </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection