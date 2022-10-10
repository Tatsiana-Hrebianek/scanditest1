class Validation {
    disk = document.getElementById("Disk");
    book = document.getElementById("Book");
    furniture = document.getElementById("Furniture");

    constructor() {
        //initializing properties with our parameters
        this.sku = document.getElementById("sku");
        this.name = document.getElementById("name");
        this.price = document.getElementById("price");
        this.selector = document.getElementById("type");
        this.size = document.getElementById("size");
        this.weight = document.getElementById("weight");
        this.height = document.getElementById("height");
        this.width = document.getElementById("width");
        this.length = document.getElementById("length");
        this.props = [this.sku, this.name, this.price, this.size, this.selector, this.length, this.width, this.height, this.weight];

        // let props = ["sku", "name", "price", "size", "type", "length", "width", "height", "weight"];
        // //let props = this.props;
        // props.forEach(function (elem) {
        //     console.log(elem);
        //     // elem = document.getElementById(`${elem.id}`);
        //     // console.log(elem["sku"]);
        // })
    }

    checkValidity() {
        let props = this.props;
        props.forEach(function (elem) {
            let error = document.querySelector(`#${elem.name} + span.error`);
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

    checkOnSubmitEvent() {
        let props = this.props;
        document.forms.product_form.addEventListener('submit', function (e) {
            props.forEach(function (elem) {
                let error = document.querySelector(`#${elem.name} + span.error`);
                if (!elem.validity.valid) {
                    e.preventDefault();
                    error.textContent = `Please, insert ${elem.name}`;
                }
            });
        });
    }
}

let obj = new Validation();
obj.checkValidity();
obj.checkProductType();
obj.checkOnSubmitEvent();
obj.checkSKU();