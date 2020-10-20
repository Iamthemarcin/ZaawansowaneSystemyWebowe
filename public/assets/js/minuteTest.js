function showMinuteTestData(ids) {
//ids[0] test link ids[1] project link




            $.ajax({
                url:        '/project/ajax',
                type:       'POST',
                dataType:   'json',
                async:      true,

                success: function(data, status) {
                    console.log(data);
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