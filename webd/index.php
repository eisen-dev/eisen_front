<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <link rel="stylesheet" type="text/css" href="sass/style.css">
</head>

<body>
    <div class="wrapper">
        <nav class="navigation">
            <div class="inner inner--navigation">
                <div class="navigation__title">
                    aaa
                </div>
                <div class="navigation__menu">
                </div>
            </div>
        </nav>
        <div class="contentswrapper">
            <main class="contents">
                <div class="inner">
                    Untitled Document
                     <?php echo '<p>Hello World</p>'; 
                     require "/includes/jsonRPCClient.php";
                     $server= new jsonRPCClient("http://$serveraddress:$port");
                     ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
