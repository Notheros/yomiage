<div class="container-fluid">


    <div id="start" class="col-md-8 col-md-offset-2">
        <!--<div class="jumbotron">-->
        <h1><small>Prototype</small></h1>
        <textarea class="form-control" rows="8" >朝という漢字の左の部品は「草」に似ています。真ん中に「日」があります。右の部品は「月」です。つまり「朝」は東の方の草の間から日が昇り、西の方の草むらの月が沈む様子を表すことによって、朝を意味しているのです。</textarea>
        <br>

        <p><a id="start_reading" class="btn btn-block btn-success btn-lg pull-right">Start</a></p>

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




<script>
    $(document).ready(function () {
        $("#start_reading").on("click", function () {
            var text = $("textarea").val();
            $("#text").load("text", {text: text});
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

