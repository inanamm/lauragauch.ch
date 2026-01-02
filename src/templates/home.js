import Alpine from "alpinejs";
import Htmx from 'htmx.org';

import projectDrawer from '../alpine/projectDrawer.js'
import darkMode from '../alpine/darkMode.js'
import copyToClipboard from "../alpine/copyToClipboard.js";
import activeProject from "../alpine/activeProject.js";

window.htmx = Htmx;
console.log('initialized htmx');

window.Alpine = Alpine;
Alpine.store('darkMode', darkMode);
Alpine.store('projectDrawer', projectDrawer);
Alpine.store('activeProject', activeProject);
Alpine.data("copyToClipboard", copyToClipboard);

Alpine.start();
console.log('initialized Alpine');

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('img').forEach(function (img) {
    img.addEventListener('contextmenu', function (event) {
      event.preventDefault();
    });
  });

  // Enable horizontal scrolling with mouse wheel
  const homeGallery = document.querySelector('.homeGallery');
  if (homeGallery) {
    homeGallery.addEventListener('wheel', function (event) {
      // Only intercept if scrolling vertically
      if (event.deltaY !== 0) {
        event.preventDefault();
        // Convert vertical scroll to horizontal with 5x speed multiplier
        homeGallery.scrollLeft += event.deltaY * 5;
      }
    }, {passive: false});
  }
});
