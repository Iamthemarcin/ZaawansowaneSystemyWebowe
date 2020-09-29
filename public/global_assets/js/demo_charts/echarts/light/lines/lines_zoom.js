/* ------------------------------------------------------------------------------
 *
 *  # Echarts - Line chart with zoom example
 *
 *  Demo JS code for line chart with zoom option [light theme]
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var EchartsLinesZoomLight = function() {


    //
    // Setup module components
    //

    // Line chart with zoom
    var _linesZoomLightExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define element
        var line_zoom_element = document.getElementById('line_zoom');


        //
        // Charts configuration
        //

        if (line_zoom_element) {

            // Initialize chart
            var line_zoom = echarts.init(line_zoom_element);


            //
            // Chart config
            //

            // Options
            line_zoom.setOption({

                // Define colors
                color: ["#424956", "#d74e67", '#0092ff'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 40,
                    top: 35,
                    bottom: 60,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Speed'],
                    itemHeight: 8,
                    itemGap: 20
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    data: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        formatter: '{value} ',
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Zoom control
                dataZoom: [
                    {
                        type: 'inside',
                        start: 30,
                        end: 70
                    },
                    {
                        show: true,
                        type: 'slider',
                        start: 30,
                        end: 70,
                        height: 40,
                        bottom: 0,
                        borderColor: '#ccc',
                        fillerColor: 'rgba(0,0,0,0.05)',
                        handleStyle: {
                            color: '#585f63'
                        }
                    }
                ],

                // Add series
                series: [

                    {
                        name: 'Speed',
                        type: 'line',
                        smooth: true,
                        symbolSize: 6,
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        },
                        data: [606,919,108,691,424,196,328,136,754,427,544,983,547,834,452,576,343,168,462,756,344,226,511,304,648,339,655,336,605,157,864]
                    }
                ]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            line_zoom_element && line_zoom.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelector('.sidebar-control');
        sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _linesZoomLightExample();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsLinesZoomLight.init();
});




var EchartsLinesZoomLight2 = function() {


    //
    // Setup module components
    //

    // Line chart with zoom
    var _linesZoomLightExample2 = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define element
        var line_zoom_element2 = document.getElementById('line_zoom2');


        //
        // Charts configuration
        //

        if (line_zoom_element2) {

            // Initialize chart
            var line_zoom2 = echarts.init(line_zoom_element2);


            //
            // Chart config
            //

            // Options
            line_zoom2.setOption({

                // Define colors
                color: ["#424956", "#d74e67", '#0092ff'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 40,
                    top: 35,
                    bottom: 60,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Speed'],
                    itemHeight: 8,
                    itemGap: 20
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    data: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        formatter: '{value} ',
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Zoom control
                dataZoom: [
                    {
                        type: 'inside',
                        start: 30,
                        end: 70
                    },
                    {
                        show: true,
                        type: 'slider',
                        start: 30,
                        end: 70,
                        height: 40,
                        bottom: 0,
                        borderColor: '#ccc',
                        fillerColor: 'rgba(0,0,0,0.05)',
                        handleStyle: {
                            color: '#585f63'
                        }
                    }
                ],

                // Add series
                series: [

                    {
                        name: 'Speed',
                        type: 'line',
                        smooth: true,
                        symbolSize: 6,
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        },
                        data: [614,919,108,691,424,196,328,136,754,427,544,983,547,834,452,576,343,168,462,756,344,226,511,304,648,339,655,336,605,157,864]
                    }
                ]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize2 = function() {
            line_zoom_element2 && line_zoom2.resize();
        };

        // On sidebar width change
        var sidebarToggle2 = document.querySelector('.sidebar-control');
        sidebarToggle2 && sidebarToggle2.addEventListener('click', triggerChartResize2);

        // On window resize
        var resizeCharts2;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts2);
            resizeCharts2 = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _linesZoomLightExample2();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsLinesZoomLight2.init();
});
