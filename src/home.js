import Alpine from "alpinejs";
import Htmx from 'htmx.org';

import projectDrawer from './alpine/projectDrawer.js'
import darkMode from './alpine/darkMode.js'
import copyToClipboard from "./alpine/copyToClipboard.js";

window.htmx = Htmx;
console.log('initialized htmx');

window.Alpine = Alpine;
Alpine.store('darkMode', darkMode);
Alpine.store('projectDrawer', projectDrawer);
Alpine.data("copyToClipboard", copyToClipboard);

Alpine.start();
console.log('initialized Alpine');

class ProjectImageHandler {
  init() {
    const imageElements = document.querySelectorAll('main figure img');
    imageElements.forEach((imageElement) => {
      imageElement.closest('figure').addEventListener('mouseover', () => this.handleMouseOver(imageElement, imageElements));
      this.correctFigureSize(imageElement);
    });
  }

  handleMouseOver(imageElement, imageElements) {
    const data = JSON.parse(imageElement.closest('figure').dataset.project);
    this.showActiveProjectShowMoreTitle(data);
  }

  correctFigureSize(figureElement) {
    figureElement.onload = () => {
      const aspectRatio = figureElement.naturalWidth / figureElement.naturalHeight;
      const containerHeight = figureElement.closest('figure').clientHeight;
      figureElement.closest('figure').style.width = `${containerHeight * aspectRatio}px`;
    };
  }

  showActiveProjectShowMoreTitle(title) {
    document.getElementById("project-more-info").innerText = title;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const handler = new ProjectImageHandler();
  handler.init();
});
