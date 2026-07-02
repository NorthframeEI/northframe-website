export default function initAccordion() {
    const accordion = document.getElementById("accordion-card");

    if (!accordion) return;

    const buttons = accordion.querySelectorAll("[data-accordion-target]");

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const targetSelector = button.getAttribute("data-accordion-target");
            const target = document.querySelector(targetSelector);

            if (!target) return;

            const isOpen = !target.classList.contains("hidden");

            // Ferme tout
            buttons.forEach((btn) => {
                const selector = btn.getAttribute("data-accordion-target");
                const body = document.querySelector(selector);
                const icon = btn.querySelector("[data-accordion-icon]");

                btn.setAttribute("aria-expanded", "false");
                btn.classList.remove("rounded-b-none");
                if (body) {
                    body.classList.add("hidden");
                }

                if (icon) {
                    icon.classList.remove("rotate-180");
                }
            });

            // Si l'élément cliqué était fermé, on l'ouvre
            if (!isOpen) {
                target.classList.remove("hidden");
                button.setAttribute("aria-expanded", "true");
                button.classList.add("rounded-b-none");
                const icon = button.querySelector("[data-accordion-icon]");
                if (icon) {
                    icon.classList.add("rotate-180");
                }
            }
        });
    });
}
