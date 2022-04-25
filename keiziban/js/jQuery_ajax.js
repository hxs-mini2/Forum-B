function display() {
    var displayArea = document.getElementById("displayArea");
    $.ajax({
        type: "POST",
        url: `http://${homeURL}keiziban/php/Get_C.php`,
        data: { 'table': table },
        dataType: "json",
    }).done(function (data) { // 成功時
        displayArea.innerHTML = "<br>";
        for (var item in data) {
            displayArea.insertAdjacentHTML("afterbegin", data[item]['no'] + ": " + data[item]['name'] + " " + data[item]['time'] + "<br>" +
                data[item]['message'] + "<hr><br>");
        }
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) { // 失敗時
        console.log(XMLHttpRequest.status);
        console.log(textStatus);
        console.log(errorThrown.message);
    });
}

function reload() {
    display();
    setInterval('display()', 1000);
}

function sendMessage(params) {
    const formElm = document.getElementById("sendMessage");
    const name = formElm.name.value;
    const message = formElm.message.value;
    formElm.name.value = '';
    formElm.message.value = '';
    
    $.ajax({
        type: "POST",
        url: `http://${homeURL}keiziban/php/Send_C.php`,
        data: {"table" : table,
               "name" : name, 
               "message" : message}
    }).done(function(){
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log(XMLHttpRequest.status);
        console.log(textStatus);
        console.log(errorThrown.message);
    });
}
