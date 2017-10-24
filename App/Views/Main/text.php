<?php
$input = $_POST['text'];
$mMecab = new MECAB();
$output = $mMecab->mecab_it($input);
foreach ($output as $key => $word) {
    if (strpos($word, 'EOS') !== false) {
        echo "<br>";
    } else {
        echo $word . " ";
    }
}
?>

<style>
    .particle {
        background: greenyellow;
    }
    .verb {
        background: blue;
        color: white;
    }
    .noun{
        background: purple;
        color: white;
    }
</style>



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


