export default function initNavBurger() {
    const burger = document.getElementById("burger");
    const menu = document.getElementById("menu");
    const navbar = document.getElementById("navbar");

    if (!burger || !menu || !navbar) return;

    function updateNavbar() {
        const menuOpen = menu.classList.contains("opacity-100");
        const scrolled = window.scrollY > 10;

        if (menuOpen || scrolled) {
            navbar.classList.add("bg-surface");
            navbar.classList.remove("bg-transparent");
        } else {
            navbar.classList.add("bg-transparent");
            navbar.classList.remove("bg-surface");
        }
    }

    function closeMenu() {
        menu.classList.remove(
            "opacity-100",
            "translate-y-0",
            "pointer-events-auto",
        );

        menu.classList.add("opacity-0", "translate-y-2", "pointer-events-none");

        burger.classList.remove("text-hover", "scale-90");
        burger.classList.add("text-secondary");

        updateNavbar();
    }

    burger.addEventListener("click", () => {
        const isOpen = menu.classList.contains("opacity-100");

        if (isOpen) {
            closeMenu();
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

            burger.classList.toggle("text-secondary");
            burger.classList.toggle("text-hover");
            burger.classList.toggle("scale-90");
        }

        updateNavbar();
    });

    const mobileLinks = document.querySelectorAll("#menu a");

    mobileLinks.forEach((link) => {
        link.addEventListener("click", () => {
            closeMenu();
        });
    });

    window.addEventListener("scroll", updateNavbar);

    if (window.scrollY > 10) {
        navbar.classList.add("bg-surface");
    }
}
