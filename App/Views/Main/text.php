<?php
$result = NIHONGO::analyseText($_POST['text']);
foreach ($result as $value) {
    if (strpos($value['word'], 'EOS') === false) {
        echo "<ruby class='word {$value['type']}'><span class='japanese_word'>{$value['word']}</span><rt>{$value['furigana']}</rt></ruby>";
    } else {
        echo "<br>";
    }
}
?>


<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

    });
</script>
