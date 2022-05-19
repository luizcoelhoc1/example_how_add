<?php

    define("COUT", 0);
    define("RESULT", 1);

    function somador_1_bit($a, $b, $cin) {
        return [
            COUT => intval(($a and $b) || ($cin and ($a xor $b))),
            RESULT => intval($a xor $b xor $cin)
        ];
    }

    function somador_n_bits($n1, $n2, $n) {
        $result = [];
        $v1 = 0;
        $n--;
        while ($n > 0) {
            $a = substr($n1, $n, 1);
            $b = substr($n2, $n, 1);
            $x = somador_1_bit($a, $b, $v1);
            array_push($result, $x[RESULT]);
            $v1 = $x[COUT];
            $n--;
        }
        return bindec(implode("", array_reverse($result)));
    }

    function dec_to_bin ($n, $size=32) {
        return str_pad(decbin($n), $size, '0', STR_PAD_LEFT);
    }

    function add($n1, $n2, $size = 32) {
        $n1 = dec_to_bin($n1, $size);
        $n2 = dec_to_bin($n2, $size);
        return somador_n_bits($n1, $n2, $size);
    }
    
    echo add(79,7);
?>
