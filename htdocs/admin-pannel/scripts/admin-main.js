$(document).ready(function() {

})

//Artikli
function deleteArtikal(artikalId) {
    $.ajax({
        method: "post",
        url: "models/artikli/delete.php",
        data: {
            "id_artikla" : artikalId
        },
        success: function(result){
            console.log(result);
            let response = JSON.parse(result);
            removeArtikalFromTable(response.id);
        },
        error: function (xhr, status, message) {
            console.log(xhr);
            console.log(status);
            console.log(message);
        }
    });
}
function removeArtikalFromTable(idArtikla) {
    let selector = "#artikal-"+idArtikla;
    $(selector).remove();
}

//Kategorije
function deleteCategory(kategorijaId) {
    $.ajax({
        method: "post",
        url: "models/kategorije/delete.php",
        data: {
            "id_kategorije" : kategorijaId
        },
        success: function(result){
            let response = JSON.parse(result);
            removeCategoryFromTable(response.id);
        },
        error: function (xhr, status, message) {
            console.log(xhr);
            console.log(status);
            console.log(message);
        }
    });
}
function removeCategoryFromTable(idKategorije) {
    let selector = "#kategorija-"+idKategorije;
    $(selector).remove();
}

//Korisnici
function deleteUser(korisnikId) {
    $.ajax({
        method: "post",
        url: "models/korisnici/delete.php",
        data: {
            "id_korisnika" : korisnikId
        },
        success: function(result){
            let response = JSON.parse(result);
            removeUserFromTable(response.id);
        },
        error: function (xhr, status, message) {
            console.log(xhr);
            console.log(status);
            console.log(message);
        }
    });
}
function removeUserFromTable(idKorisnika) {
    let selector = "#korisnik-"+idKorisnika;
    $(selector).remove();
}

//Messages
function deleteMessage(messageId) {
    $.ajax({
        method: "post",
        url: "models/messages/delete.php",
        data: {
            "id_message" : messageId
        },
        success: function(result){
            let response = JSON.parse(result);
            removeMessageFromTable(response.id);
        },
        error: function (xhr, status, message) {
            console.log(xhr);
            console.log(status);
            console.log(message);
        }
    });
}
function removeMessageFromTable(idMessage) {
    let selector = "#message-"+idMessage;
    $(selector).remove();
}
