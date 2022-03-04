<?php

$project = $argv[1];
$command = $argv[2];

function runDependencies(string $project, string $command): string
{
    return execute($project, $command);
}

function execute($project, $command): string
{
    $dependencies = json_decode(file_get_contents($project . '/' . $project . '_dependencies.json'), true);
    foreach ($dependencies as $dependency) {
        if (is_dir($dependency['path'])) {
            return 'make -C ../' . $dependency['path'] . ' ' . $command. ' ';
        } else {
            return 'cd ../ && git clone ' . $dependency['repository'] . ' && cd ' . $dependency['path'] . ' && make install && make ' . $command;
        }
    }

    return '';
}

echo runDependencies($project, $command);