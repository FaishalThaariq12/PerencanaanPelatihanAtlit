// Navbar Fixed
window.onscroll = function () {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;
    const toTop = document.querySelector('#to-top');

    if (window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
        toTop.classList.remove('hidden');
        toTop.classList.add('flex');
    } else {
        header.classList.remove('navbar-fixed');
        toTop.classList.remove('flex');
        toTop.classList.add('hidden');
    }
};

// Hamburger
const hamburger = document.querySelector('#hamburger');
const navMenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function () {
    hamburger.classList.toggle('hamburger-active');
    navMenu.classList.toggle('hidden');
});

// Klik di luar hamburger
window.addEventListener('click', function (e) {
    if (e.target != hamburger && e.target != navMenu) {
        hamburger.classList.remove('hamburger-active');
        navMenu.classList.add('hidden');
    }
});


// Slider infinity auto>>>>
const scrollers = document.querySelectorAll(".scroller");

// If a user hasn't opted in for recuded motion, then we add the animation
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    addAnimation();
}

function addAnimation() {
scrollers.forEach((scroller) => {
    // add data-animated="true" to every `.scroller` on the page
    scroller.setAttribute("data-animated", true);

    // Make an array from the elements within `.scroller-inner`
    const scrollerInner = scroller.querySelector(".scroller__inner");
    const scrollerContent = Array.from(scrollerInner.children);

    // For each item in the array, clone it
    // add aria-hidden to it
    // add it into the `.scroller-inner`
    scrollerContent.forEach((item) => {
        const duplicatedItem = item.cloneNode(true);
        duplicatedItem.setAttribute("aria-hidden", true);
        scrollerInner.appendChild(duplicatedItem);
        });
    });
}


// WOWWWWWWW
document.addEventListener("DOMContentLoaded", function () {
        const slider = document.getElementById("slider");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
    
        let currentIndex = 0;
        let isAnimating = false; // Menandakan apakah slider sedang dalam animasi otomatis
    
        function showSlide(index) {
        const translateValue = -index * 100 + "%";
        slider.style.transform = "translateX(" + translateValue + ")";
        }
    
        function showNextSlide() {
        currentIndex = (currentIndex + 1) % slider.children.length;
        showSlide(currentIndex);
        }
    
        function showPrevSlide() {
        currentIndex = (currentIndex - 1 + slider.children.length) % slider.children.length;
        showSlide(currentIndex);
        }
    
        nextBtn.addEventListener('click', function() {
        if (!isAnimating) {
            isAnimating = true;
            showNextSlide();
            setTimeout(function() {
            isAnimating = false;
            }, 500); // Durasi transisi dalam milidetik
        }
        });
    
        prevBtn.addEventListener('click', function() {
        if (!isAnimating) {
            isAnimating = true;
            showPrevSlide();
            setTimeout(function() {
            isAnimating = false;
            }, 500); // Durasi transisi dalam milidetik
        }
        });

    // Berhenti animasi otomatis
    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Panggil fungsi stopAutoSlide saat tombol prev/next ditekan
    prevBtn.addEventListener('click', stopAutoSlide);
    nextBtn.addEventListener('click', stopAutoSlide);
});

// Script untuk vanila lightbox
const lightbox = document.createElement('div')
lightbox.id = 'lightbox'
document.body.appendChild(lightbox)
    const specificDiv = document.getElementById('specificDivId');
        specificDiv.addEventListener('click', e => {
        lightbox.classList.add('active')
    const img = document.createElement('img')
        img.src = e.target.src
        while (lightbox.firstChild) {
            lightbox.removeChild(lightbox.firstChild)
        }
            lightbox.appendChild(img)
        })
lightbox.addEventListener('click', e => {
    if (e.target !== e.currentTarget) return
    lightbox.classList.remove('active')
})

// Untuk DropDown 
function toggleDropdown(){
    let dropdown = document.querySelector('#dropdown');
    let img = document.querySelector('#dropdownButton img');

    dropdown.classList.toggle("hidden");
    img.classList.toggle("rotate-down"); // Toggle class untuk rotasi gambar
}