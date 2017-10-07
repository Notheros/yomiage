
<style>
/*    body{
        background: black;
    }*/
</style>
<div class="container-fluid">


    <!--TEXTO ALEATORIO-->
    <div id="start" class="col-md-8 col-md-offset-2">
        <!--<div class="jumbotron">-->
        <h1><small>Easier to read and study Japanese</small></h1>
        <p><small>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</small></p>
        <textarea class="form-control" rows="8" >いつも bitFlyer をご利用いただきありがとうございます。
 
昨今の仮想通貨に関連した金融機関等のお取引において、仮名取引・借名取引(※1)等の違法行為や不公正取引等が発生しております。当社では、皆様に安心してお取引いただくために、仮名・借名取引等の違法行為や不公正取引等の有無について日々のお取引やご注文を調査しています。違法行為や不公正取引等に関与した、またはその恐れがあると思われるお客さまには当社より事情のご確認、またはアカウント閉鎖、もしくはお取引制限等を実施させていただいております。
 
この度、当社サービスのセキュリティ向上の観点からクイック入金利用時の日本円出金・仮想通貨送付等において下記制限を導入いたしました。売買取引については今までと変更ございません。
 
以下制限サービスの出金可能額は下記（Z）に制限されます。
 
【制限サービス】
・日本円ご出金
・仮想通貨ご送付
・bitWire
・ビットコインをつかう
・Pay
 
【クイック入金利用時の日本円出金・仮想通貨送付等可能額算出式】
（X）お客様の総資産：制限サービスご利用時点
   = (保有仮想通貨数量 × 当該仮想通貨の時価(※2 ) ÷ 1.3) + 保有日本円額
（Y）制限サービスご利用時点から遡って 7 日間のクイック入金合計額
（Z）出金可能額
   ＝（X） ー （Y）
状況により、制限が適用されるタイミングに差異が生じる可能性があります。
 
（※1）「仮名取引」および「借名取引」とは、架空の名義や他人の名義などを使用した取引をいいます。当社ではお客さまのログイン情報はご本人様の責任により厳格に管理いただくことをお願いするとともに、ご本人様以外の方のご使用をお断りさせていただきます。なお、アカウント登録者以外の方が取引を行っている疑いがある場合には、法令等に基づきお客さまへの確認を実施させていただいております。
 
（※2）
BTC：ビットコイン販売所の仲値
ETH：Lightning ETH/BTC の最終取引価格 × ビットコイン販売所の仲値
 
当社では、これらの対応を図ることにより仮想通貨取引市場の健全な発展に貢献して参ります。ご不便をおかけしますが、今後とも皆様に安心してお取引いただける環境の構築に努めますので、引き続きよろしくお願いいたします。</textarea>

        <br>

        <p><a id="start_reading" class="btn btn-block btn-default btn-lg pull-right">Start my reading</a></p>

        <!--</div>-->
    </div>
    <div  class="col-md-12" style="">
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

