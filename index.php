<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 17.12.2017
 * Time: 10:56
 */

$input = explode(',', file_get_contents('input.txt'));
$out = array_count_values($input);
// we can avoid using compare function, but last for loop should be run multiple times.
compare('n', 's', $out);
compare('nw', 'se', $out);
compare('ne', 'sw', $out);

function compare($a, $b, &$out)
{
    if ($out[$a] > $out[$b]) {
        $out[$a] = $out[$a] - $out[$b];
        $out[$b] = 0;
    } else {
        $out[$b] = $out[$b] - $out[$a];
        $out[$a] = 0;
    }
}

$dir = ['n', 'ne', 'se', 's', 'sw', 'nw'];
$size = count($dir);
for ($i = 0; $i < $size; $i++) {
    $less = &$out[$dir[($size - 1 + $i) % $size]];
    $mid = &$out[$dir[$i%$size]];
    $more = &$out[$dir[($i + 1) % $size]];
    if($less > $more){
        $mid = $mid + $more;
        $less = $less - $more;
        $more = 0;
    } else {
        $mid = $mid + $less;
        $more = $more - $less;
        $less = 0;
    }
}
var_dump($out);
// print the result
foreach ($dir AS $d){
    echo str_repeat($d . ',', $out[$d]);
}

