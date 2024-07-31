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

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('img').forEach(function(img) {
    img.addEventListener('contextmenu', function(event) {
      event.preventDefault();
    });
  });
});
