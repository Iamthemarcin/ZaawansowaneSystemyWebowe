function showMinuteTestData(ids) {
//ids[0] test link ids[1] project link


    // $("#testCount").text("aasa");
    //
    // var xhttp;
    // if (ids == "") {
    //     document.getElementById("txtHint").innerHTML = "";
    //     return;
    // }
    // xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("txtHint").innerHTML = this.responseText;
    //     }
    // };
    // xhttp.open("GET", "getMinuteDate.php?q="+ids[1], true);
    // xhttp.send();



    //
    // $.ajax({
    //     type: "POST",
    //     url: "/project/ajax",
    //
    //     dataType: "json",
    //     success: {
    //
    //     }
    // });


    $.ajax({
        method: "get" ,
        url: "path('getMinuteData', {})",



    })



}