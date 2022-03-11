<?php

$project = $argv[1];
$command = $argv[2];
$latests = $argv[3] ?? null;

function runDependencies($project, $command, $latests = null): string
{
    $projectsPath = $_ENV['PROJECTS_PATH'] ?? '/mnt/projects/';
    $latests = $latests ? $project . ',' . $latests : $project;

    $dependencies = json_decode(file_get_contents($projectsPath . $project . '/dependencies.json'), true);
    foreach ($dependencies as $dependency) {
        if (!str_contains($latests, $dependency['path'])) {
            if (is_dir($projectsPath . $dependency['path'])) {
                return 'make -C ../' . $dependency['path'] . ' DEPENDENCIES=' . $latests . ' ' . $command;
            } else {
                return 'cd ../ && git clone ' . $dependency['repository'] . ' && cd ' . $dependency['path'] . ' && make install && make ' . $command;
            }
        }
    }

    return '';
}

echo runDependencies($project, $command, $latests);