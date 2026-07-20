export default function initNavPill() {
    const links = document.querySelectorAll(".nav-item");
    const pill = document.getElementById("nav-pill");

    if (!links.length || !pill) return;

    // =========================
    // 🧠 STATE
    // =========================
    let isClickNavigation = false;
    let currentActive = null;

    // =========================
    // 👉 MOVE PILL
    // =========================
    function movePill(el) {
        const rect = el.getBoundingClientRect();
        const parentRect = el.parentElement.getBoundingClientRect();

        const x = rect.left - parentRect.left;
        const width = rect.width;

        pill.style.opacity = 1;
        pill.style.transform = `translateX(${x + width / 2 - 9}px)`;
    }

    // =========================
    // 👉 CLEAR NAV
    // =========================
    function clearNav() {
        links.forEach((l) => l.classList.remove("nav-active"));
        pill.style.opacity = 0;
        currentActive = null;
    }

    // =========================
    // 👉 SET ACTIVE
    // =========================
    function setActive(link) {
        if (!link) return;

        currentActive = link;

        links.forEach((l) => l.classList.remove("nav-active"));
        link.classList.add("nav-active");

        movePill(link);
    }

    // =========================
    // 🔥 SCROLL SPY (CENTRE ÉCRAN = ULTRA STABLE)
    // =========================
    function getActiveSection() {
        const sections = document.querySelectorAll("section[id]");
        const scrollMiddle = window.innerHeight / 2;

        let closest = null;
        let closestDistance = Infinity;

        sections.forEach((section) => {
            const rect = section.getBoundingClientRect();

            // ❌ ignore sections trop en dehors du viewport
            if (rect.bottom < 0 || rect.top > window.innerHeight) return;

            const sectionMiddle = rect.top + rect.height / 2;

            const distance = Math.abs(sectionMiddle - scrollMiddle);

            if (distance < closestDistance) {
                closestDistance = distance;
                closest = section;
            }
        });

        return closest;
    }

    function onScroll() {
        if (isClickNavigation) return;

        // Empêche le clearNav sur /templates
        if (window.location.pathname !== "/") return;

        const activeSection = getActiveSection();
        if (!activeSection) return;

        const id = activeSection.id;

        const activeLink = document.querySelector(`.nav-item[href$="#${id}"]`);

        if (activeLink) {
            setActive(activeLink);
        } else {
            clearNav();
        }
    }

    window.addEventListener("scroll", onScroll, { passive: true });

    // =========================
    // 🖱️ CLICK NAVIGATION
    // =========================
    links.forEach((link) => {
        link.addEventListener("click", () => {
            isClickNavigation = true;

            setActive(link);

            setTimeout(() => {
                isClickNavigation = false;
            }, 900);
        });
    });

    // =========================
    // 🚀 INIT
    // =========================
    const currentPath = window.location.pathname;

    const pageLink = Array.from(links).find((link) => {
        const href = link.getAttribute("href");

        if (!href) return false;

        try {
            const url = new URL(href, window.location.origin);

            // Page réelle : /templates, /contact, etc.
            if (!url.hash && url.pathname === currentPath) {
                return true;
            }

            return false;
        } catch {
            return false;
        }
    });

    if (pageLink) {
        setActive(pageLink);
    } else {
        const initial = document.querySelector(".nav-active");

        if (initial) {
            movePill(initial);
            return;
        }

        const isHome = window.location.pathname === "/";
        const hasHash = window.location.hash;

        if (isHome && !hasHash) {
            clearNav();
        } else {
            onScroll();
        }
    }
}
