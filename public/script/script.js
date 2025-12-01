document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector("[data-collapse-toggle='mobile-menu-2']");
    const menu = document.getElementById("mobile-menu-2");
    const navbar = document.getElementById("navbar-container");
    const nav = document.querySelector("nav");

    if (!toggleBtn || !menu || !navbar || !nav) return;

    const svgIcons = toggleBtn.querySelectorAll("svg");
    const openIcon = svgIcons[0];
    const closeIcon = svgIcons[1];
    closeIcon.classList.add("hidden");

    toggleBtn.addEventListener("click", function () {
        const isHidden = menu.classList.contains("hidden");

        if (isHidden) {
            menu.classList.remove("hidden");
            menu.classList.add("opacity-100", "max-h-screen");
            openIcon.classList.add("hidden");
            closeIcon.classList.remove("hidden");
            navbar.style.borderRadius = "28px";
            navbar.classList.remove("rounded-full");

        } else {
            menu.classList.remove("opacity-100", "max-h-screen");
            menu.classList.add("hidden");
            openIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
            if (window.scrollY > 50) {
                navbar.style.borderRadius = "28px";
                navbar.classList.remove("rounded-full");

            } else {
                navbar.style.borderRadius = "9999px";
                navbar.classList.add("rounded-full");
            }
        }
    });

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled-nav", "shadow-lg");
            nav.classList.remove("top-4", "lg:top-7");
            nav.classList.add("top-2");
        } else {
            navbar.classList.remove("scrolled-nav", "shadow-lg");
            nav.classList.remove("top-2");
            nav.classList.add("top-4", "lg:top-7");
        }
    });
});



//faq
document.addEventListener("DOMContentLoaded", function () {
    const accordions = document.querySelectorAll("[data-accordion='default-accordion'] .accordion");

    accordions.forEach((accordion) => {
        const toggle = accordion.querySelector(".accordion-toggle");
        const content = accordion.querySelector(".accordion-content");
        const plusIcon = accordion.querySelector("svg:nth-of-type(1)");
        const minusIcon = accordion.querySelector("svg:nth-of-type(2)");

        if (accordion.classList.contains("active")) {
            content.style.maxHeight = content.scrollHeight + "px";

            plusIcon.classList.add("hidden");
            minusIcon.classList.remove("hidden");
        } else {
            content.style.maxHeight = "0px";
            content.style.paddingTop = "0px";
            plusIcon.classList.remove("hidden");
            minusIcon.classList.add("hidden");
        }

        toggle.addEventListener("click", () => {
            const isActive = accordion.classList.contains("active");

            accordions.forEach((item) => {
                item.classList.remove("active");
                const itemContent = item.querySelector(".accordion-content");
                const itemPlus = item.querySelector("svg:nth-of-type(1)");
                const itemMinus = item.querySelector("svg:nth-of-type(2)");
                itemContent.style.maxHeight = "0px";
                itemContent.style.paddingTop = "0px";
                itemPlus.classList.remove("hidden");
                itemMinus.classList.add("hidden");
            });


            if (!isActive) {
                accordion.classList.add("active");
                content.style.maxHeight = content.scrollHeight + "px";

                plusIcon.classList.add("hidden");
                minusIcon.classList.remove("hidden");
            } else {
                accordion.classList.remove("active");
                content.style.maxHeight = "0px";
                content.style.paddingTop = "0px";
                plusIcon.classList.remove("hidden");
                minusIcon.classList.add("hidden");
            }
        });
    });
});

// timer

document.addEventListener("DOMContentLoaded", () => {
    const countdownDate = new Date("2025-12-31T23:59:59").getTime();

    const timerInterval = setInterval(() => {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const daysEl = document.querySelector(".days");
        const hoursEl = document.querySelector(".hours");
        const minutesEl = document.querySelector(".minutes");
        const secondsEl = document.querySelector(".seconds");

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

        if (distance <= 0) {
            clearInterval(timerInterval);
            daysEl.innerHTML = hoursEl.innerHTML =
            minutesEl.innerHTML = secondsEl.innerHTML = "00";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        daysEl.innerHTML = String(days).padStart(2, "0");
        hoursEl.innerHTML = String(hours).padStart(2, "0");
        minutesEl.innerHTML = String(minutes).padStart(2, "0");
        secondsEl.innerHTML = String(seconds).padStart(2, "0");
    }, 1000);
});



