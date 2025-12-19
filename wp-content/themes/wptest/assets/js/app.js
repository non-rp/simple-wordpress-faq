import accordionInit from "./components/accordion";
import faqAjax from "./ajax/faq"

document.addEventListener("DOMContentLoaded", () => {
    accordionInit();
    faqAjax();
})