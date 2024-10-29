const slider = document.getElementById("mySlider");
const sliderValue = document.getElementById("sliderValue");

// Update the displayed value as the slider moves
slider.addEventListener("input", () => {
    sliderValue.textContent = slider.value;
});
