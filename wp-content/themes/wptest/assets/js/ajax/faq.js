export default function faqAjax(){
    const ajaxSections = document.querySelectorAll('.faq-ajax');

    if (!ajaxSections.length) return;

    const faqAjaxRequest = async (item) => {
        try {

            const formData = new FormData();
            formData.append('action', 'faq_load');
            formData.append('nonce', ajaxData.nonce);

            const response = await fetch(ajaxData.ajaxurl, {
                method: "POST",
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            item.innerHTML = await response.text();
        } catch(error) {
            console.error(error.message);
            item.innerHTML += "<span>Something went wrong!</span>";
        }
    }

    ajaxSections.forEach((item) => {
        const btn = item.querySelector("button.faq-ajax__btn")
        if(!btn) return;

        btn.addEventListener("click", () => {
            faqAjaxRequest(item);
        });
    })
}
