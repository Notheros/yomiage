<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author willi
 */
class JapaneseOLD {
    


    static function get_particles() {
        $particles = [
            "で" => "indicates location of action; at; in; means of action; cause of effect; by",
            "は" => "topic marker particle",
            "か" => "indicates a question; or; whether or not",
            "が" => "indicates sentence subject; but; however",
            "に" => "at (place, time); in; on; during; to (direction, state); toward; into",
            "の" => "indicates possessive; nominalizes verbs and adjectives",
            "へ" => "indicates direction or goal (e.g. to)",
            "を" => "indicates direct object of action",
            "と" => "if; when; with; used for quoting",
            "や" => "such things as (and...and)",
            "など" => "et cetera; etc.; and the like; and so forth",
            "も" => "too; also; even if; even though",
            "から" => "from; since; because",
            "より" => "than; from; other than",
            "まで" => "till; up to; to (an extent)",
            "くらい" => "approximately; about; around; or so",
            "ほど" => "degree; extent; bounds; limit",
            "ばかり" => "only; merely; nothing but; no more than",
            "という" => "called; named",
            "とか" => "among other things; such things as; or something like that",
            "でも" => "but; however; even if",
            "だけ" => "only; just; merely; simply; no more than",
            "ところ" => "place; address; about to; was just doing",
            "ながら" => "while; during; as",
            "ので" => "that being the case; because of",
            "ば" => "if ... then; when",
            "のみ" => "only; nothing but",
            "さえ" => "even; if only; if just; as long as",
            "のに" => "although; and yet; despite this; in spite of; even though",
            "きり" => "Indicates a limit to an amount",
            "しか" => "only; nothing but",
            "しかない" => "have no choice; there is nothing but",
            "し" => "(at the end of a phrase) notes one or several reasons",
            "など" => "et cetera; etc.; and the like; and so forth",
            "やら" => "such things as A and B; A and B and the like",
            "こそ" => "for sure (emphasize preceding word)",
            "について" => "concerning; regarding",
            "にとって" => "to; for",
            "として" => "as (i.e. in the role of); for (i.e. from the viewpoint of)",
            "ばかりに" => "(simply) because; on account of",
            "すら" => "even; if only; if just; as long as",
            "ところが" => "nevertheless; on the contrary; as a matter of fact; however",
            "だけに" => "...being the case; (precisely) because",
            "までもない" => "not significant enough to require (something); unnecessary",
            "ところで" => "by the way",
            "けれども" => "but; however; although",
            "ね" => "(at sentence-end) indicates emphasis, agreement, request for confirmation",
            "よ" => "(at sentence-end) indicates certainty, emphasis, contempt, request",
            "かしら" => "I wonder (usu. fem)",
            "かな" => "(at sentence end) I wonder",
            "わ" => "indicates emotion (female term); indicates emphasis",
            "ぜ" => "(sentence end) adds force; indicates command",
            "ぞ" => "(sentence end) adds force; indicates command"
        ];
        return $particles;
    }








    static function preg_replace_adjs($alladjs, &$text) {
        foreach ($alladjs as $kanji => $adjs) {
            if (strpos($text, $kanji) !== FALSE) {
                foreach ($adjs as $adj) {
                    $meaning = addslashes($adj['meanings']);
                    $id = $adj['id'];

                    foreach ($adj as $key => $inflexion) {
                        if (mb_strlen($inflexion) > 1 && $key != "meanings" & $key != "id") {
                            $text = str_replace($inflexion, "<span title='{$meaning}' adj='$id' class='adjs highlight_adj'>$inflexion</span>", $text);
                        }
                    }
                }
            }
        }
    }



    static function preg_replace_nouns($allnouns, &$text) {
        foreach ($allnouns as $word) {
            $id = $word['id'];
            $meaning = $word['meanings'];
            $okurigana = $word['okurigana'];
            $plain = $word['plain'];

            if (strpos($word['type'], "Suru verb") !== FALSE) {
                $suffixes = self::gen_suffix($okurigana);

                foreach ($suffixes as $suffix) {
                    $text = str_replace($suffix, "<span jukugo='$id' title='{$meaning}' class='jukugo highlight_suffix'>{$suffix}</span>", $text);
                }
                $text = str_replace($okurigana, "<span noun='$id' title='{$meaning}' class='nouns highlight_noun'>$okurigana</span>", $text);
                $text = str_replace($plain, "<span noun='$id' title='{$meaning}' class='nouns highlight_noun'>$plain</span>", $text);
            } else {
                $text = str_replace($okurigana, "<span noun='$id' title='{$meaning}' class='nouns highlight_noun'>$okurigana</span>", $text);
                $text = str_replace($plain, "<span noun='$id' title='{$meaning}' class='nouns highlight_noun'>$plain</span>", $text);
            }
        }
    }

    static function is_jukugo($str) {
        if (preg_match("/^\p{Han}+$/u", $str)) {
            return true;
        } else {
            return false;
        }
    }

    

}
