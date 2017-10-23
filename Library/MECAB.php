<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MECAB
 *
 * @author willi
 */
class MECAB {

    static function mecab_it($input) {

        $path = '"C:\Program Files (x86)\MeCab\bin\mecab.exe"';
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w")
        );
        $process = proc_open($path, $descriptorspec, $pipes);
        if (is_resource($process)) {
            fwrite($pipes[0], $input);
            fclose($pipes[0]);
            while (!feof($pipes[1])) {
                $output[] = fgets($pipes[1]);
            }
            fclose($pipes[1]);
            proc_close($process);
        }
        return self::fix_words($output);
    }

    static function fix_words($output) {
//        Helper::prettyPrint($output, false);
        $result_previous = array();
        $previous_is_suffix = false;
        $previous_is_desu = false;
        $words = array();
        foreach ($output as $dict) {

            $word = explode("	", $dict);
            if (isset($word[1])) {
                $result = explode(",", $word[1]);
                if (!$previous_is_suffix) {
                    if (in_array("接頭詞", $result)) {
                        $previous_is_suffix = true;
                    }

                    if (mb_strpos($word[1], "特殊・") || in_array("接続助詞", $result) || in_array("接尾", $result)) {
                        if ((in_array("助詞", $result)) && self::is_particle($word[0], $result_previous)) {
                            array_push($words, $word[0]);
                        } else {
                            if (self::is_desu($word[0])) {
                                $previous_is_desu = true;
                                array_push($words, $word[0]);
                            } else {
                                $words[count($words) - 1] = $words[count($words) - 1] . $word[0];
                            }
                        }
                    } else {
                        if ($previous_is_desu && $word[0] == "う") {
                            $words[count($words) - 1] = $words[count($words) - 1] . $word[0];
                        } else {
                            array_push($words, $word[0]);
                        }
                    }
                } else {
                    $words[count($words) - 1] = $words[count($words) - 1] . $word[0];
                    $previous_is_suffix = false;
                }
                $result_previous = $result;
            } else {
                array_push($words, $word[0]);
            }
        }
        return $words;
    }

    static function is_particle($word, $result_previous) {
        $particles = ["で", "は", "が", "か", "に", "の", "へ", "を", "と", "や", "など", "も", "から", "まで", "とか", "でも", "ので", "のに", "し", "ね", "かな", "わ", "ぜ", "ぞ"];
        if (!in_array($word, $particles) && (!in_array("助動詞", $result_previous))) {
            return false;
        } else {
            return true;
        }
    }

    static function is_desu($word) {
        if ($word == "だ" || $word == "です" || $word == "だった" || $word == "でした" || $word == "でしょう" || $word == "でしょ") {
            return true;
        } else {
            return false;
        }
    }

}
