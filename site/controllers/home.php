<?php

return function ($site) {
    $projectsPage = $site->find('projects');
    $kirbyProjects = $projectsPage->children()->listed();

    $formattedProjects = [];

    foreach ($kirbyProjects as $project) {
        $images = $project->gallery()->toFiles();
        $vimeos = $project->vimeo();

        foreach ($images as $image) {

            $projectInfo = (object)[
                "id" => $project->id(),
                "image" => $image,
                "title" => $project->title()->value(),
                "url" => $project->url(),
                "description" => $project->description()->value(),
                "backgroundColor" => slothieHelpers()->HSLtoHSLA($project->backgroundColor()->value(), 0.8),
            ];

            $formattedProjects[] = $projectInfo;
        }

        // foreach ($vimeos as $vimeo) {
        //     $projectInfo = (object)[
        //         "id" => $project->id(),
        //         "video" => $vimeo,
        //         "title" => $project->title()->value(),
        //         "url" => $project->url(),
        //         "description" => $project->description()->value(),
        //         "backgroundColor" => slothieHelpers()->HSLtoHSLA($project->backgroundColor()->value(), 0.8),
        //     ];
        // }
        
    }

    shuffle($formattedProjects);

    return [
        'projects' => $formattedProjects,
    ];
};