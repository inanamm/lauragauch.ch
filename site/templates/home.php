<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>

<body class="h-full grid grid-rows-10">
<header class="row-span-2">
  <nav class="flex gap-16 font-serif ">
    <h2 class="ml-3"><?php snippet('projectindex') ?></h2>
    <?php snippet('about') ?>
  </nav>

</header>

<main class="row-span-6">
  <ul class="flex overflow-x-scroll n gap-12 w-full items-center h-full">
    <?php $projectsPage = $site->find('projects');
    foreach ($projectsPage->children() as $project) {

      $hslColor = $project->backgroundColor()->escape();
      $alpha = 0.8; // 80% opacity
      $hslColor = trim($hslColor);
      $hslColor = substr($hslColor, 4, -1);
      $hslParts = explode(' ', $hslColor);
      $hue = trim($hslParts[0]);
      $saturation = trim($hslParts[1]);
      $lightness = trim($hslParts[2]);
      $hslaColor = "hsla($hue, $saturation, $lightness, $alpha)";
      $style = "background-color: $hslaColor";

      $kirbyPressKits = $project->pressKits()->toStructure();
      $pressKits = [];

      foreach ($kirbyPressKits as $pressKit): ?>
        <?php array_push($pressKits, (object)[
          "title" => $pressKit->title()->value(),
          "link" => $pressKit->link()->value(),
          "toggle" => $pressKit->toggle()->value(),
        ]) ?>
      <?php endforeach;

      $projectInfo = (object)[
        "title" => $project->title()->value(),
        "url" => $project->url(),
        "description" => $project->description()->value(),
        "backgroundColor" => $hslaColor,
        "pressKits" => $pressKits
      ];

      foreach ($project->cover()->toFiles() as $image): ?>
        <figure class="h-full flex-none" data-project='<?= json_encode($projectInfo) ?>'>
          <?= $image->thumb([
            'quality' => 90,
            'format' => 'webp',
          ])->html(); ?>
        </figure>
      <?php endforeach;
    }
    ?>
  </ul>

  <div class="">
    <?php snippet('project') ?>
  </div>

</main>

<script>
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
  function showActiveProjectInfoOnDrawer({title, description, backgroundColor, pressKits}) {
    // Set the project title
    document.getElementById("project-title").innerText = title
    // Set the background color
    document.getElementById("navigation").style.backgroundColor = backgroundColor

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
</script>

<?= vite()->js('index.js') ?>
</body>

</html>