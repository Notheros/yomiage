<?php

class Jisho {

    private $conn;

    function __construct() {
        $this->conn = Connection::getInstance();
    }

    function get_verb_infleddddctions($verb, $dan) {
        $ending = mb_substr($verb, -1);
        $query = "
            SELECT inflection, description FROM ssstb_verb_inflection WHERE ending = '{$ending}' AND dan = '{$dan}'
        ";
        $this->conn->executeQuery($query);
        $inflections = $this->conn->getArrayFromResult();
        return $inflections;
    }

    function get_words() {
        $query = "
            
(
	SELECT
		id,
		jukugo AS word,
		meanings,
		plain,
		type,
		'jukugo' AS ctg
	FROM
		tb_jukugo
	GROUP BY
		jukugo
)
UNION 
	(SELECT id, if(kana_alone = 0, okurigana, plain) AS word, meanings, plain, type, 'word' AS ctg FROM tb_words)


UNION
(
SELECT 
               id,
                okurigana AS word,
                meanings,
								plain,
							type,
							'adj' AS ctg
            FROM tb_adjectives
                )

                UNION
                (
                SELECT
                                id,
                                okurigana AS word, 
                                                meanings,

                                plain,
                type,
                'verb' AS ctg
                            FROM tb_verbs 
                            WHERE (type = 'v1' OR type = 'v5' OR type = 'vsi')
                            GROUP BY tb_verbs.id
                )

                ORDER BY
	LENGTH(word) DESC
        ";
        $this->conn->executeQuery($query);
        $jukugos = $this->conn->getArrayFromResult();
        return $jukugos;
    }

    function get_all_verbs() {
        $query = "
            SELECT
                tb_verbs.id,
                okurigana, 
                type,
                plain,
                meanings
            FROM tb_verbs 
            WHERE (type = 'v1' OR type = 'v5' OR type = 'vsi') AND compound = 0
            GROUP BY tb_verbs.id
        ";
        $this->conn->executeQuery($query);
        $verbs = $this->conn->getArrayFromResult();
        return $verbs;
    }

    function get_all_compound_verbs() {
        $query = "
            SELECT
                tb_verbs.id,
                okurigana, 
                type,
                meanings,
                plain
            FROM tb_verbs 
            WHERE (type = 'v1' OR type = 'v5') AND compound = 1
            GROUP BY tb_verbs.id
        ";
        $this->conn->executeQuery($query);
        $verbs = $this->conn->getArrayFromResult();
        return $verbs;
    }

    function get_all_adjectives() {
        $query = "
            SELECT 
                tb_adjectives.id,
                okurigana,
                meanings
            FROM tb_adjectives
            GROUP BY id

        ";
        $this->conn->executeQuery($query);
        $jukugos = $this->conn->getArrayFromResult();
        return $jukugos;
    }

    function get_all_nouns() {
        $query = "
            SELECT 
                id,
                okurigana,
                plain,
                meanings,
                type,
                kana_alone
            FROM tb_words
            GROUP BY id
            ORDER BY LENGTH(okurigana) DESC

        ";
        $this->conn->executeQuery($query);
        $jukugos = $this->conn->getArrayFromResult();
        return $jukugos;
    }

    function get_jukugo_limit() {
        $query = "SELECT id, jukugo, plain FROM tb_jukugo WHERE meanings = ''";
        $this->conn->executeQuery($query);
        $verbs = $this->conn->getArrayFromResult();
        return $verbs;
    }

    function update_adj($id, $meanings) {
        $query = "
            UPDATE tb_adjectives SET meanings = '{$meanings}'
            WHERE id = '{$id}'
        ";
        $this->conn->executeQuery($query);
    }

    function update_verb($id, $meanings) {
        $query = "
            UPDATE tb_verbs SET meanings = '{$meanings}'
            WHERE id = '{$id}'
        ";
        $this->conn->executeQuery($query);
    }

    function update_jukugo($id, $is_common, $type, $meanings) {
        $query = "
            UPDATE tb_jukugo SET is_common = '{$is_common}', type = '{$type}', meanings = '{$meanings}'
            WHERE id = '{$id}'
        ";
        $this->conn->executeQuery($query);
    }

    function insert_noun_meaning($id_noun, $occurrence, $meaning) {
        $query = "INSERT INTO nouns_meaning (fk_noun, occurrence, meaning) VALUES('{$id_noun}', '{$occurrence}', '{$meaning}')";
        $this->conn->executeQuery($query);
    }

    function insert_noun($okurigana, $plain, $type, $meanings, $is_common, $kana_alone) {
        $query = "INSERT INTO tb_words (okurigana, plain, type, meanings, is_common, kana_alone) VALUES('{$okurigana}', '{$plain}', '{$type}', '{$meanings}','{$is_common}', '{$kana_alone}')";
        $this->conn->executeQuery($query);
        return $this->conn->lastId();
    }

    function insert_jukugo($kanji, $okurigana, $plain, $type, $meanings, $is_common) {
        $query = "INSERT INTO tb_jukugo (kanji, jukugo, plain, type, meanings, is_common)
                VALUES('{$kanji}','{$okurigana}', '{$plain}', '{$type}', '{$meanings}','{$is_common}')";
        $this->conn->executeQuery($query);
        return $this->conn->lastId();
    }

    function insert_verb_meaning($id_verb, $occurrence, $meaning) {
        $query = "INSERT INTO verbs_meaning (fk_verb, occurrence, meaning) VALUES('{$id_verb}', '{$occurrence}', '{$meaning}')";
        $this->conn->executeQuery($query);
    }

    function insert_verb($okurigana, $plain, $type, $is_common, $predication, $meanings) {
        $query = "INSERT INTO tb_verbs (okurigana, plain, type, is_common, predication, meanings) VALUES('{$okurigana}', '{$plain}', '{$type}', '{$is_common}', '{$predication}', '{$meanings}')";
        $this->conn->executeQuery($query);
        return $this->conn->lastId();
    }

}
