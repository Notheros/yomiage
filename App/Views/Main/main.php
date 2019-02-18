<ul style="color: black">
    <!--<li>Corrigir furigana das palavras</t>-->
    <li>Criar funções de conjugação de ichidan e godan</li>

    <li>Adicionar busca de significado em uma div</li>
    <li>Criar regra nai-de</li>
    <li>Tooltip com o tipo (e tbm a conjugacao, caso verbo)</li>
    <li>Destacar nomes com outra cor</li>

</ul>

<div class="container-fluid">
    <input type="checkbox" value="1" id="show_furigana" checked=""> Furigana

    <div id="start" class="col-md-8 col-md-offset-2">
        <!--<div class="jumbotron">-->
        <h1><small>Prototype</small></h1>
        <textarea class="form-control" rows="8" >知られており、生魚を食する日本では欠かせない存在となっています。</textarea>
        <br>
            <input type="checkbox" value="1" id="print" checked=""> Print

        <button id="start_reading" class="btn btn-block btn-success btn-lg pull-right">start</button>
        <!--<p><a id="" >Start</a></p>-->

        <!--</div>-->
    </div>
    <div  class="col-md-10 col-md-offset-1" style="">
        <br><br>
        <div id="jisho"></div>
        <br><br>
        <div id="text" style="text-align: justify; color: black; font-size: 24px; line-height: 50px;">

        </div>
    </div>
</div>
<br><br>

<?php 

// $inf = GRAMMAR::create_ichidan_inflections("食べる", "たべる");
// FUNCTIONS::prettyPrint($inf);
?>

<script>
    $(document).ready(function () {

        $("#start_reading").on("click", function () {
            var text = $("textarea").val();
            var print = 0;
            if ($("#print").is(":checked")) {
                print = 1;
            }

            $("#text").load("text", {text: text, print: print});
        });
        $("#show_furigana").on("click", function () {
            if ($(this).is(':checked')) {
                $("rt").show();
            } else {
                $("rt").hide();
            }
        });

        $("#text").on("click", ".japanese_word", function () {
            var word = $(this).html();

            $.post("_search_jisho", {word: word}, function (response) {
                var jisho = JSON.parse(response);
                console.log(jisho.data[0].senses[0].english_definitions[0]);
            });

        });
    });

//    function isJson(str) {
//        try {
//            JSON.parse(str);
//        } catch (e) {
//            return false;
//        }
//        return true;
//    }



</script>

