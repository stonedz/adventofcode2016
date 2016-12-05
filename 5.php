<?php
$input = 'wtnhxymk';

$counter = 1;
$found = 0;
$found_2 = 0;
$code = array();
$code_2 = array();
while(!$found || !$found_2) {
    $md5 = md5($input.(string)$counter);
    if(substr($md5,0,5) === '00000'){
        $code[] = $md5[5];
        if(count($code) == 8) {
            $found = 1;
        }
        if(is_numeric($md5[5]) && (int)$md5[5] >= 0 && (int)$md5[5] < 8) {
            if(!isset($code_2[(int)$md5[5]])) {
                $code_2[(int)$md5[5]] = $md5[6];
                if(count($code_2) == 8) {
                    $found_2 = 1;
                }
            }
        }
    }
    $counter++;
}



echo implode($code);
echo "\n";
ksort($code_2);
echo implode($code_2);