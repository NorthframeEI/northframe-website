document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("burger");
    const menu = document.getElementById("menu");

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

        // bouton
        burger.classList.toggle("scale-90");
    });
});
