document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".article-slider");
    let scrollInterval;

    function startScroll() {
        scrollInterval = setInterval(() => {
            slider.scrollLeft += 2;
        }, 30);
    }

    function stopScroll() {
        clearInterval(scrollInterval);
    }

    slider.addEventListener("mouseenter", stopScroll);
    slider.addEventListener("mouseleave", startScroll);

    startScroll();
});
