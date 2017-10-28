<?php

$oJisho = new Jisho();
$user_word = $_GET['word'];
$jisho = json_decode(FUNCTIONS::get_data_from("http://jisho.org/api/v1/search/words?keyword=" . $user_word . ""), true);
$result['verbs'] = 0;
$result['nouns'] = 0;
$data = $jisho['data'];
foreach ($data as $key => $value) {

    $is_common = isset($value['is_common']) ? $value['is_common'] : 0;
    $plain = $value['japanese'][0]['reading'];
    $okurigana = isset($value['japanese'][0]['word']) ? $value['japanese'][0]['word'] : $plain;
    $senses = $value['senses'];

    $meanings = "";
    $types = "";
   
    foreach ($senses as $key => $sense) {
      
        $kana_alone = 0;
        $meanings .= addslashes(implode(",", $sense['english_definitions'])) . ";";
        $types .= addslashes(implode(",", $sense['parts_of_speech'])) . ";";
        $tags .= addslashes(implode(",", $sense['tags'])) . ";";
        if (strpos($tags, 'kana alone') !== false) {
            $kana_alone = 1;
        }
    }

    /**
     * PRECISA GRAVAR ADVERBIOS E EXPRESSOES
     */
//    if (strpos($types, 'Noun') !== false || strpos($types, 'noun') !== false) {
//        
//    }
    if (strpos($types, ' Verb ') !== false || strpos($types, ' verb ') !== false) {
        $result['verbs'] ++;
        $types = $senses[0]['parts_of_speech'][0];
        $predication = $senses[0]['parts_of_speech'][1];
        $oJisho->insert_verb($okurigana, $plain, $types, $is_common, $predication, $meanings);
    } else {
        $result['others'] ++;
        if (Japanese::is_jukugo($okurigana)) {
            $kanji = mb_substr($okurigana, 0, 1);
            $oJisho->insert_jukugo($kanji, $okurigana, $plain, $types, $meanings, $is_common);
        } else {
            $new_id = $oJisho->insert_noun($okurigana, $plain, $types, $meanings, $is_common,$kana_alone);
        }
    }
}

FUNCTIONS::prettyPrint($result);



