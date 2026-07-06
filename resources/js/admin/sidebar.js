export default function initSidebar() {
    const buttons = document.querySelectorAll(".menu-btn");
    const panels = document.querySelectorAll(".menu-panel");
    const secondSidebar = document.getElementById("second-sidebar");

    if (!buttons.length || !secondSidebar) return;

    function openMenu(menu) {
        // Réinitialise les boutons
        buttons.forEach((button) => {
            button.classList.remove("bg-neutral-tertiary");
        });

        // Active le bouton sélectionné
        const activeButton = document.querySelector(`[data-menu="${menu}"]`);
        if (activeButton) {
            activeButton.classList.add("bg-neutral-tertiary");
        }

        // Dashboard => cache le deuxième aside
        if (menu === "dashboard") {
            if (!secondSidebar.classList.contains("hidden")) {
                secondSidebar.style.transition = "transform 0.3s ease-in-out";
                secondSidebar.style.transform = "translateX(-100%)";

                setTimeout(() => {
                    secondSidebar.classList.add("hidden");
                    secondSidebar.style.transition = "";
                    secondSidebar.style.transform = "";
                }, 300);
            }

            return;
        }

        // Si le sidebar est fermé, on l'ouvre
        if (secondSidebar.classList.contains("hidden")) {
            secondSidebar.classList.remove("hidden");
            secondSidebar.style.transform = "translateX(-100%)";

            requestAnimationFrame(() => {
                secondSidebar.style.transition = "transform 0.3s ease-in-out";
                secondSidebar.style.transform = "translateX(0)";
            });
        }

        // Ici on ne le ferme JAMAIS.
        // On change juste le contenu.

        panels.forEach((panel) => {
            panel.classList.toggle("hidden", panel.dataset.panel !== menu);
        });
    }

    // Gestion des clics
    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            console.log("Menu :", button.dataset.menu); // Debug
            openMenu(button.dataset.menu);
        });
    });

    // État initial
    openMenu("dashboard");
}
