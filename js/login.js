$(document).ready(function (){
    $('#formLogin').submit(function (event){
        loginCheck(event);
    })
})

function loginCheck(event) {
    let $email = $('#loginEmail');
    let $password = $('#loginPassword');

    let errors = [];

    let validateEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let validatePassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{5,}$/;

    //Email
    if($email.val() == "") {
        errors.push("Email obavezan!");
        event.preventDefault();
    } else {
        if(validateEmail.test($email.val())) {

            console.log('email  dobro!');
        } else {
            errors.push("E-mail nije u dobrom formatu. Treba biti u formatu: primer@gmail.com");
            event.preventDefault();
        }
    }
    //Password
    if($password.val() == "") {
        errors.push("Password je obavezan!");
        event.preventDefault();
    } else {
        if(validatePassword.test($password.val())) {

            console.log('ime dobro!');
        } else {
            errors.push("Password mora imati minimum 5 karaktera, jedan broj i minimum jedno veliko i malo slovo!");
            event.preventDefault();
        }
    }

    let html = '';
    if (errors.length !== 0) {
        for(let i=0; i<errors.length; i++) {
            html += `${errors[i]}<br>`;
        }
        $('#loginFormErrors').html(html);

    }
    // else {
    //     // return true;
    //
    //
    // }


}






















