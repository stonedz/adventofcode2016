<?php
$keyboard = array(
    '0' => array ('0'=>7, '1'=>4, '2'=>1),
    '1' => array ('0'=>8, '1'=>5, '2'=>2),
    '2' => array ('0'=>9, '1'=>6, '2'=>3),
);

$fancy_keyboard = array(
    '0' => array('2'=>5),
    '1' => array('1'=>'A','2'=>6,'3'=>2),
    '2' => array('0'=>'D', '1'=>'B','2'=>7,'3'=>3,'4'=>1),
    '3' => array('1'=>'C','2'=>8,'3'=>4),
    '4' => array('2'=>9),
);

$input = array_filter(explode("\n", file_get_contents('input2.txt')), 'trim');
$start = array(1,1);
$start_fancy = array(0,2);

foreach($input as $i) {
    $in = str_split($i);
    foreach($in as $step) {
        $start = move_on_keyboard($keyboard,$start, $step);
        $start_fancy = move_on_keyboard($fancy_keyboard,$start_fancy, $step);
    }
    $keyboard_result[] =$keyboard[$start[0]][$start[1]];
    $fancy_keyboard_result[] = $fancy_keyboard[$start_fancy[0]][$start_fancy[1]];
}

echo implode($keyboard_result);
echo "\n";
echo implode($fancy_keyboard_result);


function is_valid_on_keyboard($keyboard, $position){
    if(isset($keyboard[$position[0]][$position[1]])){
        return true;
    }
    return false;
}

function move_on_keyboard($keyboard, $start, $move_to) {
    switch($move_to) {
        case 'U':
            $new_position = array($start[0], $start[1]+1);
            break;
        case 'R':
            $new_position = array($start[0]+1, $start[1]);
            break;
        case 'D':
            $new_position = array($start[0], $start[1]-1);
            break;
        case 'L':
            $new_position = array($start[0]-1, $start[1]);
            break;
    }
    
    if(is_valid_on_keyboard($keyboard, $new_position)) {
        return $new_position;
    }
    else {
        return $start;
    }
}

