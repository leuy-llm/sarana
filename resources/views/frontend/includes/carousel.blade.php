<div class="slide-container swiper">
  <div class="slide-content swiper-wrapper">
    @foreach ($carousels as $slider)
    <div class="overlay swiper-slide">
      <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->name }}" />
      <div class="img-overlay">
        <p>{{$slider->name}}</p>
        <h2>{{$slider->description}}</h2>
      </div>
    </div>
    @endforeach
  </div>
</div>