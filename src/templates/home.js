import Alpine from "alpinejs";
import Htmx from 'htmx.org';
import {collapse} from "@alpinejs/collapse";

import projectDrawer from '../alpine/projectDrawer.js'
import darkMode from '../alpine/darkMode.js'
import copyToClipboard from "../alpine/copyToClipboard.js";
import activeProject from "../alpine/activeProject.js";

window.htmx = Htmx;
console.log('initialized htmx');

Alpine.plugin(collapse)
window.Alpine = Alpine;
Alpine.store('darkMode', darkMode);
Alpine.store('projectDrawer', projectDrawer);
Alpine.store('activeProject', activeProject);
Alpine.data("copyToClipboard", copyToClipboard);

Alpine.start();
console.log('initialized Alpine');

class ProjectImageHandler {
  init() {
    const imageElements = document.querySelectorAll('main figure img');
    imageElements.forEach((imageElement) => {
      this.correctFigureSize(imageElement);
    });
  }

  correctFigureSize(figureElement) {
    figureElement.onload = () => {
      const aspectRatio = figureElement.naturalWidth / figureElement.naturalHeight;
      const containerHeight = figureElement.closest('figure').clientHeight;
      figureElement.closest('figure').style.width = `${containerHeight * aspectRatio}px`;
    };
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const handler = new ProjectImageHandler();
  handler.init();
});
