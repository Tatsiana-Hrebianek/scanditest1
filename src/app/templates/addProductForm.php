<!DOCTYPE html>
<html>
<head>
    <title>Product Add form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" type="text/css" href="/css/style.css"/>
</head>
<body>
<form action="/" method="POST" name="product_form" id="product_form">
    <header class="main-header">
        <h1 class="main-header__title">
            Product Add
        </h1>
        <a href="/" class="main-header__btn main-header__btn--cancel">Cancel</a>
        <input type="submit" form="product_form" name="save_button" id="save_button" value="Save"
               class="main-header__btn main-header__btn--save">
    </header>
    <main class="form">
        <div class="form__item">
            <label class="form__item-label" for="sku">SKU</label>
            <input class="form__item-input" type="text" id="sku" name="sku" placeholder="SKU">
        </div>
        <div class="form__item">
            <label class="form__item-label" for="name">Name</label>
            <input class="form__item-input" type="text" id="name" name="name" placeholder="the name of product">
        </div>
        <div class="form__item">
            <label class="form__item-label" for="price">Price, $</label>
            <input class="form__item-input" type="text" id="price" name="price" placeholder="price">
        </div>
        <div class="form__item">
            <label class="form__item-label">Type Switcher</label>
            <select name="type" id="productType" class="required form__item-input">
                <option value="" hidden>Type Switcher</option>
                <option value="Disc">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
        </div>
        <div id="Disc" class="data form__item form__item--hidden">
            <label class="form__item-label">Size (MB) </label>
            <input class="form__item-input" type="text" id="size" name="size" placeholder="size">
            <p>Please, provide disc space in MB</p>
        </div>
        <div id="Furniture" class="data form__item form__item--hidden">
            <div class="form__item">
                <label class="form__item-label">Height (CM) </label>
                <input class="form__item-input" type="text" id="height" name="height" placeholder="height">
            </div>
            <div class="form__item">
                <label class="form__item-label">Width (CM) </label>
                <input class="form__item-input" type="text" id='width' name="width" placeholder="width">
            </div>
            <div class="form__item">
                <label class="form__item-label">Length (CM) </label>
                <input class="form__item-input" type="text" id="length" name="length" placeholder="length">
                <div>Please, provide furniture height, width, length in CM</div>
            </div>
        </div>
        <div id="Book" class="data form__item form__item--hidden">
            <div class="form__item">
                <label class="form__item-label">Weight (KG) </label>
                <input class="form__item-input" type="text" id='weight' name="weight" placeholder="weight">
                <div>Please, provide book weight in KG</div>
            </div>
        </div>
    </main>
</form>
<footer class="main-footer__bottom-text">
    <div>Scandiweb Test assignment</div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script defer src="/js/validator.js"></script>
</body>