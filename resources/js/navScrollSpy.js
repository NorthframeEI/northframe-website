export default function initNavScrollSpy() {

    const links = document.querySelectorAll(".nav-item");
    const sections = document.querySelectorAll("section[id]");


    if (!links.length || !sections.length) {
        return;
    }

    const clearActive = () => {
        links.forEach((link) => {
            link.classList.remove("nav-active");
        });
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {

                if (!entry.isIntersecting) return;


                clearActive();

                const link = [...links].find((link) =>
                    link.getAttribute("href")?.endsWith(`#${entry.target.id}`),
                );


                if (link) {
                    link.classList.add("nav-active");

                } else {
                   
                }
            });
        },
        {
            threshold: 0.5,
        },
    );

    sections.forEach((section) => {
        observer.observe(section);
    });
}
