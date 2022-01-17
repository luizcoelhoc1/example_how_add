<?php

    define("COUT", 0);
    define("RESULT", 1);

    function somador_1_bit($a, $b, $cin) {
        if ($a == 0 and $b == 0 and $cin == 0 ) return [0, 0];
        if ($a == 0 and $b == 0 and $cin == 1 ) return [0, 1];
        if ($a == 0 and $b == 1 and $cin == 0 ) return [0, 1];
        if ($a == 0 and $b == 1 and $cin == 1 ) return [1, 0];
        if ($a == 1 and $b == 0 and $cin == 0 ) return [0, 1];
        if ($a == 1 and $b == 0 and $cin == 1 ) return [1, 0];
        if ($a == 1 and $b == 1 and $cin == 0 ) return [1, 0];
        if ($a == 1 and $b == 1 and $cin == 1 ) return [1, 1];
    }

    function somador_n_bits($n1, $n2, $n) {
        $result = "";
        $v1 = 0;
        $n--;
        while ($n > 0) {
            $a = substr($n1, $n, 1);
            $b = substr($n2, $n, 1);
            $x = somador_1_bit($a, $b, $v1);
            $result .= $x[RESULT];
            $v1 = $x[COUT];
            $n--;
        }
        return bindec(strrev($result));
    }

    function dec_to_bin ($n, $size=32) {
        return str_pad(decbin($n), $size, '0', STR_PAD_LEFT);
    }

    function add($n1, $n2, $size = 32) {
        $n1 = dec_to_bin($n1, $size);
        $n2 = dec_to_bin($n2, $size);
        return somador_n_bits($n1, $n2, $size);
    }

    echo add(5, 1);
?>
