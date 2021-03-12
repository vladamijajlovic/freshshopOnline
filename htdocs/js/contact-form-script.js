$(document).ready(function (){
    
    $('#contactForm').submit(function (event){
        contactCheck(event);
    })
})

function contactCheck(event) {
    let name = $('#name').val();
    let email = $('#email').val();
    let subject = $('#msg_subject').val();
    let message = $('#message').val();

    let errors = [];

    let validateName = /^[A-Z][a-z]{2,30}$/;
    let validateEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let validateSubject = /^[A-Z][a-z]{0,30}$/;

    //Name
    if(name == "") {
        errors.push("Enter your name!");
        event.preventDefault();
    } 
    else {
        if(!validateName.test(name)) {
            errors.push("Name is not in a good format. First capital letter is must and minimum 3 characters!");
            event.preventDefault();
        } 
    }

    //Email
    if(email == "") {
        errors.push("Enter email adress!");
        event.preventDefault();
    } 
    else {
        if(!validateEmail.test(email)) {
            errors.push("E-mail is not in a good format. Should be like: example@gmail.com");
            event.preventDefault();
        } 
    }
    
    //Subject
    if(subject == "") {
        errors.push("Enter subject!");
        event.preventDefault();
    } 
    else {
        if(!validateSubject.test(subject)) {
            errors.push("Subject capital letter is a must! Max one word aswell and no blank spaces!");
            event.preventDefault();
        } 
    }

    //Message
    if(message == "") {
        errors.push("Write some message for us!");
        event.preventDefault();
    } 
   
    

    let html = '';
    if (errors.length !== 0) {
        for(let i=0; i<errors.length; i++) {
            html += `${errors[i]}<br>`;
        }
        $('#loginFormErrors').html(html);

    }
}
