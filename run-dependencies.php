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

    var_dump($current, $action);
    var_dump('----- + -----');
    $make = 'cd ../' . $current . ' && make ' . $action . ' ';
    $git = 'git clone ';
    $dependencies = $globals->$current->dependencies;
    foreach ($dependencies as $dependency) {
        execute($dependency, $action, $globals->$dependency->repository);
    }
    exec($make);
}


function downloadToRepo($repository)
{
    exec('cd .. && git clone ' . $repository);
}

execute($current, $action);