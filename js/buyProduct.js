
$(function(){
    $('#credit_card').on('input', function(){
        if(this.value)
            $('#credit_cardError').text('');
    });

    $('#card_number').on('input', function(){
       
        if(this.value)
           $('#card_numberError').text('');
        
    });

    $('#expiration_date').on('input', function(){
        if(this.value)
            $('#expiration_dateError').text('');
    });

    $('#card_cvc').on('input', function(){
        if(this.value)
            $('#card_cvcError').text('');
    });

    
});

function buyProduct(productId) {
    window.location.href="buy.php?id="+productId;
};

function goPurchaseEnd(productId) {
    window.location.href="purchaseEnd.php?id="+productId;
};

function goProductList() {
    window.location.href="viewProductList.php";
};

function goProfile(email) {
    window.location.href="viewProductList.php?email="+email;
};

function buyProduct(productId) {
    window.location.href="buy.php?id="+productId;
};

function goPurchaseEnd(productId) {
    window.location.href="purchaseEnd.php?id="+productId;
};

function goProductList() {
    window.location.href="viewProductList.php";
};


