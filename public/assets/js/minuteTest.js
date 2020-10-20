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


    // $.ajax({
    //     method: "get" ,
    //     url: "path('getMinuteData', {})",
    //
    //
    //
    // })



            $.ajax({
                url:        '/project/ajax',
                type:       'POST',
                dataType:   'json',
                async:      true,

                success: function(data, status) {
                    var e = $('<tr><th>Name</th><th>Address</th></tr>');
                    $('#student').html('');
                    $('#student').append(e);

                    for(i = 0; i < data.length; i++) {
                        student = data[i];
                        var e = $('<tr><td id = "name"></td><td id = "address"></td></tr>');

                        $('#name', e).html(student['name']);
                        $('#address', e).html(student['address']);
                        $('#student').append(e);
                    }
                },
                error : function(xhr, textStatus, errorThrown) {
                    alert('Ajax request failed.');
                }
            });





}