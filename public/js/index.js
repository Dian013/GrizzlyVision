const button = document.getElementById("switch_mod_img_vid");
const icons = document.querySelectorAll("#switch_mod ul li i");
const modes = ["fa-image", "fa-film", "fa-photo-film"];
const placement = ["flex-start", "center", "flex-end"];
let currentMode = 2;

button.addEventListener("click", function () {
    icons[currentMode].classList.remove("switch__mod--choice");

    if (currentMode >= modes.length - 1) {
        currentMode = 0;
    } else {
        currentMode++;
    }

    icons[currentMode].classList.add("switch__mod--choice");
    button.style.justifyContent = placement[currentMode];
});
