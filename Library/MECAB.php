<?php

class MECAB {
    
    private $particles = ["で", "は", "が", "か", "に", "の", "へ", "を", "と", "や", "など", "も", "から", "まで", "とか", "でも", "ので", "のに", "し", "ね", "かな", "わ", "ぜ", "ぞ"];

    function mecab_it($input) {
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
        return $this->fix_words($output);
//        return $output;
    }

    function fix_words($output) {
        Helper::prettyPrint($output, false);
        $result_previous = array();
        $previous_is_suffix = false;
        $previous_is_desu = false;
        $words = array();
        foreach ($output as $dict) {

            $word = explode("	", $dict);
            if (isset($word[1])) {
                $result = explode(",", $word[1]);

                $class = $this->get_class($result);


                if (!$previous_is_suffix) {
                    if (in_array("接頭詞", $result)) {
                        $previous_is_suffix = true;
                    }

                    if (mb_strpos($word[1], "特殊・") || in_array("接続助詞", $result)) {
//                        in_array("接尾", $result)
                        if ((in_array("助詞", $result)) && $this->is_particle($word[0], $result_previous)) {
                            $this->add_word($words, $word[0], $class, $result_previous);
                            $result_previous = $result;
                        } else {
                            if ($this->is_desu($word[0])) {
                                $previous_is_desu = true;
                                $this->add_word($words, $word[0], $class, $result_previous);
                                $result_previous = $result;
                            } else {
                                $this->add_word($words, $word[0], $class, $result_previous, false);
                            }
                        }
                        
                    } else {
                        if ($previous_is_desu && $word[0] == "う") {
                            $this->add_word($words, $word[0], $class, $result_previous, false);
                        } else {
                            $this->add_word($words, $word[0], $class, $result_previous);
                            $result_previous = $result;
                        }
                    }
                } else {
                    $this->add_word($words, $word[0], $class, $result_previous, false);
                    $previous_is_suffix = false;
                }
            } else {
                $this->add_word($words, $word[0], $class);
            }
        }
        return $words;
    }

    function is_particle($word, $result_previous) {
        if (!in_array($word, $this->particles) && (!in_array("助動詞", $result_previous))) {
            return false;
        } else {
            return true;
        }
    }

    function is_desu($word) {
        if ($word == "だ" || $word == "です" || $word == "だった" || $word == "でした" || $word == "でしょう" || $word == "でしょ") {
            return true;
        } else {
            return false;
        }
    }

    function add_word(&$words, $word, $class, $result_previous = false, $wakachi = true) {
        if ($wakachi) {
            $word = "<span class='$class'>$word</span>";
            array_push($words, $word);
        } else {
            $class = $this->get_class($result_previous);
            $words[count($words) - 1] = "<span class='$class'>" . strip_tags($words[count($words) - 1]) . $word . "</span>";
        }
    }

    function get_class($result) {
        if (in_array("助詞", $result)) {
            $class = "particle";
        } else if (in_array("動詞", $result)) {
            $class = "verb";
        } else if (in_array("名詞", $result)) {
            $class = "noun";
        } else {
            $class = "";
        }
        return $class;
    }

}
