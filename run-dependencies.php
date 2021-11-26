<?php

$current = $argv[1];
$action = $argv[2];

/**
 * @param $current
 * @param $action
 * @param string|null $repository
 */
function execute($current, $action, string $repository = null)
{
    $globals = json_decode(file_get_contents('dependencies/global_dependencies.json'));

    if (null === $repository) {
        if (!is_dir('../' . $current)) {
            downloadToRepo($globals->$current->repository);
        }
    }

    $make = 'cd ../' . $current . ' && make ' . $action . ' ';
    $git = 'git clone ';
    $dependencies = json_decode(file_get_contents($globals->$current->dependencies));
    foreach ($dependencies as $dependency) {
        execute($globals->$dependency, $action, $globals->$dependency->repository);
    }
    exec($make);
}


function downloadToRepo($repository)
{
    exec('git clone ' . $repository);
}

execute($current, $action);