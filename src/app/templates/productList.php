<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if (isset($title)) echo $title ?></title>
    <meta charset="utf-8">
    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<form method="POST" action='/'>
    <header class="main-header">
        <h1 class="main-header__title">
            Product list
        </h1>
        <a class="main-header__btn main-header__btn--add" href="/addProduct">ADD</a>
        <button class="main-header__btn main-header__btn--delete" id='delete-product-button'> MASS DELETE</button>
    </header>
    <main class="wrapper">
        <?php
        for ($i = 0; $i <= 10; $i++) {
            echo '<div class="wrapper__bblock">
                <div class="wrapper__bblock-checkbox">                
                <input type="checkbox" name="sku[]" value="">
                </div>
                <div class="wrapper__block-item">
                SKU
                </div>
                <div class="wrapper__block-item">
                Book
                </div>
                <div class="wrapper__block-item">
                20$
                </div>
                <div class="wrapper__block-item">
                Size: 300 MB
                </div>
            </div>';
        }
        ?>
    </main>
</form>
<footer class="main-footer__bottom-text">
    <div>Scandiweb Test assignment</div>
</footer>
</body>
</html>