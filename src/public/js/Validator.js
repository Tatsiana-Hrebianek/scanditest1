class Validator {
    errormessage = new Map();

    disk = document.getElementById("Disk");
    book = document.getElementById("Book");
    furniture = document.getElementById("Furniture");
    selector = document.getElementById("type");

    // checkValidity() {
    //     this.properties.forEach(elem => {
    //         let error = document.querySelector(`#${elem.id}+span.error`);
    //         if (elem.validity.valueMissing) {
    //             // this.errormessage.set(`#${elem.id}`, `Please, insert ${elem.name}`);
    //             //this.error = document.querySelector(`#${elem.id}+span.error`);
    //             error.textContent = `Please, insert ${elem.name}`;
    //             return false;
    //         } else if (elem.validity.tooShort) {
    //             //this.errormessage.set(`#${elem.id}`, `The value should be at least ${elem.minLength}
    //             //characters you have inserted ${elem.value.length}.`);
    //             //this.error = document.querySelector(`#${elem.id}+span.error`);
    //             error.textContent = `!!!The value should be at least ${elem.minLength}
    //              characters you have inserted ${elem.value.length}.`;
    //             return false;
    //         } else if (elem.validity.patternMismatch) {
    //             //this.error = document.querySelector(`#${elem.id}+span.error`);
    //             error.textContent = `Please insert number`;
    //             // return false;
    //         } else if (elem.validity.rangeUnderflow) {
    //             error.textContent = `Value must be greater than 0`;
    //             return false;
    //         } else if (elem.validity.rangeOverflow) {
    //             error.textContent = `Value must be less than ${elem.max}`;
    //         } else {
    //             //this.error = document.querySelector(`#${elem.id}+span.error`);
    //             error.textContent = '';
    //             //console.log(this.errormessage);
    //
    //         }
    //
    //
    //     });
    // }
    //it's not extensible
    checkProductType() {
        //this.selector.addEventListener('change', (e) => {
        if (this.selector.value === 'Disk') {
            this.disk.className = 'form__item';
            this.errormessage.delete("#weight");
            this.errormessage.delete("#height");
            this.errormessage.delete("#length");
            this.errormessage.delete("#width");

            this.book.className = 'form__item--hidden';
            this.furniture.className = 'form__item--hidden';

        } else if (this.selector.value === 'Book') {
            this.book.className = 'form__item';
            this.errormessage.delete("#size");
            this.errormessage.delete("#height");
            this.errormessage.delete("#length");
            this.errormessage.delete("#width");

            this.disk.className = 'form__item--hidden';
            this.furniture.className = 'form__item--hidden';

        } else if (this.selector.value === 'Furniture') {
            this.furniture.className = 'form__item';
            this.errormessage.delete("#size");
            this.errormessage.delete("#weight");
            this.book.className = 'form__item--hidden';
            this.disk.className = 'form__item--hidden';
        }
        return this.errormessage;
        //});
    }

    //???adds sku error to the errormessage, but it isn't counted by Map.size() method...and is not shown await
    checkSKU() {
        //let error = document.querySelector('#sku+ span.error');
        // document.forms.product_form.onsubmit = (e) => {
        //     e.preventDefault();

        fetch('/js/db.php', {
            method: 'POST',
            body: new FormData(document.forms.product_form),
            //body: new FormData(this),
        }).then(
            response => {
                return response.text();
            }
        ).then(
            text => {

                this.errormessage.set("#sku", {required: text});
                //error.textContent = text;
            }
        );
    }


    handle(errormessagesAfterCheckProductType) {
        console.log(this.errormessage);
        if (this.errormessage.size !== 0) {


            this.errormessage.forEach((value, key) => {
                let error = document.querySelector(`${key}+span.error`);

                if (value.required) {
                    error.textContent = value.required;
                    console.log(value.required);
                }
                if (value.alphanumeric) {
                    error.textContent = value.alphanumeric;
                }
                if (value.maxlength) {
                    error.textContent = value.maxlength;
                }
                if (value.min) {
                    error.textContent = value.min;
                }
                if (value.max) {
                    error.textContent = value.max;
                }
                if (value.number) {
                    error.textContent = value.number;
                }


            });
        } else {
            console.log('there are no errors');
            //return false;
            //     document.forms.product_form.onsubmit = (form) => {
            //         form.submit();
            //     }
        }
    }

    clearErrorMessage(attribute) {
        let error = document.querySelector(`${attribute} + span.error`);
        error.textContent = '';
    }

    initInput(attribute) {
        let input = document.querySelector(`${attribute}`);
        return input;
    }


    isRequired(attribute, errormessage) {
        let input = this.initInput(attribute);
        input.setAttribute("required", "required");
        if (input.validity.valueMissing) {
            this.errormessage.set(attribute, {required: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }

    isAlphaNumeric(attribute, errormessage) {
        let input = this.initInput(attribute);
        input.setAttribute("pattern", "[A-Za-z]+[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(attribute, {alphanumeric: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }

    isNumber(attribute, errormessage) {
        let input = this.initInput(attribute);
        input.setAttribute("pattern", "[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(attribute, {number: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }

    isMin(attribute, errormessage, min) {
        let input = this.initInput(attribute);
        input.setAttribute("min", min);
        if (input.validity.rangeUnderflow) {
            this.errormessage.set(attribute, {min: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }

    isMax(attribute, errormessage, max) {
        let input = this.initInput(attribute);
        input.setAttribute("max", max);
        if (input.validity.rangeOverflow) {
            this.errormessage.set(attribute, {max: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }


    hasMax(attribute, errormessage) {
        let input = this.initInput(attribute);
        input.setAttribute("maxlength", "10");
        if (input.validity.tooLong) {
            this.errormessage.set(attribute, {maxlength: errormessage});
        } else {
            this.clearErrorMessage(attribute);
        }
    }


}


document.addEventListener("click", function (e) {
    let validator = new Validator();
    //validator.isRequired("#sku", "Please enter sku!");
    validator.isAlphaNumeric("#sku", "SKU must be alpha number");
    validator.hasMax("#sku", "SKU must be maximum 10 characters");

    validator.isRequired("#name", "Please enter name!");
    validator.isAlphaNumeric("#name", "Name must be alpha number");
    validator.hasMax("#name", "Name must be maximum 10 characters");

    validator.isRequired("#price", "Please enter price!");
    validator.isMin("#price", "Price should be at least 1$", 1);
    validator.isMax("#price", "Price should be maximum 1000$", 1000);
    validator.isNumber("#price", "Please provide the data of indicated type");

    validator.isRequired("#type", "Please choose product type!");

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
    validator.checkSKU();
    validator.handle(validator.checkProductType());

    if (validator.errormessage.size === 0) {
        document.forms.product_form.onsubmit = (product_form) => {
            product_form.submit();
        }
    } else {
        e.preventDefault();
    }

});

// document.addEventListener("submit", (e) => {
//
//     // console.log(validator.handle());
//     // e.preventDefault();
//     if (validator.errormessage.size === 0) {
//         console.log('there are no errors');
//         document.forms.product_form.onsubmit = (product_form) => {
//             product_form.submit();
//         }
//     } else {
//         console.log('there are errors');
//         e.preventDefault();
//     }
//
// });