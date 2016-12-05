<?php
$input = array_filter(explode("\n", file_get_contents('input3.txt')), 'trim');
$valid = 0;
$valid_column = 0;

$counter =0;
foreach($input as $in) {
    $sides = preg_split('/\s+/', trim($in));
    if(is_valid_triangle($sides)) {
        $valid++;
    }

    $column_trinagles[0][$counter%3] = $sides[0];
    $column_trinagles[1][$counter%3] = $sides[1];
    $column_trinagles[2][$counter%3] = $sides[2];
    if(($counter+1)%3 == 0){
        foreach ($column_trinagles as $triangle) {
            if(is_valid_triangle($triangle)) {
                $valid_column++;
            }
        }
        $column_trinagles = array();
    }

    $counter++;
}

echo $valid;
echo "\n";
echo $valid_column;

function is_valid_triangle($sides) {
    if($sides[0] + $sides[1] <= $sides[2]
    || $sides[0] + $sides[2] <= $sides[1]
    || $sides[1] + $sides[2] <= $sides[0]) {
        return false;
    }
    return true;
}
