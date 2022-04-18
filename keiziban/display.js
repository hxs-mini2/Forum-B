var displayArea = document.getElementById("displayArea");
reload();
setInterval('reload()', 1000); // 1000ms

function reload() {
    const table = "tb1";

    $.ajax({
        type: "POST",
        url: "Get_C.php",
        data : {'table' : table},
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