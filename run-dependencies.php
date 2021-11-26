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

    if (!is_dir('../' . $current)) {
        downloadToRepo($globals->$current->repository);
    }

    $make = 'cd ../' . $current . ' && make ' . $action . ' ';
    $dependencies = $globals->$current->dependencies;
    foreach ($dependencies as $dependency) {
        execute($dependency, $action, $globals->$dependency->repository);
    }
    echo $make . PHP_EOL;
    exec($make);
}


function downloadToRepo($repository)
{
    exec('cd .. && git clone ' . $repository);
}

execute($current, $action);