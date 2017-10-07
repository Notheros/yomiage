<?php

class Filter {

    static function sanitize($str) {
        $striped_str = addslashes(strip_tags(trim($str)));
        return utf8_decode($striped_str);
    }
    
     static function sanitize_wo_st($str) {
        $striped_str = addslashes(trim($str));
        return utf8_decode($striped_str);
    }

    static function prettify($str) {
        $pretty_str = ucfirst(strtolower($str));
        return $pretty_str;
    }

    static function number_format($number, $mysql = false) {
        if ($mysql) {
            $number = str_replace(".", "", $number);
            $number = str_replace(",", ".", $number);
            return $number;
        } else {
            return number_format($number, 2, ',', '.');
        }
    }

}
