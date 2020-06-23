/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 получаем список ттн пользователя
 */
function get_documents() {
//    console.dir(document);

    fetch('/get_documents', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (documents) {
//        console.log(documents);
        let containerLi = document.querySelector('#right ul');
        for (var prop in documents) {
            let li = document.createElement('li');
//            console.log(li);
            li.innerHTML = documents[prop].ttn;
//            console.log(documents[prop]);
            containerLi.appendChild(li);
        }
    });

}
;
console.log('get_documents');
get_documents();