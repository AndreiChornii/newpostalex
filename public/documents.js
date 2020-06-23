'use strict';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// сохраняем ттн

var field_ttn = document.querySelector('#userttn');
var ttnError = document.querySelector("#userttn + .auth__error");
var button_ttn = document.querySelector('#sendbtn');

var formManager = {
    ttn: field_ttn,
    ttnError: ttnError,
    sendBtn: button_ttn
};

formManager.valid = function valid() {

    var isError = false;

    if (!(/^[0-9]{14}$/i.test(this.ttn.value))) {
        this.ttnError.classList.remove('auth__error_hide');
        this.ttnError.classList.add('auth__error_show');
        isError = true;
    }

    return !isError;
};

formManager.send = function send() {

    if (!this.valid()) {
        console.log('invalid ttn number');
        return null;
    }
    ;

    var data = {
        ttn: this.ttn.value
    };

    fetch('/documents', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (documents) {
        let containerLi = document.querySelector('#right ul');
        while (containerLi.firstChild) {
            containerLi.removeChild(containerLi.firstChild);
        }
        console.log(documents);
        for (var prop in documents) {
            let li = document.createElement('li');
//            console.log(li);
            li.innerHTML = documents[prop].ttn;
//            console.log(documents[prop]);
            containerLi.appendChild(li);
        }
    });
//    let Status = document.querySelector('#Status');
//    let StatusCode = document.querySelector('#StatusCode'); 
//    let ScheduledDeliveryDate = document.querySelector('#ScheduledDeliveryDate');
//    data.Status = Status.innerText;
//    data.StatusCode = StatusCode.innerText;
//    data.ScheduledDeliveryDate = ScheduledDeliveryDate.innerText;
};

formManager.setClearHandler = function setClearHandler() {
    var elements = document.querySelectorAll('.auth__text');

    elements.forEach(function (element) {
        element.onclick = function () {
            this.nextElementSibling.classList.remove('auth__error_show');
            this.nextElementSibling.classList.add('auth__error_hide');
        }
    });
}

formManager.init = function () {
    this.sendBtn.onclick = this.send.bind(this);// bind чтоб в this всегда было formManager
    this.setClearHandler();
}

formManager.init();