

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
                    let prev_status;
                    let global_chart_data = [];
                    let global_chart_labels = [];
                    let chartdata1 = [];
                    let chartdata2 = [];
                    var first_entry = true;

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
                        let month = addZero(testDateTime.getMonth() + 1);

                        let d = addZero(testDateTime.getDate());
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

                        
                        $('#date', e).html(logDate);
                        $('#time', e).html(logTime);
                        $('#minTestLogs').append(e);
                        //time index
                        let timeID = 'time' + i;
                        $('#time').attr('id',timeID);

                        chartdata1.push(test['date']['date'])
                        chartdata2.push(test['status']);








                    }

                    first_entry = false;

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

                    var chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartdata1,
                            datasets: [{

                                lineTension:0,
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

                    $( function() {
                        $("#datepicker_from").datepicker({dateFormat: "d M yy"});
                        $("#datepicker_to").datepicker({dateFormat: "d M yy"});
                    });


                    $('.datepicker').change( function() {


                        for(i = 0; i < dataAccordingToLink.length; i++) {

                            let test = dataAccordingToLink[i];

                            global_chart_labels.push(test['date']['date'])
                            global_chart_data.push(test['status']);
                            console.log(global_chart_labels);
                        }

                        let newChartData = global_chart_data;
                        let newChartLabels = global_chart_labels;

                        let minValue = $( "#datepicker_from" ).val();
                        let maxValue = $ ( "#datepicker_to" ).val();

                        let FirstDate = new Date(minValue)
                        let LastDate = new Date(maxValue)

                        //
                        // console.log(FirstDate.getDate() + "/" + (FirstDate.getMonth() + 1) + "/" + FirstDate.getFullYear());
                        // FirstDate.getFullYear(),FirstDate.getMonth(),FirstDate.getDate()




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