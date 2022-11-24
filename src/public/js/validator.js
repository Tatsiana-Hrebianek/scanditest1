class Validator {
    errormessage = new Map();
    product = new Map();
    selector = document.getElementById("productType");

    checkProductType() {
        if (this.selector.value) {
            for (let [key, value] of this.product) {
                const product = document.getElementById(key);
                if (this.selector.value !== key) {
                    product.className = 'form__item--hidden';
                    for (let i = 0; i <= value.length; i++) {
                        this.errormessage.delete(value[i]);
                    }
                }
                if (this.selector.value === key) {
                    product.className = 'form__item';
                }
            }
        }
        return (this.errormessage);

    }


    addProduct(productName, input_fields) {
        this.product.set(productName, input_fields);
    }

    // checkSKU(inputname, errormessage) {
    //
    //     const data = new FormData(document.forms.product_form);
    //     data.append('param', inputname);
    //     data.append('error', errormessage);
    //
    //     return fetch('/js/db.php', {
    //         method: 'POST',
    //         body: data,
    //     }).then(
    //         // if (response.ok) {
    //         response => {
    //             return response.text();
    //         }).then(
    //         text => {
    //             this.errormessage.set(inputname, text);
    //         }
    //     )
    // }

    checkSKU(inputname, errormessage) {
        const data = new FormData(document.forms.product_form);
        data.append('param', inputname);
        data.append('error', errormessage);
        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const obj = JSON.parse(xhr.response);
                if (obj.error1 !== "ok") {
                    this.errormessage.set(inputname, obj.error1);
                }

            }
        }

        xhr.open('POST', '/db', false);
        //xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.send(data);
    }


    handle(errormessagesAfterCheckProductType, func) {
        console.log(this.errormessage);
        let spanName = document.querySelectorAll(".error");
        spanName.forEach((elem) => {
            elem.innerHTML = "";
        });

        this.errormessage.forEach((value, key) => {
                let error = document.querySelector(`#${key}+span.error`);
                error.innerHTML = value;
            }
        );
    }


    initInput(selector) {
        let input = document.querySelector(`${selector}`);
        return input;
    }


    isRequired(selector, errormessage) {
        let input = this.initInput(selector);
        input.setAttribute("required", "required");
        if (input.validity.valueMissing) {
            this.errormessage.set(input.id, errormessage);
        }
    }

    isAlphaNumeric(selector, errormessage) {
        let input = this.initInput(selector);
        input.setAttribute("pattern", "[A-Za-z]+[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(input.id, errormessage);
        }
    }

    isNumber(selector, errormessage) {
        let input = this.initInput(selector);
        input.setAttribute("pattern", "[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(input.id, errormessage);
        }
    }

    isMin(selector, errormessage, min) {
        let input = this.initInput(selector);
        input.setAttribute("min", min);
        if (input.validity.rangeUnderflow) {
            this.errormessage.set(input.id, errormessage);
        }
    }

    isMax(selector, errormessage, max) {
        let input = this.initInput(selector);
        input.setAttribute("max", max);
        if (input.validity.rangeOverflow) {
            this.errormessage.set(input.id, errormessage);
        }
    }


    hasMax(selector, errormessage) {
        let input = this.initInput(selector);
        input.setAttribute("maxlength", "10");
        if (input.validity.tooLong) {
            this.errormessage.set(input.id, errormessage);
        }
    }


}


document.addEventListener("click", function (e) {
    let validator = new Validator();

    validator.isRequired("#sku", "Please enter SKU!");
    validator.isAlphaNumeric("#sku", "SKU must be alpha number");
    validator.hasMax("#sku", "SKU must be maximum 10 characters");

    validator.isRequired("#name", "Please enter name!");
    validator.isAlphaNumeric("#name", "Name must be alpha number");
    validator.hasMax("#name", "Name must be maximum 10 characters");

    validator.isRequired("#price", "Please enter price!");
    validator.isMin("#price", "Price should be at least 1$", 1);
    validator.isMax("#price", "Price should be maximum 1000$", 1000);
    validator.isNumber("#price", "Please provide the data of indicated type");

    validator.isRequired("#productType", "Please choose product type!");

    validator.isRequired("#size", "Please enter size!");
    validator.isNumber("#size", "Please provide the data of indicated type");
    validator.isMin("#size", "Value must be greater than 0", 1);


    validator.isRequired("#weight", "Please enter weight!");
    validator.isNumber("#weight", "Please provide the data of indicated type");
    validator.isMax("#weight", "Value must be less than 1001", 1001);
    validator.isMin("#weight", "Value must be greater than 0", 1);

    validator.isRequired("#height", "Please enter height");
    validator.isNumber("#height", "Please provide the data of indicated type");
    validator.isMin("#height", "Value must be greater than 0", 1);
    validator.isRequired("#length", "Please enter length");
    validator.isNumber("#length", "Please provide the data of indicated type");
    validator.isMin("#length", "Value must be greater than 0", 1);
    validator.isRequired("#width", "Please enter width");
    validator.isNumber("#width", "Please provide the data of indicated type");
    validator.isMin("#width", "Value must be greater than 0", 1);
    validator.addProduct("Furniture", ["height", "width", "length"]);
    validator.addProduct("Book", ["weight"]);
    validator.addProduct("Disc", ["size"]);
    validator.checkSKU("sku", "This SKU already exists, please enter another SKU");
    validator.handle(validator.checkProductType());


    if (validator.errormessage.size === 0) {
        document.forms.product_form.onsubmit = (product_form) => {
            product_form.submit();
        }
    } else {
        e.preventDefault();
    }

});
