const form = document.getElementsByTagName('form')[0];
const sku = document.getElementById("sku");
const name = document.getElementById("name");
const price = document.getElementById("price");
//??? need to learn!
const skuerror = document.querySelector('#sku + span.error');
const nameerror = document.querySelector('#name + span.error');
const priceerror = document.querySelector('#price + span.error');
const selectorerror = document.querySelector('#productType + span.error');
const selector = document.getElementById("productType");
const disk = document.getElementById("Disc");
const size = document.getElementById("size");
const sizeerror = document.querySelector('#size + span.error');
const book = document.getElementById("Book");
const weight = document.getElementById("weight");
const weighterror = document.querySelector('#weight + span.error');
const furniture = document.getElementById("Furniture");
const height = document.getElementById("height");
const heighterror = document.querySelector('#height + span.error');
const width = document.getElementById("width");
const widtherror = document.querySelector('#width + span.error');
const length = document.getElementById("length");
const lengtherror = document.querySelector('#length + span.error');

selector.addEventListener('change', function (e) {
    if (selector.value === 'Disc') {
        disk.className = 'form__item';
        size.setAttribute("required", "required");
        book.className = 'form__item--hidden';
        furniture.className = 'form__item--hidden';
        console.log(size);

    } else if (selector.value === 'Book') {
        book.className = 'form__item re';
        weight.setAttribute("required", "required");
        disk.className = 'form__item--hidden';
        furniture.className = 'form__item--hidden';
        console.log(size);

    } else if (selector.value === 'Furniture') {
        furniture.className = 'form__item';
        height.setAttribute("required", "required");
        length.setAttribute("required", "required");
        width.setAttribute("required", "required");
        book.className = 'form__item--hidden';
        disk.className = 'form__item--hidden';
    }
});


sku.addEventListener('input', function (e) {
    if (sku.validity.valid) {
        skuerror.textContent = '';
    } else {
        showError();
    }
});

name.addEventListener('input', function (e) {
    if (name.validity.valid) {
        nameerror.textContent = '';
    } else {
        showError();
    }
});

price.addEventListener('input', function (e) {
    if (price.validity.valid) {
        priceerror.textContent = '';
    } else {
        showError();
    }
});

selector.addEventListener('change', function (e) {
    if (selector.validity.valid) {
        selectorerror.textContent = '';
    } else {
        showError();
    }
});

height.addEventListener('input', function (e) {
    if (height.validity.valid) {
        heighterror.textContent = '';
    } else {
        showError();
    }
});

width.addEventListener('input', function (e) {
    if (width.validity.valid) {
        widtherror.textContent = '';
    } else {
        showError();
    }
});

length.addEventListener('input', function (e) {
    if (length.validity.valid) {
        lengtherror.textContent = '';
    } else {
        showError();
    }
});

weight.addEventListener('input', function (e) {
    if (weight.validity.valid) {
        weighterror.textContent = '';
    } else {
        showError();
    }
});

form.addEventListener('submit', function (e) {
    if (!sku.validity.valid || !name.validity.valid || !price.validity.valid || !selector.validity.valid ||
        !size.validity.valid || !weight.validity.valid || !height.validity.valid || !length.validity.valid ||
        !width.validity.valid) {
        showError();
        e.preventDefault();
    }
});

function showError() {
    if (sku.validity.valueMissing) {
        skuerror.textContent = 'Please, insert sku';
    } else if (sku.validity.tooShort) {
        skuerror.textContent = `SKU should be at least ${sku.minLength} characters;
        you entered ${sku.value.length}.`;
    } else if (name.validity.valueMissing) {
        nameerror.textContent = 'Please, insert name';
    } else if (name.validity.tooShort) {
        nameerror.textContent = `Name should be at least ${sku.minLength} characters;
        you entered ${sku.value.length}.`;
    } else if (price.validity.valueMissing) {
        priceerror.textContent = 'Please, insert price';
    } else if (selector.validity.valueMissing) {
        selectorerror.textContent = 'Please, check the type of product';
    } else if (size.validity.valueMissing) {
        sizeerror.textContent = 'Please, insert size';
    } else if (height.validity.valueMissing) {
        heighterror.textContent = 'Please, insert height';
    } else if (width.validity.valueMissing) {
        widtherror.textContent = 'Please, insert width';
    } else if (length.validity.valueMissing) {
        lengtherror.textContent = 'Please, insert length';
    } else if (weight.validity.valueMissing) {
        weighterror.textContent = 'Please, insert weight';
    }

};











