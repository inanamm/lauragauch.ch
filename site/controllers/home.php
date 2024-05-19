<?php

return function ($site) {
    $projectsPage = $site->find('projects');
    $kirbyProjects = $projectsPage->children();

    $formattedProjects = [];

    foreach ($kirbyProjects as $project) {
        $images = $project->gallery()->toFiles();

        foreach ($images as $image) {

            $pressKits = [];
            foreach ($project->pressKits()->toStructure() as $pressKit) {
                $pressKits[] = (object)[
                    "title" => $pressKit->title()->value(),
                    "link" => $pressKit->link()->value(),
                    "toggle" => $pressKit->toggle()->value(),
                ];
            }

            $projectInfo = (object)[
                "image" => $image,
                "title" => $project->title()->value(),
                "url" => $project->url(),
                "description" => $project->description()->value(),
                "backgroundColor" => slothieHelpers()->HSLtoHSLA($project->backgroundColor()->value(), 0.8),
                "pressKits" => $pressKits
            ];

            $formattedProjects[] = $projectInfo;
        }
    }

    shuffle($formattedProjects);

    return [
        'projects' => $formattedProjects,
    ];
};