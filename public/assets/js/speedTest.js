function showSpeedTestData(ids){
    $.ajax({
        url:        '/project/ajaxSpeed',
        type:       'POST',
        dataType:   'json',
        async:      true,

        success: function(data, status) {
            let prevsec = 0;
            let active_time_diff = 0;
            let inactive_time_diff = 0;
            let prev_status

            const dataAccordingToLink = data.filter(({link}) => link == ids[0]);

            //deletes all previous link logs
            $("#minTestLogs").empty();

            let testCount = dataAccordingToLink.length;
            $('#testCountSp').text(testCount);
            console.log(dataAccordingToLink);
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

                var e = $('<tr><td id = "dateSpeed"></td><td id = "timeSpeed"></td><td id ="desktopAvg"></td><td id = "mobileAvg"></td></tr>');




                let status = test['status'];
                let sec= testDateTime.getTime()/1000;
                if (prevsec != 0 && prev_status == 1){
                    active_time_diff += (sec - prevsec);
                }
                else if(prev_status == 0){
                    inactive_time_diff += (sec - prevsec);
                }

                prevsec = sec
                prev_status = status


                $('#dateSpeed', e).html(logDate);
                $('#timeSpeed', e).html(logTime);
                $('#desktopAvg', e).html(test['desktopAvg']);
                $('#mobileAvg', e).html(test['mobileAvg']);
                $('#speedTestLogs').append(e);
                //time index
                let timeID = 'timeSpeed' + i;
                $('#timeSpeed').attr('id',timeID);
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