'use strict';

//sendBtn.onclick = send;

var formManager = {
    name: document.querySelector("#username"),
    nameError: document.querySelector("#username + .auth__error"),
    email: document.querySelector("#useremail"),
    emailError: document.querySelector("#useremail + .auth__error"),
    phone: document.querySelector("#userphone"),
    phoneError: document.querySelector("#userphone + .auth__error"),
    password: document.querySelector("#userpass"),
    passwordError: document.querySelector("#userpass + .auth__error"),
    subscribe: document.querySelector("#usersubscribe"),
    sendBtn: document.querySelector("#sendbtn")
}

formManager.valid = function valid(){

    var isError = false;

    if (!(/^[а-яa-z0-9\-_\.]{5,25}$/i.test(this.name.value))) {
        this.nameError.classList.remove('auth__error_hide');
        this.nameError.classList.add('auth__error_show');
        isError = true;
    }

    if (!(/^[0-9a-z.\-_]{1,15}@[0-9a-z.\-_]{1,14}\.[a-z.\-_]{1,10}$/i.test(this.email.value))) {
        this.emailError.classList.remove('auth__error_hide');
        this.emailError.classList.add('auth__error_show');
        isError = true;
    }

    if (!(/^(\+380|380|80}0){1,4}[0-9]{9}$/i.test(this.phone.value))) {
        this.phoneError.classList.remove('auth__error_hide');
        this.phoneError.classList.add('auth__error_show');
        isError = true;
    }

    if (!(/^[а-яa-z0-9\-_\.]{5,25}$/i.test(this.password.value))) {
        this.passwordError.classList.remove('auth__error_hide');
        this.passwordError.classList.add('auth__error_show');
        isError = true;
    }

    return !isError;
}

formManager.send = function send() {

    if (!this.valid()) return null;

    var data = {
        name: this.name.value,
        email: this.email.value,
        phone: this.phone.value,
        password: this.password.value,
        subscribe: this.subscribe.checked
    }

    fetch('/registration', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    }).then(function(response){
        return response.json();
    }).then(function(data){
        console.log(data);
        alert(data.message);
    });
};

formManager.setClearHandler = function setClearHandler(){
    var elements = document.querySelectorAll('.auth__text');

    elements.forEach(function(element) {
        element.onclick = function(){
            this.nextElementSibling.classList.remove('auth__error_show');
            this.nextElementSibling.classList.add('auth__error_hide');
        }
    });
}

formManager.init = function(){
    this.sendBtn.onclick = this.send.bind(this);// bind чтоб в this всегда было formManager
    this.setClearHandler();
}

formManager.init();