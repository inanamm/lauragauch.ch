import Alpine from "alpinejs";
import Htmx from 'htmx.org';

import projectDrawer from './projectDrawer.js'
import darkMode from './darkMode.js'

window.htmx = Htmx;
console.log('initialized htmx');

window.Alpine = Alpine;
Alpine.store('darkMode', darkMode);
Alpine.store('projectDrawer', projectDrawer);
Alpine.start();

class ProjectImageHandler {
  constructor(baseOpacity = "0.90") {
    this.baseOpacity = baseOpacity;
  }

  init() {
    const imageElements = document.querySelectorAll('main figure img');
    imageElements.forEach((imageElement) => {
      imageElement.style.opacity = this.baseOpacity;
      imageElement.closest('figure').addEventListener('mouseleave', () => this.resetOpacity(imageElements));
      imageElement.closest('figure').addEventListener('mouseover', () => this.handleMouseOver(imageElement, imageElements));
      this.correctFigureSize(imageElement);
    });
  }

  resetOpacity(imageElements) {
    imageElements.forEach(img => {
      img.style.opacity = this.baseOpacity;
    });
  }

  handleMouseOver(imageElement, imageElements) {
    imageElements.forEach(otherImageElement => {
      if (otherImageElement !== imageElement) {
        otherImageElement.style.opacity = this.baseOpacity;
      }
      imageElement.style.opacity = "1";
    });

    const data = JSON.parse(imageElement.closest('figure').dataset.project);
    this.showActiveProjectShowMoreTitle(data.title);
    this.showActiveProjectInfoOnDrawer(data);
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

  showStructures(items, elementId) {
    const presskitsElement = document.getElementById(elementId);
    const presskitsTitleElement = document.getElementById(`${elementId}-title`);
    while (presskitsElement.firstChild) {
      presskitsElement.removeChild(presskitsElement.firstChild);
    }

    presskitsTitleElement.style.display = "block"
    if (!items.length) {
      presskitsTitleElement.style.display = "none";
    }
    items.forEach(kit => {
      const anchorTag = document.createElement('a');
      anchorTag.href = kit.link;
      anchorTag.innerText = kit.title;
      if (!!kit.toggle) {
        anchorTag.target = "_blank";
      }
      presskitsElement.appendChild(anchorTag.cloneNode(true));
    });
  }

  showActiveProjectInfoOnDrawer({title, description, backgroundColor, pressKits, url}) {
    document.getElementById("project-title").innerText = title;
    document.getElementById("navigation").style.backgroundColor = backgroundColor;
    document.getElementById("project-url").href = url;

    const descriptionElement = document.getElementById("project-description");
    while (descriptionElement.firstChild) {
      descriptionElement.removeChild(descriptionElement.firstChild);
    }
    const parser = new DOMParser();
    const descriptionNodes = parser.parseFromString(description, "text/html");
    Array.from(descriptionNodes.body.childNodes).forEach(item => descriptionElement.appendChild(item.cloneNode(true)));

    this.showStructures(pressKits, "project-presskits");
    this.showStructures(pressKits, "project-collaborations");
    this.showStructures(pressKits, "project-support");
    this.showStructures(pressKits, "project-viewings");

  }
}

document.addEventListener('DOMContentLoaded', () => {
  const handler = new ProjectImageHandler();
  handler.init();
});
