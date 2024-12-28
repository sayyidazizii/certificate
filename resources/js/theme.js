document.addEventListener("DOMContentLoaded", () => {
    const themeToggleButton = document.getElementById("theme-toggle");
    const root = document.documentElement;
    const sunIcon = document.getElementById("theme-icon-sun");
    const moonIcon = document.getElementById("theme-icon-moon");

    // Load theme from localStorage or set default to 'light'
    const currentTheme = localStorage.getItem("theme") || "light";

    if (currentTheme === "dark") {
        root.classList.add("dark");
        sunIcon.classList.add("hidden");
        moonIcon.classList.remove("hidden");
    } else {
        root.classList.remove("dark");
        sunIcon.classList.remove("hidden");
        moonIcon.classList.add("hidden");
    }

    // Toggle theme and update icons
    themeToggleButton.addEventListener("click", () => {
        if (root.classList.contains("dark")) {
            root.classList.remove("dark");
            localStorage.setItem("theme", "light");
            sunIcon.classList.remove("hidden");
            moonIcon.classList.add("hidden");
        } else {
            root.classList.add("dark");
            localStorage.setItem("theme", "dark");
            sunIcon.classList.add("hidden");
            moonIcon.classList.remove("hidden");
        }
    });
});
