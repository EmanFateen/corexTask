function readHotels()
{
    var Apis = [
        'https://coresolutions.app/php_task/api/api_v1.php' ,
        'https://coresolutions.app/php_task/api/api_v2.php',
        'https://coresolutions.app/php_task/api/api_v3.php'
    ];


    var sendAPis = "";
    for (let i = 0; i < Apis.length; i++) {
        {
            sendAPis += Apis[i]+"$END$";
        }
    }
    console.log(sendAPis);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("hotels_demo").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "php/main.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("apis="+sendAPis);

}
