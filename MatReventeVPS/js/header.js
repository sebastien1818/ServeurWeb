const menuToggle = document.getElementById("menuToggle");
const menuMobile = document.getElementById("menuMobile");

menuToggle.addEventListener("click", function() {
    // Toggle the menu's visibility
    menuMobile.classList.toggle("visible");
});