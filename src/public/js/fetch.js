let servResponse = document.querySelector('#sku + span.error');

document.forms.product_form.onsubmit = function (e) {
    e.preventDefault();
    //let userInput = document.forms.ourForm.ourForm__inp.value;

    fetch('/js/db.php', {
        method: 'POST',
        body: new FormData(this),


    }).then(
        response => {
            return response.text();
        }
    ).then(
        text => {
            servResponse.textContent = text;
        }
    );
};