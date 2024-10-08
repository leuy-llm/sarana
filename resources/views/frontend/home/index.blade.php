@extends('layout.master')
@section('content')
    <section  class="banner_wrapper p-0">
        @include('frontend.includes.carousel')
    </section>
    <!--========= About ==========-->
    <section id="about" class="about_wrapper">
        @include('frontend.includes.about')
        @yield('content')
    </section>
    <!--Room Section-->
    <section id="rooms" class="rooms_wrapper">
        @include('frontend.includes.our_room')
    </section>
@endsection
