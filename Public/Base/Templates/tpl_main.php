
<!DOCTYPE html>
<html>
    <?php include './Public/Base/Head.php' ?>
    <body>
        <?php include 'Public/Base/Navbar.php' ?>
        <!-- Page -->
        <div id="content_load" class="page-content">
            <?php include $request['conteudo'] ?>
        </div>
        <!-- End Page -->
        <?php // include 'Public/Base/Footer.php' ?>
        <?php include 'Public/Base/Scripts.php' ?>
    </body>
</html>