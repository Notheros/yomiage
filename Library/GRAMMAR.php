<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GRAMMAR
 *
 * @author Notheros
 */
class GRAMMAR {

    static private $noun = "名詞";
    static private $particle = "助詞";
    static private $expression = "連語";
    static private $verb = "動詞";
    static private $adverb = "副詞";
    static private $conjunction = "接続詞";
    static private $preNounAdjectival = "連体詞";
    static private $IAdjective = "形容詞・イ段";

    static function isNoun($description) {
        return in_array(self::$noun, $description);
    }

    static function isParticle($word, $description) {
        return (in_array(self::$particle, $description) && in_array($word, NIHONGO::$particles));
    }

    static function isExpression($description) {
        return in_array(self::$expression, $description);
    }

    static function isVerb($description) {
        return in_array(self::$verb, $description);
    }

    static function isAdverb($description) {
        return in_array(self::$adverb, $description);
    }

    static function isConjunction($description) {
        return in_array(self::$conjunction, $description);
    }

    static function isPreNounAdjectival($description) {
        return in_array(self::$preNounAdjectival, $description);
    }
    
     static function isIAdjective($description) {
        return in_array(self::$IAdjective, $description);
    }

    static function create_ichidan_inflections($verb, $plain) {
        $inflections = array();
        $okurigana = $verb;

        $kanji = mb_substr($okurigana, 0, 1);
        $length_furigana = mb_strlen($plain) - (mb_strlen($verb) - 1);
        $furigana = mb_substr($plain, 0, $length_furigana);
        $base = mb_substr($okurigana, 0, -1);
        

        $inflections['furigana'] = $furigana;
        $inflections['okurigana'] = $okurigana;
        $inflections['plain_polite'] = $base . "ます";
        $inflections['plain_neg'] = $base . "ない";
        $inflections['plain_neg_polite'] = $base . "ません";
        $inflections['nu_form'] = $base . "ぬ";
        $inflections['mu_form'] = $base . "む";
        $inflections['mu_form_alt'] = $base . "ん";
        $inflections['past'] = $base . "た";
        $inflections['past_alt_1'] = $base . "たんだ";
        $inflections['past_alt_2'] = $base . "たんです";

        $inflections['past_polite'] = $base . "ました";
        $inflections['past_neg'] = $base . "なかった";
        $inflections['past_neg_polite'] = $base . "ませんでした";
        $inflections['te_form'] = $base . "て";
        $inflections['te_form_polite'] = $base . "まして";
        $inflections['te_form_neg'] = $base . "なくて";
        $inflections['te_form_neg_alt'] = $base . "ないで";
        $inflections['te_form_neg_polite'] = $base . "ませんで";
        $inflections['zu_form'] = $base . "ず";
        $inflections['zu_ni_form'] = $base . "ずに";
        $inflections['conditional'] = $base . "たら";
        $inflections['conditional_polite'] = $base . "ましたら";
        $inflections['conditional_neg'] = $base . "なかったら";
        $inflections['conditional_neg_polite'] = $base . "ませんでしたら";
        $inflections['provisional'] = $base . "れば";
        $inflections['provisional_polite'] = $base . "ませば";
        $inflections['provisional_neg'] = $base . "なければ";
        $inflections['provisional_neg_polite'] = $base . "ませんなら";
        $inflections['volitional'] = $base . "よう";
        $inflections['volitional_polite'] = $base . "ましょう";
        $inflections['volitional_neg'] = $base . "まい";
        $inflections['volitional_neg_polite'] = $base . "ますまい";
        $inflections['imperative'] = $base . "ろ";
        $inflections['imperative_polite'] = $base . "てください";
        $inflections['imperative_nasai'] = $base . "なさい";
        $inflections['imperative_polite_alt'] = $base . "よ"; //nao tem no v5
        $inflections['imperative_neg'] = $base . "るな";
        $inflections['imperative_neg_polite'] = $base . "ないでください";
        $inflections['potential'] = $base . "れる";
        $inflections['potential_polite'] = $base . "れます";
        $inflections['potential_neg'] = $base . "れない";
        $inflections['potentional_neg_polite'] = $base . "れません";
        $inflections['potential_past'] = $base . "れた";
        $inflections['potential_past_polite'] = $base . "れました";
        $inflections['potential_neg_past'] = $base . "れなかった";
        $inflections['potential_neg_past_polite'] = $base . "れませんでした";
        $inflections['passive'] = $base . "られる";
        $inflections['passive_polite'] = $base . "られます";
        $inflections['passive_neg'] = $base . "られない";
        $inflections['passive_neg_polite'] = $base . "られません";
        $inflections['passive_past'] = $base . "られた";
        $inflections['passive_past_polite'] = $base . "られました";
        $inflections['passive_neg_past'] = $base . "られなかった";
        $inflections['passive_neg_past_polite'] = $base . "られませんでした";
        $inflections['causative'] = $base . "させる";
        $inflections['causative_polite'] = $base . "させます";
        $inflections['causative_neg'] = $base . "させない";
        $inflections['causative_neg_polite'] = $base . "させません";
        $inflections['causative_past'] = $base . "させた";
        $inflections['causative_past_polite'] = $base . "させました";
        $inflections['causative_neg_past'] = $base . "させなかった";
        $inflections['causative_neg_past_polite'] = $base . "させませんでした";
        $inflections['causative_passive'] = $base . "させられる";
        $inflections['causative_passive_polite'] = $base . "させられます";
        $inflections['causative_passive_neg'] = $base . "させられない";
        $inflections['causative_passive_neg_polite'] = $base . "させられません";
        $inflections['causative_passive_past'] = $base . "させられた";
        $inflections['causative_passive_past_polite'] = $base . "させられた";
        $inflections['causative_passive_neg_past'] = $base . "させられた";
        $inflections['causative_passive_neg_past_polite'] = $base . "させられた";
        $inflections['adverbial'] = $base . "なく";
        $inflections['tai'] = $base . "たい";
        $inflections['tai_past'] = $base . "たかった";
        $inflections['tai_neg'] = $base . "たくない";
        $inflections['tai_neg_past'] = $base . "たくなかった";
        $inflections['description'] = $base . "たり";
        return $inflections;
    }

}
