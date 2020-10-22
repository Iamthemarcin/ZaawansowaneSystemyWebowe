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

            console.log(dataAccordingToLink);
            //deletes all previous link logs
            // $("#minTestLogs").empty();
            //
            // let testCount = dataAccordingToLink.length;
            // $('#testCountMin').text(testCount);
            //
            // function addZero(i) {
            //     if (i < 10) {
            //         i = "0" + i;
            //     }
            //     return i;
            // }
            //
            // for(i = 0; i < dataAccordingToLink.length; i++) {
            //
            //     let test = dataAccordingToLink[i];
            //     let testDateTime = new Date(test.date.date);
            //     let h = addZero(testDateTime.getHours());
            //     let m = addZero(testDateTime.getMinutes());
            //     let s = addZero(testDateTime.getSeconds());
            //
            //     let y = testDateTime.getFullYear();
            //     let month = addZero(testDateTime.getMonth());
            //     let d = addZero(testDateTime.getDay());
            //     let logDate = y + "-" + month + "-" + d;
            //     let logTime = h + ":" + m + ":" + s;
            //     if(test['status'] == 1){
            //         var e = $('<tr><td id = "date"></td><td id = "time"></td><td><span class="badge badge-success">Aktywna</span></td></tr>');
            //
            //     }
            //     else {
            //         var e = $('<tr><td id = "date"></td><td id = "time"></td><td><span class="badge badge-danger">Nieaktywna</span></td></tr>');
            //     }
            //
            //     let status = test['status'];
            //     let sec= testDateTime.getTime()/1000;
            //     if (prevsec != 0 && prev_status == 1){
            //         active_time_diff += (sec - prevsec);
            //     }
            //     else if(prev_status == 0){
            //         inactive_time_diff += (sec - prevsec);
            //     }
            //
            //     prevsec = sec
            //     prev_status = status
            //     console.log(prevsec, sec);
            //     console.log(active_time_diff);
            //     console.log(inactive_time_diff);
            //
            //     $('#date', e).html(logDate);
            //     $('#time', e).html(logTime);
            //     $('#minTestLogs').append(e);
            //     //time index
            //     let timeID = 'time' + i;
            //     $('#time').attr('id',timeID);
            // }
            // for(i=0;i<testCount;i++){
            //
            //     let ax = $("#time"+i).text();
            //
            // }
            // $('#ActiveTime').text(active_time_diff);
            // if($ActiveTimeSeconds != 0 || $InactiveTimeSeconds != 0) {
            //     let Percent_active_time = round(active_time_diff / (active_time_diff + inactive_time_diff) * 100, 2);
            //     let Percent_inactive_time = round(inactive_time_diff / (inactive_time_diff + active_time_diff) * 100, 2);
            //
            //
            //     $('#Percent_active_time').text(Percent_active_time);
            //     $('#Percent_inactive_time').text(Percent_inactive_time);
            //
            // }
        },
        error : function(xhr, textStatus, errorThrown) {
            alert('Ajax request failed.');
        }
    });
}