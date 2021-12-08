function buyProduct(productId) {
    window.location.href="buy.php?id="+productId;
}

function goPurchaseEnd(productId) {
    window.location.href="purchaseEnd.php?id="+productId;
}

function goProductList() {
    window.location.href="viewProductList.php";
}

function goProfile(email) {
    window.location.href="viewProductList.php?email="+email;
}

function buyProduct(productId) {
    window.location.href="buy.php?id="+productId;
}

function goPurchaseEnd(productId) {
    window.location.href="purchaseEnd.php?id="+productId;
}

function goProductList() {
    window.location.href="viewProductList.php";
}

$(function(){
    $('#credit_card').on('input', function(){
        if(this.value)
            $('#credit_cardError').text('');
    });

    //ANCHOR no se como poner el card_type en el php
    $('#card_number').on('input', function(){
       if(this.value.match(/^4[0-9]{12}(?:[0-9]{3})?$/)){
           $('#card_type').text('Visa');
           $('#card_numberError').text('');
       }else if(this.value.match(/(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$ /)){
           $('#card_type').text('Mastercard');
           $('#card_numberError').text('');
       }else if(this.value===''){
          $('#card_type').text('');
            $('#card_numberError').text('Introduzca la tarjeta de credito');
        }else{
            $('#card_type').text('');
            $('#card_numberError').text('Solo aceptamos Visa o Mastercard');
        }
    });

    $('#expiration_date').on('input', function(){
        if(this.value)
            $('#expiration_dateError').text('');
    });

    $('#card_cvc').on('input', function(){
        if(this.value.match(/^[0-9]{3}*$/))
            $('#card_cvcError').text('');
    });

    
});

