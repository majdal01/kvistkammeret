function updateDonationAmount() {
    const donationElement = document.getElementById('donation-amount');
    if (!donationElement) return;

    // Find nærmeste .product container (typisk kun én på produktsiden)
    const productContainer = document.querySelector('.product');
    if (!productContainer) return;

    // Prøv først at finde synlig variantpris
    let priceElement = productContainer.querySelector('.woocommerce-variation-price .woocommerce-Price-amount');
    if (!priceElement || priceElement.offsetParent === null) {
        // Hvis ikke, brug første synlige almindelige pris inden for produktet
        const priceElements = productContainer.querySelectorAll('.woocommerce-Price-amount');
        for (let el of priceElements) {
            if (el.offsetParent !== null) {
                priceElement = el;
                break;
            }
        }
    }

    if (priceElement) {
        const rawPrice = priceElement.textContent.replace(/[^\d,.-]/g, '').replace(',', '.');
        const price = parseFloat(rawPrice);
        if (!isNaN(price)) {
            const donation = (price * 0.05).toFixed(2);
            donationElement.innerText = `Du donerer 5 % til Klimatræ: ${donation} kr.`;
            return;
        }
    }

    donationElement.innerText = 'Donation beregnes, når en pris er valgt.';
}

document.addEventListener('DOMContentLoaded', function () {
    updateDonationAmount();

    // Lyt på WooCommerce events for variant-skift
    const form = document.querySelector('form.variations_form');
    if (form) {
        form.addEventListener('show_variation', updateDonationAmount);
        form.addEventListener('hide_variation', updateDonationAmount);
    }

    // Lyt også på ændringer i select (ekstra sikkerhed)
    const selects = document.querySelectorAll('.variations select');
    selects.forEach(select => {
        select.addEventListener('change', () => setTimeout(updateDonationAmount, 150));
    });
});
