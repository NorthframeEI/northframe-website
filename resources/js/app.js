document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("burger");
    const menu = document.getElementById("menu");
    const navbar = document.getElementById("navbar");

    function updateNavbar() {
        const menuOpen = menu.classList.contains("opacity-100");
        const scrolled = window.scrollY > 10;

        if (menuOpen || scrolled) {
            navbar.classList.add("bg-surface");
        } else {
            navbar.classList.remove("bg-surface");
        }
    }

    burger.addEventListener("click", () => {
        const isOpen = menu.classList.contains("opacity-100");
        burger.classList.toggle("text-secondary");
        burger.classList.toggle("text-hover");
        if (isOpen) {
            menu.classList.remove(
                "opacity-100",
                "translate-y-0",
                "pointer-events-auto",
            );
            menu.classList.add(
                "opacity-0",
                "translate-y-2",
                "pointer-events-none",
            );

        } else {
            menu.classList.remove(
                "opacity-0",
                "translate-y-2",
                "pointer-events-none",
            );
            menu.classList.add(
                "opacity-100",
                "translate-y-0",
                "pointer-events-auto",
            );
        }
updateNavbar();
        // bouton
        burger.classList.toggle("scale-90");
    });
    window.addEventListener("scroll",updateNavbar);

    if (window.scrollY > 10) {
        navbar.classList.add("bg-surface");
    }
});
