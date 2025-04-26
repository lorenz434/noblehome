document.addEventListener("DOMContentLoaded", function () {
    // --- 1. Auto Slideshow for construction images ---
    const constructionImages = document.querySelectorAll('.construction-img');
    let currentConstruction = 0;

    function showNextConstruction() {
        constructionImages[currentConstruction]?.classList.remove('active');
        currentConstruction = (currentConstruction + 1) % constructionImages.length;
        constructionImages[currentConstruction]?.classList.add('active');
    }

    if (constructionImages.length) {
        setInterval(showNextConstruction, 2000);
    }

    // --- 2. Auto Slideshow for product images (mySlides class) ---
    let productIndex = 0;

    function plusSlides(n) {
        showProductSlides(productIndex + n);
    }

    function showProductSlides(n) {
        const productSlides = document.getElementsByClassName("mySlides");
        if (!productSlides.length) return;

        if (n >= productSlides.length) productIndex = 0;
        else if (n < 0) productIndex = productSlides.length - 1;
        else productIndex = n;

        Array.from(productSlides).forEach(slide => slide.style.display = "none");
        productSlides[productIndex].style.display = "block";
    }

    showProductSlides(productIndex);
    setInterval(() => plusSlides(1), 2000);

    // --- 3. Manual Carousel ---
    const carouselTrack = document.querySelector('.carousel-track');
    const nextButton = document.querySelector('.carousel-btn.next');
    const prevButton = document.querySelector('.carousel-btn.prev');
    const carouselItems = document.querySelectorAll('.carousel-slide');

    let carouselIndex = 0;
    const itemsPerSlide = 3;
    const totalItems = carouselItems.length;
    const totalSlides = Math.ceil(totalItems / itemsPerSlide);

    function updateCarousel() {
        const percentageShift = carouselIndex * (100);
        carouselTrack.style.transform = `translateX(-${percentageShift}%)`;
    }

    nextButton?.addEventListener('click', () => {
        if (carouselIndex < totalSlides - 1) {
            carouselIndex++;
            updateCarousel();
        }
    });

    prevButton?.addEventListener('click', () => {
        if (carouselIndex > 0) {
            carouselIndex--;
            updateCarousel();
        }
    });

    updateCarousel(); // Initial position
});
