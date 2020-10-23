function showSpeedTestData(ids){
    $.ajax({
        url:        '/project/ajaxSpeed',
        type:       'POST',
        dataType:   'json',
        async:      true,

        success: function(data, status) {
            let chartdata1= [];
            let chartdata2 = [];
            let chartdata3 = [];
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

                chartdata1.push(test['date']['date']);
                chartdata2.push(test['desktopAvg']);
                chartdata3.push(test['mobileAvg'])
            }
            let avg_desktop_speed = parseFloat((total_desktop_speed/testCount).toFixed(2));
            let avg_mobile_speed = parseFloat((total_mobile_speed/testCount).toFixed(2));

            $('#avg_speed').text(avg_desktop_speed + '/' + avg_mobile_speed);
            $('#smallest_speed').text(min_desktop_speed + '/' + min_mobile_speed);
            $('#max_speed').text(max_desktop_speed + '/' + max_mobile_speed);



            var ctx = document.getElementById('chartview2').getContext('2d');
            Chart.defaults.global.legend.display = false;
            //console.log(chartdata1);
            // let chartValues = chartdata1.toString();
            // console.log(chartValues);
            // var obj = JSON.parse('{"0":"8.4113","2":"9.5231","3":"9.0655","4":"7.8400"}');

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartdata1,
                    datasets: [{
                        label:'Desktop',
                        lineTension:0.3,
                        data: chartdata2,
                        borderWidth: 1,

                        backgroundColor: 'rgb(20,14,207,0.2)',
                        borderColor: 'rgb(20,14,207)',
                        data: chartdata2

                    },
                        {
                            label: 'Mobile',
                            lineTension:0.3,
                            data: chartdata3,
                            borderWidth: 1,


                            backgroundColor: 'rgb(153, 255, 102, 0.2)',
                            borderColor: 'rgb(153, 255, 102)',
                            data: chartdata3
                        }],

                },
                options: {  responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: "top",
                        align: "start",
                        labels: {

                        }
                    },
                    tooltips: {
                        enabled: false
                    },

                    scales:{
                        xAxes:[{
                            type: 'time',
                            time:{
                                displayFormats: {
                                    day : 'MMM D'
                                }
                            },
                            ticks:{

                            }

                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,

                            }

                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,


                            }

                        }]

                    }
                }
            });


            function randomData(startX, endX){
                var dps = [];
                var xValue, yValue = 0;
                var date_iter = 0;
                var i = 0;


                while (date_iter < endX.getTime()) {
                    date_iter = startX.getTime() + (i * 24 * 60 * 60 * 1000)
                    if (i > 1000){
                        console.log('Random data function error');
                        break
                    }
                    xValue = new Date(startX.getTime() + (i * 24 * 60 * 60 * 1000));
                    yValue += (Math.random() * 10 - 5) << 0;
                    i += 1

                    dps.push({
                        x: xValue,
                        y: yValue
                    });
                }
                return dps;
            }



            $('.datepicker').change( function() {
                var minValue = $( "#datepicker_from" ).val();
                var maxValue = $ ( "#datepicker_to" ).val();

                var FirstDate = new Date(minValue)
                var LastDate = new Date(maxValue)
                //
                // console.log(FirstDate.getDate() + "/" + (FirstDate.getMonth() + 1) + "/" + FirstDate.getFullYear());
                // FirstDate.getFullYear(),FirstDate.getMonth(),FirstDate.getDate()




                if( FirstDate.getTime() < LastDate.getTime()){

                    var y = randomData(FirstDate,LastDate);
                    chart.data.datasets[0].data = y;
                    chart.update();
                }
            });
            $( function() {
                $("#datepicker_from").datepicker({dateFormat: "d M yy"});
                $("#datepicker_to").datepicker({dateFormat: "d M yy"});
            });
        },
        error : function(xhr, textStatus, errorThrown) {
            alert('Ajax request failed.');
        }
    });
}