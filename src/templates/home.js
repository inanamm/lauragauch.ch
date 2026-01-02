import Alpine from "alpinejs";
import Htmx from "htmx.org";

import projectDrawer from "../alpine/projectDrawer.js";
import darkMode from "../alpine/darkMode.js";
import copyToClipboard from "../alpine/copyToClipboard.js";
import activeProject from "../alpine/activeProject.js";

window.htmx = Htmx;
console.log("initialized htmx");

window.Alpine = Alpine;
Alpine.store("darkMode", darkMode);
Alpine.store("projectDrawer", projectDrawer);
Alpine.store("activeProject", activeProject);
Alpine.data("copyToClipboard", copyToClipboard);

Alpine.start();
console.log("initialized Alpine");

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("img").forEach(function (img) {
    img.addEventListener("contextmenu", function (event) {
      event.preventDefault();
    });
  });

  // Enable horizontal scrolling with mouse wheel
  const homeGallery = document.querySelector(".homeGallery");
  if (homeGallery) {
    const handleWheelScroll = function (event) {
      // Only convert vertical to horizontal if:
      // 1. There's vertical scroll (deltaY) but no horizontal (deltaX)
      // 2. The gallery has horizontal scrollable content
      const hasHorizontalScroll = homeGallery.scrollWidth > homeGallery.clientWidth;

      if (event.deltaY !== 0 && event.deltaX === 0 && hasHorizontalScroll) {
        event.preventDefault();
        // Convert vertical scroll to horizontal with 5x speed multiplier
        homeGallery.scrollLeft += event.deltaY * 5;
      }
    };

    // Add listener to the gallery
    homeGallery.addEventListener("wheel", handleWheelScroll, { passive: false });

    // Add wheel listeners to video containers for scrolling over iframes
    const videoContainers = homeGallery.querySelectorAll(".video-container");
    videoContainers.forEach(function (container) {
      container.addEventListener("wheel", handleWheelScroll, { passive: false });
    });
  }
});
