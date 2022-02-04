<?php

$project = $argv[1];
$command = $argv[2];

/**
 * @param $current
 * @param $action
 * @param string|null $repository
 */
function execute($project, $command, string $repository = null)
{
   return rapido($project, $command, null, 0);
}


function downloadToRepo($repository)
{
    exec('cd .. && git clone ' . $repository);
}

function rapido($project, $command, string $repository = null, $lvl = 0)
{

    $dependencies = json_decode(file_get_contents($project.'/'.$project.'_dependencies.json'), true);

    $make = $lvl > 0 ? 'make -C ../'.$project.' '.$command : '';
    foreach ($dependencies as $dependency) {
        $tmp2 =  rapido($dependency['path'], $command,null, ++$lvl);
        $tmp1 = $tmp2. ($make ? ' && ': '') .$make;
        $make = $tmp1;
    }

    return $make;
}
echo execute($project, $command);