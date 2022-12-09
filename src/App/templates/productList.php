<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if (isset($title)) echo $title ?></title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form method="POST" action='/'>
    <header class="main-header">
        <h1 class="main-header__title">
            <?php if (isset($title)): ?>
                <?= $title ?>
            <?php endif; ?>
        </h1>
        <a class="main-header__btn main-header__btn--add" href="/addProduct">ADD</a>
        <button class="main-header__btn main-header__btn--delete" id='delete-product-button'> MASS DELETE</button>
    </header>
    <main class="wrapper">
        <?php if (isset($product)) {
            foreach ($product as $elem): ?>
                <div class="wrapper__bblock">
                    <div class="wrapper__bblock-checkbox">
                        <input type="checkbox" name="sku[]" value="<?= $elem->getSKU() ?>">
                    </div>
                    <div class="wrapper__block-item">
                        <?= $elem->getSKU() ?>
                    </div>
                    <div class="wrapper__block-item">
                        <?= $elem->getName() ?>
                    </div>
                    <div class="wrapper__block-item">
                        <?php echo number_format($elem->getPrice(), 2) ?>
                    </div>
                    <div class="wrapper__block-item">
                        <?php if (method_exists($elem, 'getSize')) { ?>
                            Size: <?php echo $elem->getSize(); ?> MB<br>
                        <?php }
                        if (method_exists($elem, 'getWeight')) { ?>
                            Weight: <?php echo $elem->getWeight(); ?> KG<br>
                        <?php }
                        if (method_exists($elem, 'getLength') && method_exists($elem, 'getWidth') && method_exists($elem, 'getHeight')) { ?>
                            Dimension: <?php echo $elem->getLength(); ?>x<?php echo $elem->getWidth(); ?>x<?php echo $elem->getHeight(); ?> CM
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach;
        } ?>
    </main>
</form>
<footer class="main-footer__bottom-text">
    <div>Scandiweb Test assignment</div>
</footer>
</body>
</html>