<?php

class NIHONGO {

    static $hiragana = array(
        'あ', 'い', 'う', 'え', 'お', 'か', 'き', 'く', 'け', 'こ',
        'さ', 'し', 'す', 'せ', 'そ', 'た', 'ち', 'つ', 'て', 'と',
        'な', 'に', 'ぬ', 'ね', 'の', 'は', 'ひ', 'ふ', 'へ', 'ほ',
        'ま', 'み', 'む', 'め', 'も', 'や', 'ゆ', 'よ',
        'ら', 'り', 'る', 'れ', 'ろ', 'わ', 'ゐ', 'ゑ', 'を',
        'ん',
        'が', 'ぎ', 'ぐ', 'げ', 'ご', 'ざ', 'じ', 'ず', 'ぜ', 'ぞ',
        'だ', 'ぢ', 'づ', 'で', 'ど', 'ば', 'び', 'ぶ', 'べ', 'ぼ',
        'ぱ', 'ぴ', 'ぷ', 'ぺ', 'ぽ', 'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ',
        'ゃ', 'ぇ', 'ょ', 'っ', 'ゅ'
    );
    static $katakana = array(
        'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
        'サ', 'シ', 'ス', 'セ', 'ソ', 'タ', 'チ', 'ツ', 'テ', 'ト',
        'ナ', 'ニ', 'ヌ', 'ネ', 'ノ', 'ハ', 'ヒ', 'フ', 'ヘ', 'ホ',
        'マ', 'ミ', 'ム', 'メ', 'モ', 'ヤ', 'ユ', 'ヨ',
        'ラ', 'リ', 'ル', 'レ', 'ロ', 'ワ', 'ヰ', 'ヱ', 'ヲ',
        'ン',
        'ガ', 'ギ', 'グ', 'ゲ', 'ゴ', 'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ',
        'ダ', 'ヂ', 'ヅ', 'デ', 'ド', 'バ', 'ビ', 'ブ', 'ベ', 'ボ',
        'パ', 'ピ', 'プ', 'ペ', 'ポ', 'ァ', 'ィ', 'ゥ', 'ェ', 'ォ',
        'ャ', 'ェ', 'ョ', 'ッ', 'ュ'
    );
    
    static $particles = array(
        "で", "は", "が", "か", "に", "の",
        "へ", "を", "と", "や", "など", "も",
        "から", "まで", "とか", "でも", "ので",
        "のに", "し", "ね", "かな", "わ",
        "ぜ", "ぞ"
    );

    static $expressions = array(
        // array('parts' => array("よう", "に", "なる"), 'type' => '五弾'),
        array("と", "なる", "ため", "に"),
        array("よう", "に", "なる"),
        array("に", "なる", "と"),
        array("の", "方", "が"),
        array("の", "よう", "に"),
        array("に", "なる", "と"),
        array("か", "どう", "か"),
        array("よく", "ある"),
        array("です", "が"),
        array("より", "も"),
        array("に", "なる"),
        array("と", "なる"),
        array("なん", "か"),
    );
    //        array("動詞", "接続助詞"),
//        array("動詞", "助動詞"),
//                array("動詞", "接尾", "助動詞"),
//        array("助動詞", "助詞"),

    static $continuitive = array(
        array("動詞", "動詞", "助動詞", "助動詞"),
        array("動詞", "接尾", "接続助詞"),
        array("スル", "一段", "助動詞"),
        array("動詞", "マス", "助動詞"),
        array("五段", "接尾", "ナイ"),
        array("五段", "接尾", "タ"),
        array("一段", "接尾", "ナイ"),
        array("動詞", "マス"),
        array("動詞", "接尾"),
        array("動詞", "助詞"),
        array("形容詞", "助動詞"),
        array("助詞", "助動詞"),
        array("動詞", "接尾"),
        array("動詞", "助動詞"),
        array("助動詞", "助動詞"),
    );

    /*
     * [0] Tipo primário
     * [1] Tipo secundário
     * [2] ??
     * [3] ??
     * [4] Tipo do verbo (godan, ichidan
     * [5] 連用形 continuative form
     * [6] Versão do dicionário
     * [7] Furigana
     * [8] Furigana alternativa
     */

    static function analyseText($input) {
        $input = str_replace("　", "", $input);
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
        return self::processResults($output);
    }

    static function processResults($output) {
//        echo $_POST['print'];
        if ((bool) $_POST['print']) {
            FUNCTIONS::prettyPrint($output, false);
        }
        $output = ARRAYS::deal_with_mecab_output($output);
   

        foreach (self::$continuitive as $pow) {
            $result2 = ARRAYS::contains_array_in_arrays($pow, $output['descriptions']);
            foreach ($result2 as $index2) {
                $first = $index2[0];
                $furigana = explode(",", $output['descriptions'][$first])[7];
                foreach ($index2 as $key => $i2) {
                    if ($key > 0) {
                        if (isset($output['words'][$i2])) {
                            $output['words'][$first] .= $output['words'][$i2];
                            unset($output['words'][$i2]);
                        }
                        @$furigana .= explode(",", $output['descriptions'][$i2])[7];
                        @$form = explode(",", $output['descriptions'][$first])[4];
                        @$base = explode(",", $output['descriptions'][$first])[6];
                        @$type = explode(",", $output['descriptions'][$first])[0];

                        unset($output['descriptions'][$i2]);
                    }
                }

//                $length_furigana = mb_strlen($furigana) - (mb_strlen($output['words'][$first]) - 1);
//                $furigana = mb_substr($furigana, 0, $length_furigana);
//                                $output['descriptions'][$first] = "動詞, -,-,-,{$form},-,{$base},<b>{$furigana}</b>,-";

                $output['descriptions'][$first] = "{$type}, -,-,-,{$form},-,{$base},<b>{$furigana}</b>,-";
            }
        }

             foreach (self::$expressions as $expression) {
            $result = ARRAYS::find_array_in_array($expression, $output['words']);
            foreach ($result as $index) {
                $first = $index[0];

                foreach ($index as $key => $i) {
                    if ($key > 0) {
                        $output['words'][$first] .= $output['words'][$i];
                        unset($output['words'][$i]);
                        unset($output['descriptions'][$i]);
                    }
                }
                $output['descriptions'][$first] = "連語, -";
            }
        }



        $output['words'] = array_values($output['words']);
        $output['descriptions'] = array_values($output['descriptions']);




        $words = array();
        foreach ($output['words'] as $key => $value) {

            if (!empty($value)) {
                $description = explode(",", $output['descriptions'][$key]);
//                    $description = self::processDescription($description);
                $word['word'] = $value;
                if (self::is_only_kana($value)) {
                    $word['furigana'] = null;
                } else {
                    $word['furigana'] = self::getFurigana($description);
                }
                
                if (GRAMMAR::isParticle($value, $description)) {
                    $word['type'] = "particle";
                } elseif (GRAMMAR::isNoun($description)) {
                    $word['type'] = "noun";
                } elseif (GRAMMAR::isExpression($description)) {
                    $word['type'] = "expression";
                } elseif (GRAMMAR::isVerb($description)) {
                    $word['type'] = "verb";
                } elseif (GRAMMAR::isAdverb($description)) {
                    $word['type'] = "adverb";
                } elseif (GRAMMAR::isConjunction($description)) {
                    $word['type'] = "conjunction";
                } elseif (GRAMMAR::isPreNounAdjectival($description)) {
                    $word['type'] = "pre_noun_adjectival";
                } elseif (GRAMMAR::isIAdjective($description)) {
                    $word['type'] = "i_adjective";
                } else {
                    $word['type'] = "";
                }
                @$word['t'] = $description[4];
                @$word['base'] = $description[6];

                array_push($words, $word);
            }
        }
    //    FUNCTIONS::prettyPrint($words, false);
        return $words;
    }

//    static function processDescription($description) {
//        foreach ($description as $key => $value) {
//            if ($value === "*") {
//                unset($description[$key]);
//            }
//        }
//        return array_values($description);
//    }

    static function getFurigana($description) {
        $furigana = isset($description[7]) ? $description[7] : "";
        return self::kata_to_hira($furigana);
    }

    static function kata_to_hira($kata) {
        return str_replace(self::$katakana, self::$hiragana, $kata);
    }

    static function is_jukugo($str) {
        if (preg_match("/^\p{Han}+$/u", $str)) {
            return true;
        } else {
            return false;
        }
    }

    static function is_only_kana($str) {
        if (preg_match("/^[\ぁ-ゔァ-ヺ]+$/u", $str)) {
            return true;
        } else {
            return false;
        }
    }

}
