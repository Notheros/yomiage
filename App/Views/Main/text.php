<?php
$input = $_POST['text'];
//$oJisho = new Jisho();
//$oDict = new JAPANESE($text);
//$start = strtotime(date('Y-m-d H:i:s'));
//$all_words = $oJisho->get_words();
/**
 * nai está conjugando o verbo 1706
 */
//$oDict->analyse($all_words);
//$text = $oDict->place_words();
//$finish = strtotime(date('Y-m-d H:i:s'));
//echo $finish - $start . " segundos" . "<br><br>";
//echo $text;
$output = MECAB::mecab_it($input);
foreach ($output as $key => $word) {
    if (strpos($word, 'EOS') !== false) {
        echo "<br>";
    } else {
        echo  " [".$word . "] ";
    }
    
}
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


