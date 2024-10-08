new Swiper(".slide-container", {
    slidesPerView:1,
    effect: "creative",
    loop: true,
    // loopedSlides: 3,
    creativeEffect: {
       
        prev: {
            translate: ["-100%", 0, 0],
            opacity: 0.3,
            scale: .6
        },
        next: {
            translate: ["100%", 0, 0],
            opacity: 0.3,
            scale: .75
        }
    },
    autoplay:{
        delay:5000,
    },
    speed:800,
    spaceBetween:100,
    
});

new Swiper(".slide-container1", {
    slidesPerView:1,
    effect: "creative",
    loop: true,
    // loopedSlides: 3,
    creativeEffect: {
       
        prev: {
            // translate: ["100%", 0, 0],
            opacity: 0.3,
            scale: .6
        },
        next: {
            // translate: ["100%", 0, 0],
            opacity: 0.3,
            scale: .75
        }
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    autoplay:{
        delay:4000,
    },
    speed:800,
    spaceBetween:100,
    
});




