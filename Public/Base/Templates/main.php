<!DOCTYPE html>
<html>
    <?php include 'Public/Base/Head.php'; ?>
    <body>
        <!--<div class="wrapper">-->
            <?php // include 'Public/Base/Sidebar.php'; ?>
            <!-- Page Content Holder -->
            <div id="">
                <?php // include 'Public/Base/Navbar.php'; ?>
                <?php include $request['conteudo']; ?>
            </div>
        <!--</div>-->
    </body>
    <?php include 'Public/Base/Scripts.php'; ?>
</html>