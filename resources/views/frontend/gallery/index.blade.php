<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    .gallery-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .swiper2 {
        width: 100%;
        height: 500px;
        border-radius: 5px;
    }

    .swiper-slide2 {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
        border-radius: 5px;
    }

    .swiper-slide2 img {
        width: 90%;
        height: 100%;
        object-fit: cover;
     
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .swiper-slide2.swiper-slide-active img {
        transform: scale(1.1);
        border-radius: 5px;
    }

    .swiper-pagination-bullet {
        background-color: #007bff;
    }
    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
        padding: 15px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-top: -40px;

    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: #b8ae22d3;

        transform: scale(1.1);

    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;

        font-weight: bold;
    }


    .swiper-button-next {
        right: 10px;

    }

    .swiper-button-prev {
        left: 10px;

    }

    h2 {
        font-family: "Sail", system-ui;
        font-size: 40px;
        margin-bottom: 110px;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 30px;
            margin-bottom: 60px;
        }

        h3 {
            font-size: 25px;
        }

        h6 {
            font-size: 20px;
        }

        h4 {
            font-size: 18px;
        }

        p {
            font-size: 16px;
        }

        .swiper2 {
            height: 350px;
            margin-bottom: 30px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            display: none;
        }

    }
</style>
<div class="container-fluid mt-5" style="margin-bottom: 200px;">
    <h2 class="text-center">Our Hotel Gallery</h2>
    <div class="swiper swiper2">
        <div class="swiper-wrapper swiper-wrapper2">
            @foreach ($galleries as $gallery)
              
                <div class="swiper-slide swiper-slide2">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="round">
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Swiper.js JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // const swiper = new Swiper('.swiper2', {
    //     loop: true,
    //     effect: 'coverflow',
    //     grabCursor: true,

    //     autoplay: {
    //         delay: 3000,
    //         disableOnInteraction: false,
    //     },
    //     slidesPerView: 30, // Display 3 images
    //     centeredSlides: true, // Center the middle image
    //     spaceBetween: 30,
    //     satisfiesSlides: true,
    //     // speed: 800,    

    //     breakpoints: {
    //         768: {
    //             slidesPerView: 2, // Show 2 images for tablets
    //             spaceBetween: 20,
    //         },
    //         480: {
    //             slidesPerView: 1, // Show 1 image for smaller screens
    //         },
    //     }, 
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    // });

    const swiper = new Swiper('.swiper2', {
    loop: true,
    effect: 'coverflow',
    grabCursor: true,
    speed:800,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    slidesPerView: 3, // Show 3 images
    centeredSlides: true, // Center the middle image
    spaceBetween: 30,
    coverflowEffect: {
        rotate: 0, // Rotation angle
        stretch: 80, // Stretch space between slides
        depth: 350, // Depth for 3D effect
        modifier: 1, // Strength of the effect
        slideShadows: true, // Add shadows for better depth effect
        scale: 0.85, // Scale down non-active slides
    },
    breakpoints: {
        768: {
            slidesPerView: 2, // Show 2 images on tablets
            spaceBetween: 20,
        },
        480: {
            slidesPerView: 1, // Show 1 image on smaller screens
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

// const swiper = new Swiper('.swiper2',{
//     effect: "coverflow",
//     grabCursor: true,
//     loop: true,
//     centeredSlides: true,
//     initialSlides:true,
//     speed:600,
//     preventClickss:true,
//     slidesPerView: "auto",
//     spaceBetween: 30,
//     coverflowEffect: {
//         rotate: 0,
//         stretch: 80,
//         depth: 150,
//         modifier: 1,
//         slideShadows: true,
//         scale: 0.85
//     },
    
// })

</script>
