$(document).ready(function (){
    $("div.shop-category a").on("click", function(event) {
        event.preventDefault();
        let idKategorije = $(this).data('id-kategorije');
        let baseUrl = $(this).data('url-kategorije');

        let urlKategorije = baseUrl + "models/category-process.php"

        $.ajax({
            method: "post",
            url: urlKategorije,
            dataType: 'json',
            data: {
                "idKategorije" : idKategorije
            },
            success: function (response) {
                console.log("Response:");
                let artikliObj = response.artikli;

                artikliObj.forEach(function(element) {
                    console.log(element.cena);
                })

            },
            error: function (xhr, textStatus) {
                console.log("Error:");
                console.log(xhr);
                console.log(textStatus);
            }
        })

    })
    //Cart
    $(".add-to-cart-class").click(function (e) {
        
        let dataIdArtikla = $(this).data('id-artikla');
        let baseUrl = $(this).data('url');

        let url = baseUrl + "models/cart-process.php";

        $.ajax({
            method: "post",
            url: url,
            dataType: 'json',
            data: {
                "idArtikla" : dataIdArtikla
            },
            success: function (response) {
                changeCartQuantity(response.quantity);
            },
            error: function (xhr, textStatus) {
                alert("oh no: "+ " " + xhr.status+ " " +textStatus.responseText);
            }
        })
    });

    $("#cart-art-quantity").on('change', function () {
        // alert("changed");   


    });

    //CLEAR CART!
    $('#clear-cart').click(function() {
        let cartMsg = $(this).data('clear-msg');
        let baseUrl = $(this).data('clear-url');
        let cartContent = $('.cart-content');

        let clearCartUrl = baseUrl + "models/cart-clear.php";
        $.ajax({
            method: "post",
            url: clearCartUrl,
            dataType: 'json',
            data: {
                "cartMsg" : cartMsg
            },
            success: function (response) {
                cartContent.remove();
            },
            error: function (xhr, textStatus) {
                alert("oh no: "+ " " + xhr.status+ " " +textStatus.responseText);
            }
        })
    })

    

})

function changeCartQuantity(quantity) {
    $('.badge').html(quantity);
}


function clearcart(artikal) {
    
    let json = JSON.stringify(artikal);
    console.log(json);
}



