function showMinuteTestData(ids) {
//ids[0] test link ids[1] project link
    //project link ? necessary idk maybe there will be problem between projects need testing
            $.ajax({
                url:        '/project/ajax',
                type:       'POST',
                dataType:   'json',
                async:      true,

                success: function(data, status) {
                    const dataAccordingToLink = data.filter(({link}) => link == ids[0]);

                    //deletes all previous link logs
                    $("#minTestLogs").empty();

                    let testCount = dataAccordingToLink.length;
                    $('#testCountMin').text(testCount);

                    function addZero(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }

                    for(i = 0; i < dataAccordingToLink.length; i++) {
                        let test = dataAccordingToLink[i];
                        let testDateTime = new Date(test.date.date);
                        let h = addZero(testDateTime.getHours());
                        let m = addZero(testDateTime.getMinutes());
                        let s = addZero(testDateTime.getSeconds());

                        let y = testDateTime.getFullYear();
                        let month = addZero(testDateTime.getMonth());
                        let d = addZero(testDateTime.getDay());
                        let logDate = y + "-" + month + "-" + d;
                        let logTime = h + ":" + m + ":" + s;
                        if(test['status'] == 1){
                                var e = $('<tr><td id = "date"></td><td id = "time"></td><td><span class="badge badge-success">Aktywna</span></td></tr>');

                            }
                            else {
                                var e = $('<tr><td id = "date"></td><td id = "time"></td><td><span class="badge badge-danger">Nieaktywna</span></td></tr>');
                            }

                        $('#date', e).html(logDate);
                        $('#time', e).html(logTime);
                        $('#minTestLogs').append(e);
                        let timeID = 'time' + i;
                        $('#time').attr('id',timeID);
                    }
                    for(i=0;i<testCount;i++){

                       let ax = $("#time"+i).text();

                    }
                },
                error : function(xhr, textStatus, errorThrown) {
                    alert('Ajax request failed.');
                }
            });





}