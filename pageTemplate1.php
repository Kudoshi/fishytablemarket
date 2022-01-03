<!-- Template for a new file
1. Put the normal syntax and elements (e.g. head, doctype)

IN HEAD:
2. require import_headInfo

IN BODY:
3. require header.php at the start
4. require footer.php at the end 

-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Header/footer usage</title>

    <!-- You can more stuff here if you want -->
    <?php require "import_headInfo.php"; ?>
</head>
<body>
    <?php require "header.php"; ?>

    <br><br><br>

    Hello some sample content
    <br>
    <br>
    <br>
    Yes. Some content btw.
    <br><br><br><br><br><br>


    <?php require "footer.php";?>
</body>
</html>