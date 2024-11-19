document.addEventListener("DOMContentLoaded", () => {
    // Find all counter components
    document.querySelectorAll("[data-counter]").forEach((counterElement) => {
        const display = counterElement.querySelector("[data-display]");
        const minusBtn = counterElement.querySelector("[data-minus]");
        const plusBtn = counterElement.querySelector("[data-plus]");

        minusBtn.addEventListener("click", () => {
            let currentValue = parseInt(display.value) || 0;
            if (currentValue > 0) {
                display.value = currentValue - 1;
            }
        });

        plusBtn.addEventListener("click", () => {
            let currentValue = parseInt(display.value) || 0;
            display.value = currentValue + 1;
        });
    });
});
