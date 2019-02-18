<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ARRAYS
 *
 * @author Notheros
 */
class ARRAYS {

    static function find_array_in_array($needle, $haystack) {
        $keys = array_keys($haystack, $needle[0]);
        $out = array();
        // FUNCTIONS::prettyPrint($haystack);
        foreach ($keys as $key) {
            $add = true;
            $result = array();
            foreach ($needle as $i => $value) {
                if (!(isset($haystack[$key + $i]) && $haystack[$key + $i] == $value)) {
                    // echo $key + $i . ' - false';
                    $add = false;
                    break;
                }
                $result[] = $key + $i;
            }
            if ($add == true) {
                $out[] = $result;
            }
        }
        // print_r($out);

        return $out;
    }

    static function contains_array_in_arrays($needle, $description) {

        $keys = array_keys($description, $needle[0]);
        $keys = array();
        foreach ($description as $key => $value) {
            $desc_array = explode(",", $value);
            foreach ($desc_array as $desc) {
                if (mb_strpos($desc, "・")) {
                    $desc = explode("・", $desc);
                    foreach ($desc as $desc2) {
                        if ($desc2 === $needle[0]) {
                            array_push($keys, $key);
                        }
                    }
                } else {
                    if ($desc === $needle[0]) {
                        array_push($keys, $key);
                    }
                }
            }
        }

        $out = array();
        foreach ($keys as $key) {
            $add = true;
            $result = array();
            foreach ($needle as $i => $value) { // array de continuation
//                if (isset($description[$key + $i])) {
//                    $desc_array = explode(",", $description[$key + $i]);
//                    foreach ($desc_array as $desc) {
//                        if (mb_strpos($desc, "・")) {
//                            $desc_dots = explode("・", $desc);
//                            foreach ($desc_dots as $desc2) {
//                                if ($desc2 != $value) {
//                                    $add = false;
//                                    break 3;
//                                }
//                            }
//                        } else {
//                            if ($desc != $value) {
//                                $add = false;
//                                break 2;
//                            }
//                        }
//                    }
//                } else {
//                    $add = false;
//                    break;
//                }



                if (!(isset($description[$key + $i]) && (mb_strpos($description[$key + $i], $value."・") !== false || mb_strpos($description[$key + $i], $value. ",") !== false))) {
                    $add = false;
                    break;
                }
                $result[] = $key + $i;
            }
            if ($add == true) {
                $out[] = $result;
            }
        }
        return $out;
    }

    static function deal_with_mecab_output($output) {
        $words = array();
        $descriptions = array();
        foreach ($output as $value) {
            $xplode = explode("	", $value);
            array_push($words, $xplode[0]);
            if (isset($xplode[1])) {
                array_push($descriptions, $xplode[1]);
            } else {
                array_push($descriptions, "");
            }
        }
        return array('words' => $words, 'descriptions' => $descriptions);
    }

}
