<?php
function getDirection($current_direction, $step_direction) {
  if($step_direction == 'R') {
    $current_direction += 1;
    if($current_direction == 4) {
      $current_direction = 0;
    }
  }
  else {
    $current_direction -= 1;
    if($current_direction == -1) {
      $current_direction = 3;
    }
  }
  return $current_direction;
}

function alreadyVisited($hash, $my_steps) {
  if(array_key_exists($hash, $my_steps)) {
    echo 'VISITED: ';
    print_r($my_steps[$hash]);
  }
}

function move($direction, $value, &$x, &$y, &$my_steps) {
  switch($direction) {
  case 0:
      for($tmp_y = $y+1; $tmp_y <= ($y + $value); $tmp_y++) {
        $hash = md5('x'.$x.'y'.$tmp_y);
        alreadyVisited($hash, $my_steps);
        $my_steps[$hash] = array('x'=> $x, 'y' => $tmp_y);
      }
      $y += $value;
      break;
    case 1:
      for($tmp_x = $x+1; $tmp_x <= $x + $value; $tmp_x++) {
        $hash = md5('x'.$tmp_x.'y'.$y);
        alreadyVisited($hash, $my_steps);
        $my_steps[$hash] = array('x'=> $tmp_x, 'y' => $y);
      }
      $x += $value;
      break;
    case 2:
      for($tmp_y = $y-1; $tmp_y >= $y - $value; $tmp_y--) {
        $hash = md5('x'.$x.'y'.$tmp_y);
        alreadyVisited($hash, $my_steps);
        $my_steps[$hash] = array('x'=> $x, 'y' => $tmp_y);
      }
      $y -= $value;
      break;
    case 3:
      for($tmp_x = $x-1; $tmp_x >= $x - $value; $tmp_x--) {
        $hash = md5('x'.$tmp_x.'y'.$y);
        alreadyVisited($hash, $my_steps);
        $my_steps[$hash] = array('x'=> $tmp_x, 'y' => $y);
      }
      $x -= $value;
      break;
  }
}


$input = 'R3, L5, R1, R2, L5, R2, R3, L2, L5, R5, L4, L3, R5, L1, R3, R4, R1, L3, R3, L2, L5, L2, R4, R5, R5, L4, L3, L3, R4, R4, R5, L5, L3, R2, R2, L3, L4, L5, R1, R3, L3, R2, L3, R5, L194, L2, L5, R2, R1, R1, L1, L5, L4, R4, R2, R2, L4, L1, R2, R53, R3, L5, R72, R2, L5, R3, L4, R187, L4, L5, L2, R1, R3, R5, L4, L4, R2, R5, L5, L4, L3, R5, L2, R1, R1, R4, L1, R2, L3, R5, L4, R2, L3, R1, L4, R4, L1, L2, R3, L1, L1, R4, R3, L4, R2, R5, L2, L3, L3, L1, R3, R5, R2, R3, R1, R2, L1, L4, L5, L2, R4, R5, L2, R4, R4, L3, R2, R1, L4, R3, L3, L4, L3, L1, R3, L2, R2, L4, L4, L5, R3, R5, R3, L2, R5, L2, L1, L5, L1, R2, R4, L5, R2, L4, L5, L4, L5, L2, L5, L4, R5, R3, R2, R2, L3, R3, L2, L5';
$input = explode(',',str_replace(' ', '',$input));
$x = 0;
$y = 0;
$current_direction = 0;
$directions= array('north','east','south','west');
$my_steps = array();

foreach($input as $step) {
  $current_direction = getDirection($current_direction, $step[0]);
  move($current_direction, substr($step, 1), $x, $y,$my_steps);
}
echo "\n";
echo abs($x)+abs($y);
