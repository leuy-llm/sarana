let nav = document.querySelector('.navbar');
window.onscroll = function(){
    if(document.documentElement.scrollTop >50){
        nav.classList.add('header-scrolled');
    }
    else{
        nav.classList.remove('header-scrolled');   
    }
}


//nav-link
let navbar = document.querySelectorAll('.nav-link');
let navCollapse = document.querySelector('.navbar-collapse.collapse');
navbar.forEach(function(a){
    a.addEventListener('click',()=>{
        navCollapse.classList.remove("show");
    })
})


const scrollup = () => {
    const scrollupButton = document.getElementById("scroll-up");
    // When the scroll position is higher than 350px, add 'show-scroll' class
    if (window.scrollY >= 350) {
        scrollupButton.classList.add('show-scroll');
    } else {
        scrollupButton.classList.remove('show-scroll');
    }
};

// Smooth scroll to top when the button is clicked
document.getElementById("scroll-up").addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Smooth scroll to the top
    });
});

// Add scroll event listener to show/hide the button
window.addEventListener("scroll", scrollup);