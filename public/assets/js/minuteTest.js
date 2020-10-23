function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : ":") : "0:";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : ":") : "0:";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : "") : "0";
    return addZero(hDisplay) + addZero(mDisplay) + addZero(sDisplay);
}
function addZero(i) {
    if (parseInt(i) < 10) {
        i = "0" + i;
    }
    return i;
}
function showMinuteTestData(ids) {
//ids[0] test link ids[1] project link
    //project link ? necessary idk maybe there will be problem between projects need testing
            $.ajax({
                url:        '/project/ajax',
                type:       'POST',
                dataType:   'json',
                async:      true,

                success: function(data, status) {
                    let prevsec = 0;
                    let active_time_diff = 0;
                    let inactive_time_diff = 0;
                    let prev_status
                    let chartdata1= [];
                    let chartdata2 = [];

                    const dataAccordingToLink = data.filter(({link}) => link == ids[0]);

                    //deletes all previous link logs
                    $("#minTestLogs").empty();

                    let testCount = dataAccordingToLink.length;
                    $('#testCountMin').text(testCount);



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
                        console.log(prevsec, sec);
                        console.log(active_time_diff);
                        console.log(inactive_time_diff);
                        
                        $('#date', e).html(logDate);
                        $('#time', e).html(logTime);
                        $('#minTestLogs').append(e);
                        //time index
                        let timeID = 'time' + i;
                        $('#time').attr('id',timeID);

                        chartdata1.push(test['date']['date'])
                        chartdata2.push(test['status']);

                        console.log(chartdata1);


                    }

                    for(i=0;i<testCount;i++){

                       let ax = $("#time"+i).text();

                    }
                    let Active_time = secondsToHms(active_time_diff)
                    $('#ActiveTime').text(Active_time);
                    if(active_time_diff != 0 || inactive_time_diff != 0) {
                        let Percent_active_time = (active_time_diff / (active_time_diff + inactive_time_diff) * 100).toFixed(2);
                        let Percent_inactive_time = (inactive_time_diff / (inactive_time_diff + active_time_diff) * 100).toFixed(2);

                        $('#Percent_active_time').text(Percent_active_time);
                        $('#Percent_inactive_time').text(Percent_inactive_time);

                    }




                    var ctx = document.getElementById('chartview1').getContext('2d');
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

                                lineTension:0,
                                data: chartdata2,


                                backgroundColor: 'rgb(20,14,207,0.2)',
                                borderColor: 'rgb(20,14,207)',
                                data: chartdata2,
                                borderWidth: 1,

                            }]
                        },
                        options: {  responsive: true,
                            maintainAspectRatio: false,

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
                                        maxTicksLimit:2,
                                        callback: function(value, index, values) {
                                            if(value==0){
                                                return 'Offline';}
                                            if(value==1){
                                                return 'Online';}
                                        },
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