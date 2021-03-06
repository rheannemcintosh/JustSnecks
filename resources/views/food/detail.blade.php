@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Product') }}</div>
                
                <div class="card-body">
                    <img src="{{ asset('images')}}/{{$food->image}}" class="img-fluid">
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail') }}</div>

                <div class="card-body">
                    <h2>{{$food->name}}</h2>
                    <p class="lead">{{$food->description}}</p>
                    <p>£{{$food->price}}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
