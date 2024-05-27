<?php

return [
    'locale' => [
        'en_CH.utf-8'
    ],

    'smartypants' => [
        'attr' => 1,
        'doublequote.open' => '&#171;&#x2006;', // «
        'doublequote.close' => '&#x2006;&#187;', // »
        'space.marks' => '&#160;',
        'emdash' => '&#8212;', // —
        'endash' => '&#8211;', // –
        'ellipsis' => '&#8230;', // …
        'space' => '(?: | |&nbsp;|&#0*160;|&#x0*[aA]0;)',
        'skip' => 'pre|code|kbd|script|style|math',
        'apostrophe' => '&rsquo;', // or 'apostrophe' => '&#8217;'
    ],
    'panel' => [
        'install' => true
    ],
    'date' => [
        'handler' => 'strftime'
    ],

    'routes' => [
        [
            'pattern' => 'htmx/projects/(:any)',
            'action' => function ($pageId,) {
                $projectPage = page('projects')->find($pageId);
                return snippet('projectInfo', [
                    'page' => $projectPage,
                    "backgroundColor" => slothieHelpers()->HSLtoHSLA($projectPage->backgroundColor()->value(), 0.8),
                ], true);
            }
        ],
    ]
];
