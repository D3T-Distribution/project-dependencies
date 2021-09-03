<?php

$current = $argv[1];
$action = $argv[2];

/**
 * @param $current
 * @param $action
 * @param string|null $repository
 */
function execute($current, $action, $repository = null)
{
    $make = 'cd ../' . $current . ' && make ' . $action . ' ';
    $git = '';
    $dependencies = json_decode(file_get_contents('../' . $current . '/' . $current . '_dependencies.json'));

    foreach ($dependencies as $dependency) {
        if (isset($dependency->path)) {
            $git = 'git clone '.$dependency->repository;
            execute($dependency->path, $action, $dependency->repository);
            if ("front-client" === $current && "start" === $action) {
                $make .= '&& make serve && cd ../';
            }
        }
    }

    if (is_dir('../'.$current)) {
        print_r('.............................'.$action.'ing '. $current.'.................................'.PHP_EOL);
        exec($make);
    } elseif ($repository) {
        exec($git);
    }
}

execute($current, $action);


