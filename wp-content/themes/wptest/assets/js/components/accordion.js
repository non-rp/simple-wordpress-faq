export default function accordionInit() {
    document.addEventListener("click", (e) => {
        const target = e.target;

        const header = target.closest("[data-accordion-header]");
        if(!header) return;

        const current = header.closest("[data-accordion-item]")
        if(!current) return;

        const wrapper = current.closest("[data-accordion]") || document;
        const isActive = current.classList.contains("active");

        wrapper
            .querySelectorAll("[data-accordion-item].active")
            .forEach((el) => el.classList.remove("active"));

        if (!isActive) {
            current.classList.add("active");
        }
    })
}
