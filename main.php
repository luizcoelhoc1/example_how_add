<?php

    define("COUT", 0);
    define("RESULT", 1);

    function somador_1_bit($a, $b, $cin) {
        return [
            COUT => intval(($a and $b) || ($cin and ($a xor $b))),
            RESULT => intval($a xor $b xor $cin)
        ];
    }

    function int_append(&$item, $subject, $n_bits = 1) {
        $item = $item << $n_bits;
        $item = $item | $subject;
    }

    function invert_binary($n, $n_bits) {
        $result = 0;
        $n = dec_to_bin($n, $n_bits);
        $count = $n_bits;
        while ($count > 0) {
            $i = $count-1;
            $x = substr($n, $i, 1);
            int_append($result, intval($x));
            $count--;
        }
        return $result;
    }

    function somador_n_bits($n1, $n2, $n) {
        $result = 0;
        $v1 = 0;
        $count = $n-1;
        while ($count > 0) {
            $a = substr($n1, $count, 1);
            $b = substr($n2, $count, 1);
            $x = somador_1_bit($a, $b, $v1);
            int_append($result,  $x[RESULT]);
            $v1 = $x[COUT];
            $count--;
        }
        $result <<= 1; //removing first 0
        return invert_binary($result, $n);
    }

    function dec_to_bin ($n, $size=32) {
        return str_pad(decbin($n), $size, '0', STR_PAD_LEFT);
    }

    function add($n1, $n2, $size = 32) {
        $n1 = dec_to_bin($n1, $size);
        $n2 = dec_to_bin($n2, $size);
        return somador_n_bits($n1, $n2, $size);
    }

    echo add(5, 7);
?>
