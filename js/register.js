$(document).ready(function () {

    $("#formRegister").submit(function (event) {
        registrationCheck(event);
    })

})

function registrationCheck(event) {

    let $name = $('#registerName');
    let $lastName = $('#registerLastName');
    let $email = $('#registerEmail');
    let $password = $('#registerPassword');

    let errors = [];

    let validateName = /^[A-Z][a-z]{2,30}$/;
    let validateLastName = /^[A-Z][a-z]{2,30}$/;
    let validateEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let validatePassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{5,}$/;

    //Name
    if($name.val() == "") {
        errors.push("Name missing!");
        event.preventDefault();
    } else {
        if(validateName.test($name.val())) {

            console.log('Good!');
        } else {
            errors.push("Name must start with capital letter and without blank spaces!");
            event.preventDefault();
        }
    }
    //Last Name
    if($lastName.val() == "") {
        errors.push("Last name missing!");
        event.preventDefault();
    } else {
        if(validateLastName.test($lastName.val())) {

            console.log('Good!');
        } else {
            errors.push("Last name must start with capital letter and without blank spaces!");
            event.preventDefault();
        }
    }
    //Email
    if($email.val() == "") {
        errors.push("Email missing!");
        event.preventDefault();
    } else {
        if(validateEmail.test($email.val())) {

            console.log('Email  Good!');
        } else {
            errors.push("E-mail not in a good format. Should be like: example@gmail.com");
            event.preventDefault();
        }
    }
    //Password
    if($password.val() == "") {
        errors.push("Password missing!");
        event.preventDefault();
    } else {
        if(validatePassword.test($password.val())) {

            console.log('Name good!'); 
        } else {
            errors.push("Password must have min 5 charrs, 1 number and 1 upper and lower character!");
            event.preventDefault();
        }
    }


    let html = '';
    if (errors.length != 0) {
        for(let i=0; i<errors.length; i++) {
            html += `${errors[i]}<br>`;
        }
        $('#registerFormErrors').html(html);

    } else {
        return true;
    }

}