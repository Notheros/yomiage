<?php

class FUNCTIONS {

    static function prettyPrint($array, $die = true) {
        echo "<pre>";
        print_r($array);
        if ($die) {
            die();
        } else {
            echo "</pre>";
        }
    }

    static function flatten_array(array $array) {
        $flattened_array = array();
        array_walk_recursive($array, function($a) use (&$flattened_array) {
            $flattened_array[] = $a;
        });
        return $flattened_array;
    }

    static function sort_array_by_values_length(&$array) {
        $array = array_flip($array);
        $keys = array_map('strlen', array_keys($array));
        array_multisort($keys, SORT_DESC, $array);
        $array = array_flip($array);
    }

}
