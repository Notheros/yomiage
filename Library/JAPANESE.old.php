<?php

class JAPANESE {

    private $hiragana = array(
        'あ', 'い', 'う', 'え', 'お',
        'か', 'き', 'く', 'け', 'こ',
        'さ', 'し', 'す', 'せ', 'そ',
        'た', 'ち', 'つ', 'て', 'と',
        'な', 'に', 'ぬ', 'ね', 'の',
        'は', 'ひ', 'ふ', 'へ', 'ほ',
        'ま', 'み', 'む', 'め', 'も',
        'や', 'ゆ', 'よ',
        'ら', 'り', 'る', 'れ', 'ろ',
        'わ', 'ゐ', 'ゑ', 'を',
        'ん',
        'が', 'ぎ', 'ぐ', 'げ', 'ご',
        'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
        'だ', 'ぢ', 'づ', 'で', 'ど',
        'ば', 'び', 'ぶ', 'べ', 'ぼ',
        'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ',
        'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
    );
    private $katakana = array(
        'ア', 'イ', 'ウ', 'エ', 'オ',
        'カ', 'キ', 'ク', 'ケ', 'コ',
        'サ', 'シ', 'ス', 'セ', 'ソ',
        'タ', 'チ', 'ツ', 'テ', 'ト',
        'ナ', 'ニ', 'ヌ', 'ネ', 'ノ',
        'ハ', 'ヒ', 'フ', 'ヘ', 'ホ',
        'マ', 'ミ', 'ム', 'メ', 'モ',
        'ヤ', 'ユ', 'ヨ',
        'ラ', 'リ', 'ル', 'レ', 'ロ',
        'ワ', 'ヰ', 'ヱ', 'ヲ',
        'ン',
        'ガ', 'ギ', 'グ', 'ゲ', 'ゴ',
        'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ',
        'ダ', 'ヂ', 'ヅ', 'デ', 'ド',
        'バ', 'ビ', 'ブ', 'ベ', 'ボ',
        'パ', 'ピ', 'プ', 'ペ', 'ポ',
        'ァ', 'ィ', 'ゥ', 'ェ', 'ォ',
        'ー',
    );
    private $particles = ["で", "は", "が", "か", "に", "の", "へ", "を", "と", "や", "など", "も", "から", "まで", "とか", "でも", "ので", "のに", "し", "ね", "かな", "わ", "ぜ", "ぞ"];
    private $words = array();

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
        FUNCTIONS::prettyPrint($output);
        return $this->fix_words($output);
    }

    function fix_words($output) {
//        FUNCTIONS::prettyPrint($output, false);

        $result_previous = array();
        $previous_is_suffix = false;
        $previous_is_desu = false;
        foreach ($output as $dict) {

            $word = explode("	", $dict);
            if (isset($word[1])) {
                $result = explode(",", $word[1]);


                if (in_array("動詞", $result)) {
//                    echo $result[6] . "<br>"; // o verbo na forma de padrao
                }


                if (!$previous_is_suffix) {
                    if (in_array("接頭詞", $result)) {
//                        $previous_is_suffix = true;
                    }

                    if (mb_strpos($word[1], "特殊・") || in_array("接続助詞", $result)) {
                        if ((in_array("助詞", $result)) && $this->is_particle($word[0], $result_previous)) {
                            $this->add_word($word[0], $result, $result_previous);
                            $result_previous = $result;
                        } else {
                            if ($this->is_desu($word[0])) {
                                $previous_is_desu = true;
                                $this->add_word($word[0], $result, $result_previous);
                                $result_previous = $result;
                            } else {
                                $this->add_word($word[0], $result, $result_previous, false);
                            }
                        }
                    } else {
                        if ($previous_is_desu && $word[0] == "う") {
                            $this->add_word($word[0], $result, $result_previous, false);
                        } else {
                            $this->add_word($word[0], $result, $result_previous);
                            $result_previous = $result;
                        }
                    }
                } else {
                    $this->add_word($word[0], $result, $result_previous, false);
                    $previous_is_suffix = false;
                }
            } else {
                $this->add_word($word[0], $result);
            }
        }

        return $this->words;
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

    function add_word($word, $result, $result_previous = false, $wakachi = true) {

        if ($wakachi) {
            $class = $this->get_class($result);
            if ($class == 'verb') {
                $dict['dict_form'] = $result[6];
            } else {
                $dict['dict_form'] = '';
            }


            $dict['word'] = $word;
            if ($result_previous && in_array("動詞", $result_previous) && ($word == "の") || $word == "ん") {
                $class = 'particle';
            }
            $dict['class'] = $class;
            if ($dict['class'] == 'verb' || $dict['class'] == 'noun') {
                $dict['reading'] = $result[7];
            } else {
                $dict['reading'] = '';
            }
            array_push($this->words, $dict);
        } else {
            $dict['class'] = $this->get_class($result_previous);
            if ($dict['class'] == 'verb') {
                $dict['dict_form'] = $result_previous[6];
            } else {
                $dict['dict_form'] = '';
            }
            if ($dict['class'] == 'verb' || $dict['class'] == 'noun') {
                $dict['reading'] = $result[7];
            } else {
                $dict['reading'] = '';
            }


            $dict['word'] = $this->words[count($this->words) - 1]['word'] . $word;
            $this->words[count($this->words) - 1] = $dict;
        }
    }

    function get_class($result) {
        if (in_array("助詞", $result)) {
            $class = "particle";
        } else if (in_array("動詞", $result)) {
            $class = "verb";
        } else if (in_array("名詞", $result)) {
            $class = "noun";
        } else if (in_array("副詞", $result)) {
            $class = "adverb";
        } else if (in_array("連体詞", $result)) {
            $class = "pre_noun_adjectival";
        } else {
            $class = "";
        }
        return $class;
    }

    function kata_to_hira($kata) {
        return str_replace($this->katakana, $this->hiragana, $kata);
    }


}
