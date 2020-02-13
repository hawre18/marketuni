@extends('frontend.layout.master')


@section('content')
    <div class="container">
        <div class="row">
            <product-component :category="{{$category}}"></product-component>
        </div>
    </div>

@endsection
