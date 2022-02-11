<?php

$project = $argv[1];
$command = $argv[2];

/**
 * @param $current
 * @param $action
 * @param string|null $repository
 */
function runDependencies($project, $command, string $repository = null)
{
    return execute($project, $command, null, 0);
}


//function downloadToRepo($repository)
//{
//    exec('cd .. && git clone ' . $repository);
//}

function execute($project, $command, string $repository = null, $lvl = 0): string
{
    $dependencies = json_decode(file_get_contents($project . '/' . $project . '_dependencies.json'), true);
    $make = $lvl > 0 ? 'make -C ../' . $project . ' ' . $command : '';
    foreach ($dependencies as $dependency) {
        $tmp = execute($dependency['path'], $command, null, ++$lvl);
        $make = $tmp . ($make ? ' && ' : '') . $make;
    }

    return $make;
}

echo runDependencies($project, $command);