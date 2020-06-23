/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 получаем список ттн пользователя
 */
function get_documents() {
    console.dir(document);

    fetch('http://' + document.domain + '/handlers/get_documents.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        }
    }).then(function (response) {
        return response.json();
    }).then(function (data) {
        console.log(data);
    });

};
console.log('get_documents');
get_documents();