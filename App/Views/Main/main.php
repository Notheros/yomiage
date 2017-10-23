<div class="container-fluid">


    <div id="start" class="col-md-8 col-md-offset-2">
        <!--<div class="jumbotron">-->
        <h1><small>Prototype</small></h1>
        <textarea class="form-control" rows="8" >今後とも皆様に安心してお取引いただける環境の構築に努めますので、引き続きよろしくお願いいたします。</textarea>
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
//            $("#start").hide();
            $("#text").load("text", {text: text});
        });

        if (!window.x) {
            x = {};
        }
        x.Selector = {};
        x.Selector.getSelected = function () {
            var t = '';
            if (window.getSelection) {
                t = window.getSelection();
            } else if (document.getSelection) {
                t = document.getSelection();
            } else if (document.selection) {
                t = document.selection.createRange().text;
            }
            return t;
        }



        $(document).keydown(function (e) {
            if (e.shiftKey) {
                var mytext = x.Selector.getSelected();
                $.get("_search_jisho?word=" + mytext, function (data) {
                    alert(data);
                });
            }
        });
    });

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    $.ctrl = function (key, callback, args) {
        var isCtrl = false;
        $(document).keydown(function (e) {
            if (!args)
                args = []; // IE barks when args is null

            if (e.ctrlKey)
                isCtrl = true;
            if (e.keyCode == key.charCodeAt(0) && isCtrl) {
                callback.apply(this, args);
                return false;
            }
        }).keyup(function (e) {
            if (e.ctrlKey)
                isCtrl = false;
        });
    };

</script>

