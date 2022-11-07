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
    checkProductType() {
        //this.selector.addEventListener('change', (e) => {
        if (this.selector.value === 'Disk') {
            this.disk.className = 'form__item';
            this.isRequired("#size", "Please enter size!");
            this.isNumber("#size", "Please provide the data of indicated type");
            this.isMin("#size", "Value must be greater than 0", 1);
            this.book.className = 'form__item--hidden';
            this.furniture.className = 'form__item--hidden';

        } else if (this.selector.value === 'Book') {
            this.book.className = 'form__item';
            this.isRequired("#weight", "Please enter weight!");
            this.isNumber("#weight", "Please provide the data of indicated type");
            this.isMax("#weight", "Value must be less than 1001", 1001);
            this.isMin("#weight", "Value must be greater than 0", 1);
            this.disk.className = 'form__item--hidden';
            this.furniture.className = 'form__item--hidden';

        } else if (this.selector.value === 'Furniture') {
            this.furniture.className = 'form__item';
            this.isRequired("#height", "Please enter height");
            this.isNumber("#height", "Please provide the data of indicated type");
            this.isMin("#height", "Value must be greater than 0", 1);
            this.isRequired("#length", "Please enter length");
            this.isNumber("#length", "Please provide the data of indicated type");
            this.isMin("#length", "Value must be greater than 0", 1);
            this.isRequired("#width", "Please enter width");
            this.isNumber("#width", "Please provide the data of indicated type");
            this.isMin("#width", "Value must be greater than 0", 1);
            this.book.className = 'form__item--hidden';
            this.disk.className = 'form__item--hidden';
        }
        // });


        // else {
        //
        //     this.isRequired("#sku", "Please enter sku!");
        //     this.isAlphaNumeric("#sku", "SKU must be alpha number");
        //     this.hasMax("#sku", "SKU must be maximum 10 characters");
        //
        //     this.isRequired("#name", "Please enter name!");
        //     this.isAlphaNumeric("#name", "Name must be alpha number");
        //     this.hasMax("#name", "Name must be maximum 10 characters");
        //
        //     this.isRequired("#price", "Please enter price!");
        //     this.isMin("#price", "Price should be at least 1$", 1);
        //     this.isMax("#price", "Price should be maximum 1000$", 1000);
        //     this.isNumber("#price", "Please provide the data of indicated type");
        //
        //     this.isRequired("#type", "Please choose product type!");
        // }

    }

    validate() {
        this.isRequired("#sku", "Please enter sku!");
        this.isAlphaNumeric("#sku", "SKU must be alpha number");
        this.hasMax("#sku", "SKU must be maximum 10 characters");

        this.isRequired("#name", "Please enter name!");
        this.isAlphaNumeric("#name", "Name must be alpha number");
        this.hasMax("#name", "Name must be maximum 10 characters");

        this.isRequired("#price", "Please enter price!");
        this.isMin("#price", "Price should be at least 1$", 1);
        this.isMax("#price", "Price should be maximum 1000$", 1000);
        this.isNumber("#price", "Please provide the data of indicated type");

        this.isRequired("#type", "Please choose product type!");
    }


    checkSKU() {
        let error = document.querySelector('#sku+ span.error');
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

                this.errormessage.set(`#sku`, {required: text});
                console.log(this.errormessage);
                error.textContent = text;
            }
        );
        //  };

    }


    handle() {
        // console.log(this.errormessage);
        if (this.errormessage.values() !== 0) {

            this.errormessage.forEach((value, key) => {
                this.error = document.querySelector(`${key}+span.error`);


                if (value.required) {
                    this.error.textContent = value.required;
                }
                if (value.alphanumeric) {
                    this.error.textContent = value.alphanumeric;
                }
                if (value.maxlength) {
                    this.error.textContent = value.maxlength;
                }
                if (value.min) {
                    this.error.textContent = value.min;
                }
                if (value.max) {
                    this.error.textContent = value.max;
                }
                if (value.number) {
                    this.error.textContent = value.number;
                }


            });
        } else {
            return false;
            //     document.forms.product_form.onsubmit = (form) => {
            //         form.submit();
            //     }
        }
    }


    isRequired(attribute, errormessage) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("required", "required");
        if (input.validity.valueMissing) {
            this.errormessage.set(attribute, {required: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }

    isAlphaNumeric(attribute, errormessage) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("pattern", "[A-Za-z]+[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(attribute, {alphanumeric: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }

    isNumber(attribute, errormessage) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("pattern", "[0-9]*");
        if (input.validity.patternMismatch) {
            this.errormessage.set(attribute, {number: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }

    isMin(attribute, errormessage, min) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("min", min);
        if (input.validity.rangeUnderflow) {
            this.errormessage.set(attribute, {min: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }

    isMax(attribute, errormessage, max) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("max", max);
        if (input.validity.rangeOverflow) {
            this.errormessage.set(attribute, {max: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }


    hasMax(attribute, errormessage) {
        let input = document.querySelector(`${attribute}`);
        input.setAttribute("maxlength", "10");
        if (input.validity.tooLong) {
            this.errormessage.set(attribute, {maxlength: errormessage});
        } else {
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }


}

let validator = new Validator();
document.addEventListener("click", function (e) {
    //e.preventDefault();

    validator.validate();
    validator.checkSKU();
    validator.checkProductType();
    validator.handle();

});

document.addEventListener("submit", function (e) {
    console.log(validator.handle());
    e.preventDefault();
    if (validator.handle()) {
        e.preventDefault();
    }
});
