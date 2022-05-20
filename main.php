<?php
    define("COUT", 0);
    define("RESULT", 1);
    
    function add($n1, $n2, $size = 32) {
        return adder_n_bits($n1, $n2, $size);
    }

    function adder_n_bits($n1, $n2, $n) {
        $result = 0;
        $v1 = 0;
        $count = $n-1;
        while ($count > 0) {
            $a = get_sub_intbinary($n1, $n, $count, 1);
            $b = get_sub_intbinary($n2, $n, $count, 1);
            $x = adder_1_bit($a, $b, $v1);
            append_intbinary($result,  $x[RESULT]);
            $v1 = $x[COUT];
            $count--;
        }
        $result <<= 1; //removing first 0
        return invert_intbinary($result, $n);
    }

    function adder_1_bit($a, $b, $cin) {
        return [
            COUT => intval(($a and $b) || ($cin and ($a xor $b))),
            RESULT => intval($a xor $b xor $cin)
        ];
    }
    
    function get_sub_intbinary($n, $n_bits, $index, $size_sub_int = 1) {
        $result = 0;
        shift_one($result, $size_sub_int);
        $doesnt_metter = $n_bits - ($n_bits - $index);
        $end_zeros = $n_bits - $size_sub_int - $doesnt_metter;
        $result <<= $end_zeros;
        $result = $n & $result;
        $result >>= $end_zeros;
        return $result;
    }
    
    function append_intbinary(&$item, $subject, $n_bits = 1) {
        $item = $item << $n_bits;
        $item = $item | $subject;
    }
    
    function shift_one(&$n, $qntty) {
        while ($qntty > 0) {
            $n <<= 1;
            $n = $n | 1;
            $qntty--;
        }
    }

    function invert_intbinary($n, $n_bits) {
        $result = 0;
        $count = $n_bits;
        while ($count > 0) {
            $i = $count-1;
            $x = get_sub_intbinary($n, $n_bits, $i, 1);
            append_intbinary($result, intval($x));
            $count--;
        }
        return $result;
    }

    echo add(67, 50);
?>
