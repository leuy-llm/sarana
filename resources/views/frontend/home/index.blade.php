@extends('layout.master')
@section('style')

    <style>
        /* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.btn-primary {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
}

    </style>
@endsection
@section('content')
    <section  class="banner_wrapper p-0 " data-aos="fade-up" data-aos-duration="2000">
        @include('frontend.includes.carousel')
    </section>
    <!--========= About ==========-->
    <section id="about" class="about_wrapper" >
        @include('frontend.includes.about')
        @yield('content')
    </section>
    <!--Room Section-->
    <section id="rooms" class="rooms_wrapper">
        @include('frontend.includes.our_room')
      </section>
      {{-- @include('auth.register')  --}}
     
      <div class="welcome-container">
        <img src="{{ asset('hotel') }}/image/couple.png" alt="Welcome to Sinaka Angkor Hotel" class="welcome-image"
            style="z-index: 999;">
    </div>
    
@endsection

@section('script')
</script>
  AOS.init();
</script>
@endsection
