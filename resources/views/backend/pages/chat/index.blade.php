@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    @vite('resources/css/app.css')
@endsection

@section('content')

    <!-- Content Row -->
    <div id="adminApp" > </div><!--End App-->

    <!-- Content Row -->
    
@endsection

@section('footer_scripts')
    @vite('resources/js/app.js')
@endsection 
