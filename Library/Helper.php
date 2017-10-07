<?php

class Helper {


    static function captureData($classes = array(), $globals = array()) {
        foreach ($classes as $class) {
            try {
                $values = call_user_func_array('array_merge', $globals);
                foreach ($values as $key => $value) {
                    $set = 'set' . self::normalize($key, TRUE);
                    if (method_exists($class, $set)) {
                        $class->$set($value);
                    }
                }
            } catch (Exception $exc) {
                die("Ocorreu um erro. Entre em contato com o administrador. COD: C-001");
            }
        }
    }

    static function get_data_from($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    static function By2M($bytes) {
        $megabytes = ($bytes / 1024) / 1024;
        return round($megabytes, 2);
    }

    static function generateHash() {
        $hash = md5(uniqid(rand(), true)) . md5(uniqid(microtime(), true));
        return $hash;
    }

    static function normalize($str, $lcfirst = false) {
        $words = explode('_', strtolower($str));
        $canon = '';
        foreach ($words as $word) {
            $canon .= ucfirst(trim($word));
        }
        if (!$lcfirst) {
            return lcfirst($canon);
        } else {
            return ucfirst($canon);
        }
    }

    static function resultToArray($result) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    static function redirect($url) {
        echo "<meta http-equiv='refresh' content='0;URL=$url'/>";
        exit;
    }

    static function showMessageAndRedirect($url, $msg, $delay) {
        echo "<meta http-equiv='refresh' content='$delay;url=$url'/>";
        die("<h4 class='m-t-25 text-center'>$msg</h4>");
    }

    static function prettyPrint($array, $die = true) {
        echo "<pre>";
        print_r($array);
        if ($die) {
            die();
        } else {
            echo "</pre>";
        }
    }

    static function truncateString($string, $size = 15) {
        if (strlen($string) > $size) {
            $string = substr($string, 0, $size) . "...";
        }
        return $string;
    }

    public static function get_date_diff_days($start /* USE MYSQL FORMAT */, $end /* USE MYSQL FORMAT */) {
        $start_time = strtotime($start);
        $end_time = strtotime($end);
        return (($end_time - $start_time) / 86400);
    }

    static function gerarSenha() {
        return substr(md5(microtime()), rand(0, 26), 6);
    }

    static function format_date($date, $format = "%d de %B") {
        return strftime($format, strtotime($date));
    }

    static function get_first_index_explode($string, $delimiter) {
        $explode = explode($delimiter, $string);
        return reset($explode);
    }

    static function flatten_array(array $array) {
        $flattened_array = array();
        array_walk_recursive($array, function($a) use (&$flattened_array) {
            $flattened_array[] = $a;
        });
        return $flattened_array;
    }

    static function has_permission($id_rota) {
        $oRota = new Rota();
        $permission = $oRota->hasPermission($id_rota);
        return $permission;
    }

    static function str_lreplace($search, $replace, $subject) {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }

    static function get_all_words_from_result($jisho_result) {
        $all_words = array();
        foreach ($jisho_result["data"] as $data) {
            foreach ($data["japanese"] as $words) {
                $word = array("word" => $words['word'], "type" => $data['senses'][0]['parts_of_speech'][0]);
                array_push($all_words, $word);
            }
        }
        return $all_words;
    }

    static function sort_array_by_values_length(&$inflections) {
        $inflections = array_flip($inflections);
        $keys = array_map('strlen', array_keys($inflections));
        array_multisort($keys, SORT_DESC, $inflections);
        $inflections = array_flip($inflections);
    }

}
