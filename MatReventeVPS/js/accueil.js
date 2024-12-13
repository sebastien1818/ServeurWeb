const priceSlider = document.getElementById('price');
const priceIndicator = document.querySelector('.price-range .price-indicator');

priceSlider.addEventListener('input', () => {
    const selectedPrice = priceSlider.value;
    priceIndicator.textContent = `${selectedPrice}$`;
});