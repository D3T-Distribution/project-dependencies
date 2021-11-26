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
    if (null === $repository) {
        $globals = json_decode(file_get_contents('dependencies/global_dependencies.json'));
        if (!is_dir('../' . $current)) {
            downloadToRepo($globals->$current->repository);
        }
    }

    $make = 'cd ../' . $current . ' && make ' . $action . ' ';
    $git = 'git clone ';
    $projetDependency = '../' . $current . '/' . $current . '_dependencies.json';
    if (file_exists($projetDependency)) {
        $dependencies = json_decode(file_get_contents($projetDependency));
        if (is_iterable($dependencies)) {
            foreach ($dependencies as $dependency) {
                execute($dependency->path, $action, $dependency->repository);
            }
        }
    }
    exec($make);
}


function downloadToRepo($repository)
{
    exec('git clone '. $repository);
}

execute($current, $action);