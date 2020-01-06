@extends('frontend.layout.master')


@section('content')
    <div id="app" class="container">
        <div class="row">
            <product-component :category="{{$category}}"></product-component>
        </div>
    </div>

@endsection

@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
