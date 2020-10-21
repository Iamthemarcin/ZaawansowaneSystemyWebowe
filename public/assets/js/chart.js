


var ctx = document.getElementById('chart1').getContext('2d');
Chart.defaults.global.legend.display = false;



var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {

        datasets: [{
            lineTension:0.0,
            backgroundColor: 'rgb(20,14,207,0.2)',
            borderColor: 'rgb(20,14,207)',
            data: x = randomData(new Date(2020, 9, 1), new Date())
        }]
    },

    // Configuration options go here
    options: {  responsive: true,
        maintainAspectRatio: false,
        tooltips: {
            enabled: false
        },
        scales:{
            xAxes:[{
                type: 'time',
                time:{
                    minUnit: 'minute',
                    displayFormats: {
                        day : 'MMM D'
                    }
                },
                ticks:{

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

    console.log(startX.getTime());
    console.log(endX.getTime());
    while (date_iter < endX.getTime()) {
        date_iter = startX.getTime() + (i * 24 * 60 * 60 * 1000)
        if (i > 1000){
            console.log('no za dluga ta funkcja kolego');
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


$(function() {
    $("#datepicker_from").change(function() {
        var date = $(this).datepicker("getDate");

    });
});
$('.datepicker').change( function() {
    var minValue = $( "#datepicker_from" ).val();
    var maxValue = $ ( "#datepicker_to" ).val();

    var FirstDate = new Date(minValue)
    var LastDate = new Date(maxValue)
    //
    // console.log(FirstDate.getDate() + "/" + (FirstDate.getMonth() + 1) + "/" + FirstDate.getFullYear());
    // FirstDate.getFullYear(),FirstDate.getMonth(),FirstDate.getDate()

    console.log(FirstDate.getTime());
    console.log(LastDate.getTime());


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








// var chart = new Chart(ctx, {
//     // The type of chart we want to create
//     type: 'line',
//
//     // The data for our dataset
//     data: {
//         labels: ['Pon', 'Wt', 'Śr', 'Czw', 'Pią', 'Sob', 'Nied'],
//         datasets: [{
//             lineTension:0.0,
//             backgroundColor: 'rgb(20,14,207,0.2)',
//             borderColor: 'rgb(20,14,207)',
//             data: [0, 2, 1, 2, 0, 2, 1]
//         }]
//     },
//
//     // Configuration options go here
//     options: {  responsive: true,
//         maintainAspectRatio: false,
//         tooltips: {
//             enabled: false
//         },
//         scales:{
//             yAxes:[{
//                 ticks:{
//                     beginAtZero:true,
//                     maxTicksLimit:3,
//                     callback: function(value, index, values) {
//                         if(value==0){
//                             return 'Nie działa';}
//                         if(value==1){
//                             return 'Status pośredni';}
//                         if(value==2){
//                             return 'Działa';}
//                     },
//                 }
//             }]
//         }
//     }
// });

//chart2
var ctx2 = document.getElementById('chart2').getContext('2d');
Chart.defaults.global.legend.display = false;

var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['Pon', 'Wt', 'Śr', 'Czw', 'Pią', 'Sob', 'Nied'],
        datasets: [{
            lineTension:0.2,
            backgroundColor: 'rgb(20,14,207,0.2)',
            borderColor: 'rgb(20,14,207)',
            data: [300, 222, 110, 345, 123, 34, 67]
        }]
    },

    // Configuration options go here
    options: { responsive: true,
        maintainAspectRatio: false,
        tooltips: {
            enabled: false
        },
        scales:{
            yAxes:[{
                ticks:{
                    beginAtZero:true,


                }
            }]
        }
    }
});

