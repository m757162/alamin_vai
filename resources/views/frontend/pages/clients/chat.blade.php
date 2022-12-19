

@extends('frontend.master')

@section('title', 'Profile | Easy Bangladesh')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/profile.css') }}">
    <link href="{{ asset('frontend/assets/css/chat.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
@endsection

@section('content')
<section class="profile-section">
    <div class="container" data-aos="fade-up">
        <div id="app">
            <input type="text" v-model="sender_id" value="{{ auth()->user()->id }}">
            
        </div><!--End App-->

    </div><!--End Container-->

</section>
@endsection

@section('footer_scripts')
    @vite('resources/js/app.js')
@endsection 