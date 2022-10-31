class Validator {
    disk = document.getElementById("Disk");
    book = document.getElementById("Book");
    furniture = document.getElementById("Furniture");

    constructor() {
        this.sku = document.getElementById("sku");
        this.name = document.getElementById("name");
        this.price = document.getElementById("price");
        this.selector = document.getElementById("type");
        this.size = document.getElementById("size");
        this.weight = document.getElementById("weight");
        this.height = document.getElementById("height");
        this.width = document.getElementById("width");
        this.length = document.getElementById("length");
        this.properties = [this.sku, this.name, this.price, this.size, this.selector, this.length, this.width, this.height, this.weight];

        // let props = ["sku", "name", "price", "size", "type", "length", "width", "height", "weight"];
        // //let props = this.props;
        // props.forEach(function (elem) {
        //     console.log(elem);
        //     // elem = document.getElementById(`${elem.id}`);
        //     // console.log(elem["sku"]);
        // })
    }


    checkValidity() {
        let properties = this.props;
        properties.forEach(function (elem) {
            let error = document.querySelector(`#${elem.id} + span.error`);
            elem.addEventListener('input', function (e) {
                if (elem.validity.valid) {
                    error.textContent = '';
                } else if (elem.validity.tooShort) {

                    error.textContent = `!!!The value should be at least ${elem.minLength}
                            characters; you enters ${elem.value.length}.`;
                }
            });
        });
    }

    checkProductType() {
        let selector = this.selector;
        let disk = this.disk;
        let size = this.size;
        let book = this.book;
        let furniture = this.furniture;
        let length = this.length;
        //Why don't work through this?
        selector.addEventListener('change', function (e) {
            if (selector.value === 'Disk') {
                disk.className = 'form__item';
                size.setAttribute("required", "required");
                book.className = 'form__item--hidden';
                furniture.className = 'form__item--hidden';

            } else if (selector.value === 'Book') {
                book.className = 'form__item';
                weight.setAttribute("required", "required");
                disk.className = 'form__item--hidden';
                furniture.className = 'form__item--hidden';

            } else if (selector.value === 'Furniture') {
                furniture.className = 'form__item';
                height.setAttribute("required", "required");
                length.setAttribute("required", "required");
                width.setAttribute("required", "required");
                book.className = 'form__item--hidden';
                disk.className = 'form__item--hidden';
            }
        });
    }

    checkSKU() {
        let error = document.querySelector('#sku+ span.error');
        document.forms.product_form.onsubmit = function (e) {


            fetch('/js/db.php', {
                method: 'POST',
                body: new FormData(this),
            }).then(
                response => {
                    return response.text();
                }
            ).then(
                text => {
                    e.preventDefault();
                    error.textContent = text;
                }
            );
        };

    }


    attr = [];
    error = [];
    // errormessage = [];
    errormessage = new Map();

    handle() {


        if (this.errormessage.size > 0) {
            //????Uncaught TypeError: Cannot set properties of undefined (setting 'error')
            let error = this.error;
            let errormessage = this.errormessage;
            errormessage.forEach(function (value, key) {
                error = document.querySelector(`${key}+span.error`);
                error.textContent = value;
                // console.log(errormessage);
                // console.log(errormessage.size);
            });
        } else {
            //redirect to productList use headers??? JS
        }


        // } else {
        //
        //     error.textContent = '';
        //     console.log(error);
        // }


        // for (let key of this.errormessage.keys()) {
        //     console.log(key);
        //     this.error = document.querySelector(`${key}+span.error`);
        //     this.error.setAttribute("required", "required");
        //     for (let value of this.errormessage.values()) {
        //         this.error.textContent = value;
        //     }
        // }


        // let error = this.error;
        // let errormessage = this.errormessage;
        // error.forEach(function (elem) {
        //     elem.textContent = errormessage;
        // })


        // let constraints = [this.isRequired(), this.isAlphaNumeric(), this.hasMax()];
        // console.log(constraints);
        //
        // constraints.forEach(function (elem) {
        //     elem.addEventListener('click keypress', function (e) {
        //         if (elem.validity.valid) {
        //             return true;
        //             //this.errormessage.textContent = '';
        //         } else {
        //             return false;
        //         }
        //
        //         // else if (elem.validity.tooShort) {
        //         //     error.textContent = `!!!The value should be at least ${elem.minLength}
        //         //             characters; you enters ${elem.value.length}.`;
        //         // }
        //     });
        //
        //
        // });

    }

    // isValid() {
    //     if (this.handle()) {
    //         console.log("the form is true");
    //     } else {
    //         console.log("the form is not valid");
    //     }
    // }


    isRequired(attribute, errormessage) {
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("required", "required");
        if (this.attr.validity.valueMissing) {
            this.errormessage.set(attribute, errormessage);
        } else {
            //delete the record from array
            this.errormessage.delete(attribute);
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }

    isAlphaNumeric(attribute, errormessage) {

        //this.attr = document.querySelector(attribute);
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("pattern", "[A-Za-z]+[0-9]*");
        if (this.attr.validity.patternMismatch) {
            this.errormessage.set(attribute, errormessage);
        } else {
            //delete the record from array
            this.errormessage.delete(attribute);
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }


    hasMax(attribute, errormessage) {
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("maxlength", "10");
        if (this.attr.validity.tooLong) {
            this.errormessage.set(attribute, errormessage);
        } else {
            //delete the record from array
            this.errormessage.delete(attribute);
            this.error = document.querySelector(`${attribute} + span.error`);
            this.error.textContent = '';
        }
    }


    checkOnSubmitEvent() {
        let properties = this.properties;
        document.forms.product_form.addEventListener('submit', function (e) {
            properties.forEach(function (elem) {
                let error = document.querySelector(`#${elem.id} + span.error`);
                if (!elem.validity.valid) {
                    e.preventDefault();
                    error.textContent = `Please, insert ${elem.name}`;
                }
            });
        });
    }

}

document.addEventListener("submit", function (e) {
    e.preventDefault();

    let validator = new Validator();

    validator.isRequired("#name", "Please fill in the name!");
    validator.isRequired("#sku", "Please fill in the sku!");

    validator.hasMax("#sku", "SKU must be maximum 10 characters");
    validator.isAlphaNumeric("#sku", "SKU must be alpha number");
    validator.isAlphaNumeric("#name", "Name must be alpha number");
    validator.handle();


});


// validator.handle();
// validator.isValid();

// obj.checkValidity();
// obj.checkProductType();
// obj.checkOnSubmitEvent();
// obj.checkSKU();





