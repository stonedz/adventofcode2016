<?php
$input = array_filter(explode("\n", file_get_contents('input4.txt')), 'trim');
$result = 0;

foreach ($input as $in) {
    $data = explode('[',$in);
    $checksum = substr($data[1],0,-1);
    $code_full = explode('-', $data[0]);
    $value = array_pop($code_full);
    $code = implode($code_full);
    if(is_valid_code($code, $checksum)) {
        $result += $value;
        $clear_text = decypher(implode('-',$code_full), $value);

        if(strpos($clear_text, 'north') !== false) {
           echo $clear_text.' - '.$value; 
            echo "\n";
        }

    }
}

echo $result;

function is_valid_code($code, $checksum) {
    $occurrences = count_chars($code, 1);

    foreach ($occurrences as $char => $number) {
        $new_occurrences[] = array('char' => $char, 'occurrences' => $number);
    }

    foreach ($new_occurrences as $key => $row) {
        $chars[$key] = $row['char'];
        $numbers[$key] = $row['occurrences'];
    }
    array_multisort($numbers, SORT_DESC, $chars, SORT_ASC, $new_occurrences);

    $five_digit_code = array_slice($new_occurrences,0,5);
    foreach ($five_digit_code as $digit) {
        $to_check[]  = chr($digit['char']);
    }

    if($checksum == implode($to_check)) {
        return true;
    }
    return false;
}

function decypher($code, $value) {
    $code = str_split($code);
    $result = array();
    foreach ($code as $char) {
        if($char == '-' ) {
            $result[] = ' ';
        }
        else {
            $ascii = ord($char)-97;
            $ascii += $value;
            $ascii = ($ascii%26) + 97;
            $result[] = chr($ascii);
        }
    }
    return implode($result);
}
