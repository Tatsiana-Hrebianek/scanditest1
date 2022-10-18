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
    errormessage = [];

    //with handle method we will loop through all constraints and check which one failed and put it into
    handle() {
        let constraints = [this.isRequired(), this.isAlphaNumeric(), this.hasMax()];
        console.log(constraints);

        constraints.forEach(function (elem) {
            elem.addEventListener('click keypress', function (e) {
                if (elem.validity.valid) {
                    return true;
                    //this.errormessage.textContent = '';
                } else {
                    return false;
                }

                // else if (elem.validity.tooShort) {
                //     error.textContent = `!!!The value should be at least ${elem.minLength}
                //             characters; you enters ${elem.value.length}.`;
                // }
            });


        });

    }

    isValid() {
        if (this.handle()) {
            console.log("the form is true");
        } else {
            console.log("the form is not valid");
        }
    }


    isRequired(attribute, errormessage) {
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("required", "required");
        this.error = document.querySelector(`${attribute}+span.error`);
        this.error.setAttribute("required", "required");
        this.errormessage = errormessage;
        return this.attr;

        //console.log(this.attr);
    }

    isAlphaNumeric(attribute, errormessage) {
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("required", "required pattern = '[A-Za-z\d]+'");
        this.error = document.querySelector(`${attribute}+span.error`);
        this.error.setAttribute("required", "required");
        this.errormessage = errormessage;
        return this.attr;
        //console.log(this.error);
    }

    hasMax(attribute, errormessage) {
        //this.attr = attribute;
        this.attr = document.querySelector(`${attribute}`);
        this.attr.setAttribute("hasMax", "maxlength = 10");
        //let attr = this.attr;
        this.error = document.querySelector(`${attribute}+span.error`);
        this.error.setAttribute("required", "required");
        this.errormessage = errormessage;
        //this.error.textContent = errormessage;
        return this.attr;
        //console.log(this.error);
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


let validator = new Validator();
validator.isRequired("#sku", "Please fill in the sku!");
validator.isRequired("#name", "Please fill in the name!");

// validator.isAlphaNumeric("#sku", "SKU must be alpha number");
// validator.hasMax("#sku", "SKU must be maximum 10 characters");
// validator.handle();
// validator.isValid();

// obj.checkValidity();
// obj.checkProductType();
// obj.checkOnSubmitEvent();
// obj.checkSKU();





