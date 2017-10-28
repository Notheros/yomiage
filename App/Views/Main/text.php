<?php
//$html = file_get_contents("https://whatjapanthinks.com/");
//var_dump($html);
$input = $_POST['text'];
$mMecab = new JAPANESE();
$mJisho = new Jisho();
$output = $mMecab->mecab_it($input);
//Helper::prettyPrint($output);
foreach ($output as $key => $dict) {
    if (strpos($dict['word'], 'EOS') !== false) {
        echo "<br>";
    } else {
//        $t = $mJisho->get_word($dict['word']);
        echo "<span data-container='body' data-toggle='tooltip' title='{$dict['reading']} {$dict['dict_form']}' class='word {$dict['class']}'>{$dict['word']}</span>";
    }
}
?>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
