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
class Japanese {

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

    static function create_verb_inflections_array($verb) {
        $dan = $verb['type'];
        if ($dan == 'v1') {
            return self::create_ichidan_inflections($verb);
        } else if ($dan == 'v5') {
            return self::create_godan_inflections($verb);
        } else if ($dan == 'vsi') {
            return self::create_vsi_inflections($verb);
        } else if ($dan == 'vi') {
            
        }
    }

    private static function create_v5i_inflections($verb) {
        $inflections = array();
        $okurigana = $verb['okurigana'];

//
//        $length_furigana = mb_strlen($verb['plain']) - (mb_strlen($verb['okurigana']) - 1);
//        $furigana = mb_substr($verb['plain'], 0, $length_furigana);
//        $kanji = mb_substr($okurigana, 0, 1);
//        $base = mb_substr($okurigana, 0, -1);
//        $extra = self::get_extra_godan($okurigana);
//
//        $base_i = $base . $extra['i'];
//        $base_a = $base . $extra['a'];
//        $base_e = $base . $extra['e'];
//        $base_o = $base . $extra['o'];
//
//        $past_ending = $extra['past'];
//        $te_ending = $extra['te_form'];
//        $inflections['furigana'] = $furigana;
//        $inflections['okurigana'] = $okurigana;
//        $inflections['plain_polite'] = $base_i . "ます";
//        $inflections['plain_neg'] = $base_a . "ない";
//        $inflections['plain_neg_polite'] = $base_i . "ません";
//        $inflections['nu_form'] = $base_a . "ぬ";
//        $inflections['mu_form'] = $base_a . "む";
//        $inflections['mu_form_alt'] = $base_a . "ん";
//        $inflections['past'] = $base . $past_ending;
//        $inflections['past_alt_1'] = $base . $past_ending . "んだ";
//        $inflections['past_alt_2'] = $base . $past_ending . "んです";
//        $inflections['past_polite'] = $base_i . "ました";
//        $inflections['past_neg'] = $base_a . "なかった";
//        $inflections['past_neg_polite'] = $base_i . "ませんでした";
//        $inflections['te_form'] = $base . $te_ending;
//        $inflections['te_form_polite'] = $base_i . "まして";
//        $inflections['te_form_neg'] = $base_a . "なくて";
//        $inflections['te_form_neg_alt'] = $base_a . "ないで";
//        $inflections['te_form_neg_polite'] = $base_i . "ませんで";
//        $inflections['zu_form'] = $base_a . "ず";
//        $inflections['zu_ni_form'] = $base_a . "ずに";
//        $inflections['conditional'] = $base . $past_ending . "ら";
//        $inflections['conditional_polite'] = $base_i . "ましたら";
//        $inflections['conditional_neg'] = $base_a . "なかったら";
//        $inflections['conditional_neg_polite'] = $base_i . "ませんでしたら";
//        $inflections['provisional'] = $base_e . "ば";
//        $inflections['provisional_polite'] = $base_i . "ませば";
//        $inflections['provisional_neg'] = $base_a . "なければ";
//        $inflections['provisional_neg_polite'] = $base_i . "ませんなら";
//        $inflections['volitional'] = $base_o . "う";
//        $inflections['volitional_polite'] = $base_i . "ましょう";
//        $inflections['volitional_neg'] = $base . "まい";
//        $inflections['volitional_neg_polite'] = $base_i . "ますまい";
//        $inflections['imperative'] = $base_e;
//        $inflections['imperative_polite'] = $base . $past_ending . "ください";
//        $inflections['imperative_nasai'] = $base_i . "なさい";
//        $inflections['imperative_neg'] = $okurigana . "な";
//        $inflections['imperative_neg_polite'] = $base_a . "ないでください";
//        $inflections['potential'] = $base_e . "る";
//        $inflections['potential_polite'] = $base_e . "ます";
//        $inflections['potential_neg'] = $base_e . "ない";
//        $inflections['potentional_neg_polite'] = $base_e . "ません";
//        $inflections['potential_past'] = $base_e . "た";
//        $inflections['potential_past_polite'] = $base_e . "ました";
//        $inflections['potential_neg_past'] = $base_e . "なかった";
//        $inflections['potential_neg_past_polite'] = $base_e . "ませんでした";
//        $inflections['passive'] = $base_a . "れる";
//        $inflections['passive_te'] = $base_a . "れて";
//        $inflections['passive_polite'] = $base_a . "れます";
//        $inflections['passive_neg'] = $base_a . "れない";
//        $inflections['passive_neg_polite'] = $base_a . "れません";
//        $inflections['passive_past'] = $base_a . "れた";
//        $inflections['passive_past_polite'] = $base_a . "れました";
//        $inflections['passive_neg_past'] = $base_a . "れなかった";
//        $inflections['passive_neg_past_polite'] = $base_a . "れませんでした";
//        $inflections['causative'] = $base_a . "せる";
//        $inflections['causative_polite'] = $base_a . "せます";
//        $inflections['causative_neg'] = $base_a . "せない";
//        $inflections['causative_neg_polite'] = $base_a . "せません";
//        $inflections['causative_past'] = $base_a . "せた";
//        $inflections['causative_past_polite'] = $base_a . "せました";
//        $inflections['causative_neg_past'] = $base_a . "せなかった";
//        $inflections['causative_neg_past_polite'] = $base_a . "せませんでした";
//        $inflections['causative_passive'] = $base_a . "せられる";
//        $inflections['causative_passive_polite'] = $base_a . "せられます";
//        $inflections['causative_passive_neg'] = $base_a . "せられない";
//        $inflections['causative_passive_neg_polite'] = $base_a . "せられません";
//        $inflections['causative_passive_past'] = $base_a . "せられた";
//        $inflections['causative_passive_past_polite'] = $base_a . "せられました";
//        $inflections['causative_passive_neg_past'] = $base_a . "せられなかった";
//        $inflections['causative_passive_neg_past_polite'] = $base_a . "せられませんでした";
//        $inflections['adverbial'] = $base_a . "なく";
//        $inflections['tai'] = $base_i . "たい";
//        $inflections['tai_past'] = $base_i . "たかった";
//        $inflections['tai_neg'] = $base_i . "たくない";
//        $inflections['tai_neg_past'] = $base_i . "たくなかった";
//        $inflections['description'] = $base . $past_ending . "り";
        return $inflections;
    }

    private static function create_vsi_inflections($verb) {
        $inflections = array();
        $base = mb_substr($verb['okurigana'], 0, -2);
        $inflections['okurigana'] = $base . "する";
        $inflections['plain_polite'] = $base . "します";
        $inflections['plain_neg'] = $base . "しない";
        $inflections['plain_neg_polite'] = $base . "しません";
        $inflections['past'] = $base . "した";
        $inflections['past_alt_1'] = $base . "したんだ";
        $inflections['past_alt_2'] = $base . "したんです";

        $inflections['past_polite'] = $base . "しました";
        $inflections['past_neg'] = $base . "しなかった";
        $inflections['past_neg_polite'] = $base . "しませんでした";
        $inflections['te_form'] = $base . "して";
        $inflections['te_form_polite'] = $base . "しまして";
        $inflections['te_form_neg_alt'] = $base . "しないで";
        $inflections['imperative'] = $base . "しろ";
        $inflections['imperative_polite'] = $base . "してください";
        $inflections['imperative_nasai'] = $base . "しなさい";
        $inflections['imperative_polite_alt'] = $base . "せよ"; //nao tem no v5
        $inflections['imperative_neg'] = $base . "するな";
        $inflections['imperative_neg_polite'] = $base . "しないでください";
        return $inflections;
    }

    private static function create_ichidan_inflections($verb) {
        $inflections = array();
        $okurigana = $verb['okurigana'];

        $kanji = mb_substr($okurigana, 0, 1);
        $length_furigana = mb_strlen($verb['plain']) - (mb_strlen($verb['okurigana']) - 1);
        $furigana = mb_substr($verb['plain'], 0, $length_furigana);
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

    private static function create_godan_inflections($verb) {
        $inflections = array();
        $okurigana = $verb['okurigana'];

        $length_furigana = mb_strlen($verb['plain']) - (mb_strlen($verb['okurigana']) - 1);
        $furigana = mb_substr($verb['plain'], 0, $length_furigana);
        $kanji = mb_substr($okurigana, 0, 1);
        $base = mb_substr($okurigana, 0, -1);
        $extra = self::get_extra_godan($okurigana);

        $base_i = $base . $extra['i'];
        $base_a = $base . $extra['a'];
        $base_e = $base . $extra['e'];
        $base_o = $base . $extra['o'];

        $past_ending = $extra['past'];
        $te_ending = $extra['te_form'];
        $inflections['furigana'] = $furigana;
        $inflections['okurigana'] = $okurigana;
        $inflections['plain_polite'] = $base_i . "ます";
        $inflections['plain_neg'] = $base_a . "ない";
        $inflections['plain_neg_polite'] = $base_i . "ません";
        $inflections['nu_form'] = $base_a . "ぬ";
        $inflections['mu_form'] = $base_a . "む";
        $inflections['mu_form_alt'] = $base_a . "ん";
        $inflections['past'] = $base . $past_ending;
        $inflections['past_alt_1'] = $base . $past_ending . "んだ";
        $inflections['past_alt_2'] = $base . $past_ending . "んです";
        $inflections['past_polite'] = $base_i . "ました";
        $inflections['past_neg'] = $base_a . "なかった";
        $inflections['past_neg_polite'] = $base_i . "ませんでした";
        $inflections['te_form'] = $base . $te_ending;
        $inflections['te_form_polite'] = $base_i . "まして";
        $inflections['te_form_neg'] = $base_a . "なくて";
        $inflections['te_form_neg_alt'] = $base_a . "ないで";
        $inflections['te_form_neg_polite'] = $base_i . "ませんで";
        $inflections['zu_form'] = $base_a . "ず";
        $inflections['zu_ni_form'] = $base_a . "ずに";
        $inflections['conditional'] = $base . $past_ending . "ら";
        $inflections['conditional_polite'] = $base_i . "ましたら";
        $inflections['conditional_neg'] = $base_a . "なかったら";
        $inflections['conditional_neg_polite'] = $base_i . "ませんでしたら";
        $inflections['provisional'] = $base_e . "ば";
        $inflections['provisional_polite'] = $base_i . "ませば";
        $inflections['provisional_neg'] = $base_a . "なければ";
        $inflections['provisional_neg_polite'] = $base_i . "ませんなら";
        $inflections['volitional'] = $base_o . "う";
        $inflections['volitional_polite'] = $base_i . "ましょう";
        $inflections['volitional_neg'] = $base . "まい";
        $inflections['volitional_neg_polite'] = $base_i . "ますまい";
        $inflections['imperative'] = $base_e;
        $inflections['imperative_polite'] = $base . $past_ending . "ください";
        $inflections['imperative_nasai'] = $base_i . "なさい";
        $inflections['imperative_neg'] = $okurigana . "な";
        $inflections['imperative_neg_polite'] = $base_a . "ないでください";
        $inflections['potential'] = $base_e . "る";
        $inflections['potential_polite'] = $base_e . "ます";
        $inflections['potential_neg'] = $base_e . "ない";
        $inflections['potentional_neg_polite'] = $base_e . "ません";
        $inflections['potential_past'] = $base_e . "た";
        $inflections['potential_past_polite'] = $base_e . "ました";
        $inflections['potential_neg_past'] = $base_e . "なかった";
        $inflections['potential_neg_past_polite'] = $base_e . "ませんでした";
        $inflections['passive'] = $base_a . "れる";
        $inflections['passive_te'] = $base_a . "れて";
        $inflections['passive_polite'] = $base_a . "れます";
        $inflections['passive_neg'] = $base_a . "れない";
        $inflections['passive_neg_polite'] = $base_a . "れません";
        $inflections['passive_past'] = $base_a . "れた";
        $inflections['passive_past_polite'] = $base_a . "れました";
        $inflections['passive_neg_past'] = $base_a . "れなかった";
        $inflections['passive_neg_past_polite'] = $base_a . "れませんでした";
        $inflections['causative'] = $base_a . "せる";
        $inflections['causative_polite'] = $base_a . "せます";
        $inflections['causative_neg'] = $base_a . "せない";
        $inflections['causative_neg_polite'] = $base_a . "せません";
        $inflections['causative_past'] = $base_a . "せた";
        $inflections['causative_past_polite'] = $base_a . "せました";
        $inflections['causative_neg_past'] = $base_a . "せなかった";
        $inflections['causative_neg_past_polite'] = $base_a . "せませんでした";
        $inflections['causative_passive'] = $base_a . "せられる";
        $inflections['causative_passive_polite'] = $base_a . "せられます";
        $inflections['causative_passive_neg'] = $base_a . "せられない";
        $inflections['causative_passive_neg_polite'] = $base_a . "せられません";
        $inflections['causative_passive_past'] = $base_a . "せられた";
        $inflections['causative_passive_past_polite'] = $base_a . "せられました";
        $inflections['causative_passive_neg_past'] = $base_a . "せられなかった";
        $inflections['causative_passive_neg_past_polite'] = $base_a . "せられませんでした";
        $inflections['adverbial'] = $base_a . "なく";
        $inflections['tai'] = $base_i . "たい";
        $inflections['tai_past'] = $base_i . "たかった";
        $inflections['tai_neg'] = $base_i . "たくない";
        $inflections['tai_neg_past'] = $base_i . "たくなかった";
        $inflections['description'] = $base . $past_ending . "り";
        return $inflections;
    }

    static function get_extra_godan($verb) {
        $current_ending = mb_substr($verb, -1);
        $extra = array();
        switch ($current_ending) {
            case 'う':
                $extra['a'] = "わ";
                $extra['i'] = "い";
                $extra['e'] = "え";
                $extra['o'] = "お";
                $extra['past'] = "った";
                $extra['te_form'] = "って";
                break;
            case 'つ':
                $extra['a'] = "た";
                $extra['i'] = "ち";
                $extra['e'] = "て";
                $extra['o'] = "と";
                $extra['past'] = "った";
                $extra['te_form'] = "って";
                break;
            case 'る':
                $extra['a'] = "ら";
                $extra['i'] = "り";
                $extra['e'] = "れ";
                $extra['o'] = "ろ";
                $extra['past'] = "った";
                $extra['te_form'] = "って";
                break;
            case 'ぶ':
                $extra['a'] = "ば";
                $extra['i'] = "び";
                $extra['e'] = "べ";
                $extra['o'] = "ぼ";
                $extra['past'] = "んだ";
                $extra['te_form'] = "んで";
                break;
            case 'む':
                $extra['a'] = "ま";
                $extra['i'] = "み";
                $extra['e'] = "め";
                $extra['o'] = "も";
                $extra['past'] = "んだ";
                $extra['te_form'] = "んで";
                break;
            case 'ぬ':
                $extra['a'] = "な";
                $extra['i'] = "に";
                $extra['e'] = "ね";
                $extra['o'] = "の";
                $extra['past'] = "んだ";
                $extra['te_form'] = "んで";
                break;
            case 'く':
                $extra['a'] = "か";
                $extra['i'] = "き";
                $extra['e'] = "け";
                $extra['o'] = "こ";
                $extra['past'] = "いた";
                $extra['te_form'] = "いて";
                break;
            case 'ぐ':
                $extra['a'] = "が";
                $extra['i'] = "ぎ";
                $extra['e'] = "げ";
                $extra['o'] = "ご";
                $extra['past'] = "いだ";
                $extra['te_form'] = "いで";
                break;
            case 'す':
                $extra['a'] = "さ";
                $extra['i'] = "し";
                $extra['e'] = "せ";
                $extra['o'] = "そ";
                $extra['past'] = "した";
                $extra['te_form'] = "して";
                break;
            default:
                break;
        }
        return $extra;
    }

    static function gen_verbs_inflections($verbs) {
        $all_verbs = array();
        foreach ($verbs as $verb) {
            $okurigana = $verb['okurigana'];
            $kanji = mb_substr($okurigana, 0, 1);
            $inflections = self::create_verb_inflections_array($verb);
            Helper::sort_array_by_values_length($inflections);
            if (!isset($all_verbs[$kanji])) {
                $all_verbs[$kanji] = array();
            }
            $inflections['meanings'] = $verb['meanings'];
            $inflections['id'] = $verb['id'];

            array_push($all_verbs[$kanji], $inflections);
        }
        return $all_verbs;
    }

    static function gen_adjs_inflections($adjs) {
        $all_adj = array();

        foreach ($adjs as $adj) {
            $okurigana = $adj['okurigana'];
            $kanji = mb_substr($okurigana, 0, 1);
            $inflections = self::create_adj_inflections_array($okurigana);
            Helper::sort_array_by_values_length($inflections);
            if (!isset($all_adj[$kanji])) {
                $all_adj[$kanji] = array();
            }
            $inflections['meanings'] = $adj['meanings'];
            $inflections['id'] = $adj['id'];
            array_push($all_adj[$kanji], $inflections);
        }
        return $all_adj;
    }

    static function create_adj_inflections_array($okurigana) {
        $inflections = array();
        $base = mb_substr($okurigana, 0, -1);

        $inflections['okurigana'] = $okurigana;
        $inflections['plain_polite'] = $okurigana . "です";
        $inflections['plain_neg'] = $base . "くない";
        $inflections['plain_neg_polite'] = $base . "くありません";
        $inflections['past'] = $base . "かった";
        $inflections['past_polite'] = $base . "かったです";
        $inflections['past_neg'] = $base . "くなかった";
        $inflections['past_neg_polite'] = $base . "くありませんでした";
        $inflections['past_neg_polite_alt'] = $base . "くなかったです";
        $inflections['te_form'] = $base . "くて";
        $inflections['te_form_neg'] = $base . "くなくて";
        $inflections['conditional'] = $base . "かったら";
        $inflections['conditional_neg'] = $base . "くなかったら";
        $inflections['provisional'] = $base . "ければ";
        $inflections['provisional_neg'] = $base . "くなければ";
        $inflections['adverbial'] = $base . "く";
        $inflections['nominalization'] = $base . "み";
        $inflections['nominalization_alt'] = $base . "さ";
        $inflections['surpass_plain'] = $base . "すぎる";
        $inflections['surpass_polite'] = $base . "すぎます";
        $inflections['surpass_polite_alt'] = $base . "すぎるです";
        $inflections['surpass_past'] = $base . "すぎた";
        $inflections['surpass_past_polite'] = $base . "すぎました";
        $inflections['surpass_te_form'] = $base . "すぎて";
        $inflections['surpass_noun_form'] = $base . "すぎ";
        return $inflections;
    }

    static function preg_replace_verbs($allverbs, &$text) {
        foreach ($allverbs as $kanji => $verbs) {
//            if (strpos($text, $kanji) !== FALSE) {
            foreach ($verbs as $verb) {
                $meaning = addslashes($verb['meanings']);
                $id = $verb['id'];
//                $furigana = $verb['furigana'];
                foreach ($verb as $key => $inflexion) {
                    if ($key != "meanings" && $key != "id" && $key != "furigana") {
                        $text = str_replace($inflexion, "<span title='$meaning' verb='$id' class='verbs highlight_verb'>$inflexion</span>", $text);

                        //                        $hiragana_form = $furigana . mb_substr($inflexion, 1);
                        //                        $text = str_replace($hiragana_form, "<span title='$meaning' verb='$id' class='verbs highlight_verb'>$hiragana_form</span>", $text);
                    }
                }
            }
//            }
        }
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

    static function preg_replace_jukugos($alljukugos, &$text) {
        $kanji = array();
        foreach ($alljukugos as $word) {
            $id = $word['id'];
            $okurigana = $word['jukugo'];
            if (!in_array($word['kanji'], $kanji)) {
                if (strpos($text, $word['kanji']) !== FALSE) {
                    $suffixes = self::gen_suffix($okurigana);
                    foreach ($suffixes as $suffix) {
                        $text = str_replace($suffix, "<span jukugo='$id' title='{$word['meanings']}' class='jukugo highlight_suffix'>{$suffix}</span>", $text);
                    }


                    $text = str_replace($word['jukugo'], "<span jukugo='$id' title='{$word['meanings']}' class='jukugo highlight_noun'>{$word['jukugo']}</span>", $text);
//                        $text = str_replace($word['plain'], "<span jukugo='$id' title='{$word['meanings']}' class='jukugo highlight_noun'>{$word['plain']}</span>", $text);
                } else {
                    array_push($kanji, $word['kanji']);
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

    static function gen_suffix($okurigana) {
        $suffixes = array();
        array_push($suffixes, $okurigana . "させていただいておりました");
        array_push($suffixes, $okurigana . "させていただいております");
        array_push($suffixes, $okurigana . "しておりませんでした");
        array_push($suffixes, $okurigana . "していませんでした");
        array_push($suffixes, $okurigana . "いただいております");
        array_push($suffixes, $okurigana . "いたしませんでした");
        array_push($suffixes, $okurigana . "になりませんでした");
        array_push($suffixes, $okurigana . "されませんでした");
        array_push($suffixes, $okurigana . "しておりません");
        array_push($suffixes, $okurigana . "しておりました");
        array_push($suffixes, $okurigana . "していました");
        array_push($suffixes, $okurigana . "しております");
        array_push($suffixes, $okurigana . "していません");
        array_push($suffixes, $okurigana . "してとります");
        array_push($suffixes, $okurigana . "いたしました");
        array_push($suffixes, $okurigana . "いたしません");
        array_push($suffixes, $okurigana . "になったんだ");
        array_push($suffixes, $okurigana . "になりました");
        array_push($suffixes, $okurigana . "になりません");
        array_push($suffixes, $okurigana . "しています");
        array_push($suffixes, $okurigana . "しなかった");
        array_push($suffixes, $okurigana . "いただいた");
        array_push($suffixes, $okurigana . "いたします");
        array_push($suffixes, $okurigana . "になります");
        array_push($suffixes, $okurigana . "されません");
        array_push($suffixes, $okurigana . "いただく");
        array_push($suffixes, $okurigana . "いただき");
        array_push($suffixes, $okurigana . "していた");
        array_push($suffixes, $okurigana . "している");
        array_push($suffixes, $okurigana . "しました");
        array_push($suffixes, $okurigana . "になった");
        array_push($suffixes, $okurigana . "されます");
        array_push($suffixes, $okurigana . "しない");
        array_push($suffixes, $okurigana . "されて");
        array_push($suffixes, $okurigana . "される");
        array_push($suffixes, $okurigana . "された");
        array_push($suffixes, $okurigana . "になる");
        array_push($suffixes, $okurigana . "により");

        array_push($suffixes, $okurigana . "される");
        array_push($suffixes, $okurigana . "された");
        array_push($suffixes, $okurigana . "されて");
        array_push($suffixes, $okurigana . "する");
        array_push($suffixes, $okurigana . "した");
        array_push($suffixes, $okurigana . "して");
        return $suffixes;
    }

}
