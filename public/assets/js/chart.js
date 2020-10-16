var ctx = document.getElementById('chart1').getContext('2d');
Chart.defaults.global.legend.display = false;


var week_days = function() {
    var d = new Date();
    let day
    var days = ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"];
    var label = days[d.getDay()];
    var curr_days = [];

    for (let i = 0; i < 7; i++) {
        day = d.getDay() - i

        if (day < 0) {
            day = day + 7
        }
        curr_days.unshift(days[day]);
    }
    return curr_days
}


var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: week_days(),
        datasets: [{
            lineTension:0.0,
            backgroundColor: 'rgb(20,14,207,0.2)',
            borderColor: 'rgb(20,14,207)',
            data: [0, 2, 1, 2, 0, 2, 1]
        }]
    },

    // Configuration options go here
    options: {  responsive: true,
        maintainAspectRatio: false,
        tooltips: {
            enabled: false
        },
        scales:{
            yAxes:[{
                ticks:{
                    beginAtZero:true,
                    maxTicksLimit:3,
                    callback: function(value, index, values) {
                        if(value==0){
                        return 'Nie działa';}
                        if(value==1){
                            return 'Status pośredni';}
                        if(value==2){
                            return 'Działa';}
                    },
                }
            }]
        }
    }
});

//chart2
var ctx2 = document.getElementById('chart2').getContext('2d');
Chart.defaults.global.legend.display = false;

var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: week_days(),
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