{{-- <div class="container" >
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
</div> --}}
<style>
    .text-lg-start p{
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
    }
</style>
<div class="container">
    <div class="row flex-lg-row flex-column-reverse">
        @foreach ($about_us as $about)
            <div class="col-lg-6 text-lg-start">
                <?php
                $titleParts = explode(' ', $about->title);
                ?>
                <h3 style="color: #caa169" class="animated-title" data-aos="fade-down-right"
                data-aos-duration="1500">
                    <span style="color: black;" >
                        {{ $titleParts[0] ?? '' }} {{ $titleParts[1] ?? '' }} {{ $titleParts[2] ?? '' }}
                    </span>
                    <br class="d-none d-lg-block">
                    {{ $titleParts[3] ?? '' }} {{ $titleParts[4] ?? '' }}
                </h3>
                <?php
                $firstParagraph = Str::words($about->description, 44, '');
                $secondParagraph = Str::after($about->description, $firstParagraph);
                ?>
                <p class="animated-paragraph" data-aos="fade-right" data-aos-duration="2000">{{ $firstParagraph }}</p>
                <p class="animated-paragraph" data-aos="fade-right" data-aos-duration="3000">{{ $secondParagraph }}</p>
                <a href="#" class="main-btn mt-4">Explore</a>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0 ps-lg-4 hotel-right-side text-center" >
                <div class="img" >
                    <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="2000"/>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        gsap.registerPlugin(ScrollTrigger);

        // Animations for the title
        gsap.from(".animated-title", {
            scrollTrigger: {
                trigger: ".animated-title",
                start: "top 80%", // Trigger animation when top of element reaches 80% of viewport
                toggleActions: "play reverse play reverse", // Replay animation on scroll up and down
            },
            opacity: 0,
            y: 50,
            duration: 1,
            stagger: 0.3,
            ease: "power3.out",
        });

        // Animations for the paragraphs
        gsap.from(".animated-paragraph", {
            scrollTrigger: {
                trigger: ".animated-paragraph",
                start: "top 90%", // Trigger when the top of the paragraph is in view
                toggleActions: "play reverse play reverse",
            },
            opacity: 0,
            x: -50,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out",
        });

        // Animations for the right-side image
        gsap.from(".hotel-right-side img", {
            scrollTrigger: {
                trigger: ".hotel-right-side img",
                start: "top 80%", // Trigger when the image is 80% in view
                toggleActions: "play reverse play reverse",
            },
            opacity: 0,
            scale: 0.8,
            duration: 1,
            ease: "power3.out",
        });
    });
</script> --}}
