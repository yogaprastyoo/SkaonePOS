import { initFlowbite } from "flowbite";

import "./bootstrap";
import "flowbite";

document.addEventListener("livewire:navigating", () => {
    // Mutate the HTML before the page is navigated away...
    initFlowbite();
});

document.addEventListener("livewire:navigated", () => {
    // Reinitialize Flowbite components
    initFlowbite();
});

document.addEventListener("livewire:init", () => {
    initFlowbite();
});

document.addEventListener("livewire:initialized", () => {
    initFlowbite();
});
