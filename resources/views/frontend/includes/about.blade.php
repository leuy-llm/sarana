<div class="container">
    <div class="row flex-lg-row flex-column-reverse">
        @foreach ($about_us as $about)
            <div class="col-lg-6  text-lg-start">
                <?php
                // Split the title into parts for styling
                $titleParts = explode(' ', $about->title);
                ?>
                <h3 style="color: #caa169">
                    <span style="color: black;">
                        <!-- Safely access array keys and check if they exist -->
                        {{ $titleParts[0] ?? '' }} {{ $titleParts[1] ?? '' }} {{ $titleParts[2] ?? '' }}
                    </span>
                    <br class="d-none d-lg-block">
                    {{ $titleParts[3] ?? '' }} {{ $titleParts[4] ?? '' }}
                </h3>
                <?php
                $firstParagraph = Str::words($about->description, 44, '');
                $secondParagraph = Str::after($about->description, $firstParagraph);
                ?>
                <p>{{ $firstParagraph }}</p>
                <p>{{ $secondParagraph }}</p>
                <a href="#" class="main-btn mt-4">Explore</a>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-4 hotel-right-side text-center">
                <div class="img">
                  <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" />
                </div>
            </div>
        @endforeach
    </div>
</div>
