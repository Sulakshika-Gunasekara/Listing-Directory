// public/assets/js/app.js

// Import Alpine.js
import Alpine from "alpinejs";

// Assign to global window object
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

// Optional: Example component for testing
document.addEventListener("alpine:init", () => {
  Alpine.data("dropdown", () => ({
    open: false,
    toggle() {
      this.open = !this.open;
    },
  }));
});
