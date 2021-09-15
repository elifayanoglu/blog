<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>Site başlığı</header>
    <nav>
        <ul>
            <li><a href="/cms2/">home</a></li>
            <li><a href="/cms2/categories">categories</a></li>
            <li><a href="">content</a></li>
        </ul>
    </nav>

    <?=$this->section('content')?>

    <footer>
        tüm hakları sakldır
    </footer>
</body>
</html>