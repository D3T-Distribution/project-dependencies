<?php

$project = $argv[1];
$command = $argv[2];
$latests = $argv[3] ?? null;

function runDependencies($project, $command, $latests = null): string
{
    $projectsPath = $_ENV['PROJECTS_PATH'] ?? '/mnt/projects/';
    $latests = $latests ? $project . ',' . $latests : $project;

    $file = $projectsPath . $project . '/.dependencies';
    if (file_exists($file . '.local')) {
        $file .= '.local';
    } else if (!file_exists($file)){
        return '';
    }

    $dependencies = json_decode(file_get_contents($file), true);
    foreach ($dependencies as $name => $dependency) {
        if (!str_contains($latests, $name)) {
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