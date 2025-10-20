const navLinks = document.querySelectorAll(" .nav-menu .nav-link");
const menuOpenButton = document.querySelector("#menu-open-button");
const menuCloseButton = document.querySelector("#menu-close-button");


menuOpenButton.addEventListener("click",() => {
    document.body.classList.toggle("show-mobile-menu");
})
// Close menu when the close button is clicked
menuCloseButton.addEventListener("click",() => menuOpenButton.click());

// Close menu when the nav( About, Menu , Gallery , Contact) button is clicked
navLinks.forEach(link => {
 link.addEventListener("click", () => menuOpenButton.click());z
});

const swiper = new Swiper('.slider-wrapper', {
    loop: true, //Enable infinite looping of slides
    grabCursor: true, //Changes the cursor to a "grabbing hand" when hovering over the slider
    spaceBetween: 25, //Sets 25 pixels of space between each slide
  
    // Add pagination (dots) to the slider
    pagination: {
      el: '.swiper-pagination',
      clickable: true, // Makes the dot clickable and dynamically sized
      dynamicBullets: true,
    },  
  
    // Adds "Next" and "Previous" arrow buttons for navigating slider
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },  
 // Adjusts the number of slides visible depending on the screen width
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        }
    }
  });