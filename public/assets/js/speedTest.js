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
            let global_chart_data = [];
            let global_chart_labels = [];
            //deletes all previous link logs
            $("#speedTestLogs").empty();
            const dataAccordingToLink = data.filter(({link}) => link == ids[0]);

            let max_desktop_speed, max_mobile_speed, total_desktop_speed,total_mobile_speed;
            max_desktop_speed = max_mobile_speed = total_desktop_speed = total_mobile_speed = 0

            let min_desktop_speed = 9999999
            let min_mobile_speed = 9999999

            let testCount = dataAccordingToLink.length;
            $('#testCountSp').text(testCount);

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
                let month = addZero(testDateTime.getMonth()+1);
                let d = addZero(testDateTime.getDate());
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

            // let chartValues = chartdata1.toString();
            ;
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





            $( function() {
                $("#datepicker_from2").datepicker({dateFormat: "d M yy"});
                $("#datepicker_to2").datepicker({dateFormat: "d M yy"});
            });


            $('.datepicker2').change( function() {


                for(i = 0; i < dataAccordingToLink.length; i++) {

                    let test = dataAccordingToLink[i];

                    global_chart_labels.push(test['date']['date'])
                    global_chart_data.push(test['desktopAVG'],test['mobileAVG']);

                }

                let newChartData = global_chart_data;
                let newChartLabels = global_chart_labels;

                let minValue = $( "#datepicker_from2" ).val().split(".");
                let maxValue = $ ( "#datepicker_to2" ).val().split(".");

                if(minValue ==""){
                    minValue=["25","07","1976"];
                }

                if(maxValue ==""){
                    maxValue =["14","12","2090"];
                }


                let FirstDate = new Date(minValue[2], minValue[1] - 1, minValue[0]);
                let LastDate = new Date(maxValue[2], maxValue[1] - 1, maxValue[0]);







                if( FirstDate.getTime() < LastDate.getTime()){

                    for (i = chartdata2.length - 1; i >= 0;i--){


                        let date_label = new Date(newChartLabels[i]);
                        if (date_label.getTime() < FirstDate.getTime() || date_label.getTime() > LastDate.getTime()){

                            newChartLabels.splice(i,1);
                            newChartData.splice(i,1);

                        }
                    }
                    chart.data.labels = newChartLabels
                    chart.data.datasets.data = newChartData

                    chart.update();


                    global_chart_labels = []
                    global_chart_data = []

                }
            });


        },
        error : function(xhr, textStatus, errorThrown) {
            alert('Ajax request failed.');
        }
    });
}