import Alpine from "alpinejs";
import drawer from './drawer.js'

window.Alpine = Alpine;
Alpine.data('drawer', drawer);

Alpine.store('darkMode', {
  init() {
    const systemPrefersDarkMode = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
    this.on = systemPrefersDarkMode

    if (systemPrefersDarkMode) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  },

  on: false,

  toggle() {
    this.on = !this.on
    if (this.on) {
      localStorage.theme = 'dark'
      document.documentElement.classList.add('dark')
    } else {
      localStorage.theme = 'light'
      document.documentElement.classList.remove('dark')
    }
  }
})


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

    const presskitsElement = document.getElementById("project-presskits");
    while (presskitsElement.firstChild) {
      presskitsElement.removeChild(presskitsElement.firstChild);
    }
    pressKits.forEach(kit => {
      const anchorTag = document.createElement('a');
      anchorTag.href = kit.link;
      anchorTag.innerText = kit.title;
      if (!!kit.toggle) {
        anchorTag.target = "_blank";
      }
      presskitsElement.appendChild(anchorTag.cloneNode(true));
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const handler = new ProjectImageHandler();
  handler.init();
});
