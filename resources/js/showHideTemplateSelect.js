export default function initTemplateSelect() {
    const select = document.getElementById("typeProjet");
    const templateField = document.getElementById("templateField");

    if (!select || !templateField) return;

    function toggle() {
        if (select.value === "landing") {
            templateField.classList.remove("hidden");
        } else {
            templateField.classList.add("hidden");
        }
    }

    select.addEventListener("change", toggle);
    toggle();
}