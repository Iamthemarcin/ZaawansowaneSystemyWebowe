function showSpeedTestData(ids){
    $.ajax({
        url:        '/project/ajaxSpeed',
        type:       'POST',
        dataType:   'json',
        async:      true,

        success: function(data, status) {

            //deletes all previous link logs
            $("#speedTestLogs").empty();
            const dataAccordingToLink = data.filter(({link}) => link == ids[0]);

            let max_desktop_speed, max_mobile_speed, total_desktop_speed,total_mobile_speed;
            max_desktop_speed = max_mobile_speed = total_desktop_speed = total_mobile_speed = 0

            let min_desktop_speed = 9999999
            let min_mobile_speed = 9999999

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
                //CZASY
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

                //PREDKOSC

                let mobile_speed = test['mobileAvg'];
                let desktop_speed = test['desktopAvg']

                total_mobile_speed += parseInt(mobile_speed);
                total_desktop_speed += parseInt(desktop_speed);

                if (mobile_speed > max_mobile_speed){
                    max_mobile_speed = mobile_speed
                }
                if (mobile_speed < min_mobile_speed){
                    min_mobile_speed = mobile_speed
                }
                if (desktop_speed > max_desktop_speed){
                    max_desktop_speed = desktop_speed
                }

                if (desktop_speed < min_desktop_speed){
                    min_desktop_speed = desktop_speed
                }

                var e = $('<tr><td id = "dateSpeed"></td><td id = "timeSpeed"></td><td id ="desktopAvg"></td><td id = "mobileAvg"></td></tr>');

                $('#dateSpeed', e).html(logDate);
                $('#timeSpeed', e).html(logTime);
                $('#desktopAvg', e).html(test['desktopAvg']);
                $('#mobileAvg', e).html(test['mobileAvg']);
                $('#speedTestLogs').append(e);
            }
            let avg_desktop_speed = (total_desktop_speed/testCount).toFixed(2);
            let avg_mobile_speed = (total_mobile_speed/testCount).toFixed(2);

            $('#avg_speed').text(avg_desktop_speed + '/' + avg_mobile_speed);
            $('#smallest_speed').text(min_desktop_speed + '/' + min_mobile_speed);
            $('#max_speed').text(max_desktop_speed + '/' + max_mobile_speed);

        },
        error : function(xhr, textStatus, errorThrown) {
            alert('Ajax request failed.');
        }
    });
}