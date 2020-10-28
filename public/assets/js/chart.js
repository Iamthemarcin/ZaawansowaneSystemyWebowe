


var ctx = document.getElementById('chartview1').getContext('2d');
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
            data: null
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





var ctx2 = document.getElementById('chartview2').getContext('2d');
Chart.defaults.global.legend.display = false;

var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        datasets: [{
            lineTension:0.2,
            backgroundColor: 'rgb(20,14,207,0.2)',
            borderColor: 'rgb(20,14,207)',
            data:null,

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
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true,


                }

            }]
        }
    }
});

$('.datepicker2').change( function() {
    var minValue = $( "#datepicker_from2" ).val();
    var maxValue = $ ( "#datepicker_to2" ).val();

    var FirstDate = new Date(minValue)
    var LastDate = new Date(maxValue)





    if( FirstDate.getTime() < LastDate.getTime()){

        var y = randomData(FirstDate,LastDate);
        chart2.data.datasets[0].data = y;

    }
});
$( function() {
    $("#datepicker_from2").datepicker({dateFormat: "d M yy"});
    $("#datepicker_to2").datepicker({dateFormat: "d M yy"});
});


