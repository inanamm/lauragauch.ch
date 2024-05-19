const baseOpacity = "0.90";

document.addEventListener('DOMContentLoaded', function () {
  const imageElements = document.querySelectorAll('main figure img');

  imageElements.forEach((imageElement) => {
    imageElement.style.opacity = baseOpacity
    imageElement.closest('figure').addEventListener('mouseleave', function () {
      imageElements.forEach(img => {
        img.style.opacity = baseOpacity;
      })
    });

    imageElement.closest('figure').addEventListener('mouseover', function () {
      imageElements.forEach(otherImageElements => {
        if (otherImageElements !== imageElement) {
          otherImageElements.style.opacity = baseOpacity;
        }
        imageElement.style.opacity = "1";
      })

      const data = JSON.parse(this.dataset.project);
      showActiveProjectShowMoreTitle(data.title)
      showActiveProjectInfoOnDrawer(data)
    });
    correctFigureSize(imageElement)
  });
});

function correctFigureSize(figureElement) {
  figureElement.onload = function () {
    const aspectRatio = figureElement.naturalWidth / figureElement.naturalHeight;
    const containerHeight = figureElement.closest('figure').clientHeight;
    figureElement.closest('figure').style.width = `${containerHeight * aspectRatio}px`;
  };
}

function showActiveProjectShowMoreTitle(title) {
  document.getElementById("project-more-info").innerText = title
}

// Set the correct information on the project drawer
function showActiveProjectInfoOnDrawer({title, description, backgroundColor, pressKits, url}) {
  // Set the project title
  document.getElementById("project-title").innerText = title
  // Set the background color
  document.getElementById("navigation").style.backgroundColor = backgroundColor
  // Set the share link
  document.getElementById("project-url").href = url

  // Clear and set the description
  const descriptionElement = document.getElementById("project-description")
  while (descriptionElement.firstChild) {
    descriptionElement.removeChild(descriptionElement.firstChild);
  }
  const parser = new DOMParser();
  const descriptionNodes = parser.parseFromString(description, "text/html");
  Array.from(descriptionNodes.body.childNodes).forEach(item => descriptionElement.appendChild(item.cloneNode(true))
  )

  // Clear and set the presskit links
  const presskitsElement = document.getElementById("project-presskits")
  while (presskitsElement.firstChild) {
    presskitsElement.removeChild(presskitsElement.firstChild);
  }
  pressKits.forEach(kit => {
    const anchorTag = document.createElement('a')
    anchorTag.href = kit.link
    anchorTag.innerText = kit.title
    if (!!kit.toggle) {
      anchorTag.target = "_blank"
    }
    presskitsElement.appendChild(anchorTag.cloneNode(true))
  })
}
