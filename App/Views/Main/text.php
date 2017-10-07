<?php

$oJisho = new Jisho();
$start = strtotime(date('Y-m-d H:i:s'));
$allcompoundverbs = Japanese::gen_verbs_inflections($oJisho->get_all_compound_verbs());
$allverbs = Japanese::gen_verbs_inflections($oJisho->get_all_verbs());

$alladjs = Japanese::gen_adjs_inflections($oJisho->get_all_adjectives());
$alljukugos = $oJisho->get_all_jukugos();
$allnouns = $oJisho->get_all_nouns();
$text = $_POST['text'];

/**
 * nai está conjugando o verbo 1706
 */

Japanese::preg_replace_jukugos($alljukugos, $text);

Japanese::preg_replace_nouns($allnouns, $text);
Japanese::preg_replace_verbs($allcompoundverbs, $text);

Japanese::preg_replace_verbs($allverbs, $text);
Japanese::preg_replace_adjs($alladjs, $text);


$finish = strtotime(date('Y-m-d H:i:s'));
echo $finish - $start . " segundos" . "<br><br>";
echo $text;
?>



<script>

    $(document).ready(function () {
        var HOVER_ID = 0;
        var ELEMENT_ID = 0;

        $(".adjs").on({
            mouseenter: function () {
                HOVER_ID = $(this).attr("adj");
                $(".adjs").each(function (key, value) {
                    ELEMENT_ID = $(this).attr("adj");
                    if (HOVER_ID === ELEMENT_ID) {
                        $(this).addClass("highlight_hover");
                    }
                });
            },
            mouseleave: function () {
                $(".adjs").each(function (key, value) {
                    $(this).removeClass("highlight_hover");
                });
            }
        });


        $(".verbs").on({
            mouseenter: function () {
                HOVER_ID = $(this).attr("verb");
                $(".verbs").each(function (key, value) {
                    ELEMENT_ID = $(this).attr("verb");
                    if (HOVER_ID === ELEMENT_ID) {
                        $(this).addClass("highlight_hover");
                    }
                });
            },
            mouseleave: function () {
                $(".verbs").each(function (key, value) {
                    $(this).removeClass("highlight_hover");
                });
            }
        });

        $(".nouns").on({
            mouseenter: function () {
                HOVER_ID = $(this).attr("noun");
                $(".nouns").each(function (key, value) {
                    ELEMENT_ID = $(this).attr("noun");
                    if (HOVER_ID === ELEMENT_ID) {
                        $(this).addClass("highlight_hover");
                    }
                });
            },
            mouseleave: function () {
                $(".nouns").each(function (key, value) {
                    $(this).removeClass("highlight_hover");
                });
            }
        });


        $(".jukugo").on({
            mouseenter: function () {
                HOVER_ID = $(this).attr("jukugo");
                $(".jukugo").each(function (key, value) {
                    ELEMENT_ID = $(this).attr("jukugo");
                    if (HOVER_ID === ELEMENT_ID) {
                        $(this).addClass("highlight_hover");
                    }
                });
            },
            mouseleave: function () {
                $(".jukugo").each(function (key, value) {
                    $(this).removeClass("highlight_hover");
                });
            }
        });

    });
</script>


