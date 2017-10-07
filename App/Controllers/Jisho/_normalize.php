<?php

set_time_limit(0);
$oJisho = new Jisho();

$array = $oJisho->get_jukugo_limit();
$nope = array();
foreach ($array as $value) {
    $url = "http://jisho.org/api/v1/search/words?keyword=" . $value['jukugo'];
    $jisho = json_decode(Helper::get_data_from($url), true);
    $is_common = isset($jisho['data'][0]['is_common']) ? $jisho['data'][0]['is_common'] : 0;
//    $type = $jisho['data'][0]['senses'][0]['parts_of_speech'][0];
//    $predication = $jisho['data'][0]['senses'][0]['parts_of_speech'][1];
    $reading = $jisho['data'][0]['japanese'][0]['reading'];
    $word = $jisho['data'][0]['japanese'][0]['word'];

    if ($reading == $value['plain']) {
        $meanings = "";
        $types = "";
        foreach ($jisho['data'][0]['senses'] as $key => $sense) {
            $meanings .= addslashes(implode(",", $sense['english_definitions'])) . ";";
            $types .= addslashes(implode(",", $sense['parts_of_speech'])) . ";";
        }

        $oJisho->update_jukugo($value['id'], $is_common, $types, $meanings);
    } else {
        $value['reading'] = $reading;
        $value['word'] = $word;

        array_push($nope, $value);
    }
}

Helper::prettyPrint($nope);




die('finish');

$start = strtotime(date('Y-m-d H:i:s'));
//(length plain - (length_kanji - 1))
//$verbs = $oJisho->get_all_adjectives();
//
//foreach ($verbs as $key => $verb) {
//    foreach ($verb as $conj => $word) {
//        if ($conj != "okurigana" && $conj != "plain" && $conj != "id" && $conj != "type") {
//            $kanji = mb_substr($verb['okurigana'], 0, 1);
////
//            $length_okurigana = mb_strlen($verb['okurigana']);
//            $length_plain = mb_strlen($verb['plain']);
//            $remove_from_plain_size = $length_plain - ($length_okurigana - 1);
//            $word_exploded = explode("、", $word);
//
//            foreach ($word_exploded as $key => $word_e) {
//                $word_exploded[$key] = $kanji . mb_substr($word_e, $remove_from_plain_size);
//            }
//            $new_word = implode(',', $word_exploded);
//            $oJisho->update_verb($conj, $new_word, $verb['id']);
//        }
//    }
//}
//
//$finish = strtotime(date('Y-m-d H:i:s'));
//
//echo $finish - $start . " segundos" . "<br><br>";



//$verbs = $oJisho->get_all_adjectives();
//foreach ($verbs as $value) {
//    $main_form = mb_substr($value['okurigana'], 0, -1);
//    $new = $main_form . "すぎ";
//
//    $oJisho->insert_conjugation($value['id'], "surpass_noun_form", $new);
//}


//die();