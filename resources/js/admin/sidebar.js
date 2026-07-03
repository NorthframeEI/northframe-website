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
            secondSidebar.classList.add("hidden");
            return;
        }

        if(secondSidebar.classList.contains("hidden")) {
            // Animation d'ouverture du deuxième aside
            secondSidebar.classList.remove("hidden");
            secondSidebar.style.transform = "translateX(-100%)";
            setTimeout(() => {
                secondSidebar.style.transition = "transform 0.3s ease-in-out";
                secondSidebar.style.transform = "translateX(0)";
            }, 10);
        }else {
            // Animation de fermeture du deuxième aside
            secondSidebar.style.transition = "transform 0.3s ease-in-out";
            secondSidebar.style.transform = "translateX(-100%)";
            setTimeout(() => {
                secondSidebar.classList.add("hidden");
                secondSidebar.style.transition = "";
                secondSidebar.style.transform = "";
            }, 300);
        }   

        // Affiche uniquement le bon panel
        panels.forEach((panel) => {
            if (panel.dataset.panel === menu) {
                panel.classList.remove("hidden");
            } else {
                panel.classList.add("hidden");
            }
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