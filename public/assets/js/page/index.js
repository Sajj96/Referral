"use strict";

$(function () {
    chart1();
    chart2();
    chart3();
    chart4();

    // select all on checkbox click
    $("[data-checkboxes]").each(function () {
        var me = $(this),
            group = me.data('checkboxes'),
            role = me.data('checkbox-role');

        me.change(function () {
            var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
                checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
                dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                total = all.length,
                checked_length = checked.length;

            if (role == 'dad') {
                if (me.is(':checked')) {
                    all.prop('checked', true);
                } else {
                    all.prop('checked', false);
                }
            } else {
                if (checked_length >= total) {
                    dad.prop('checked', true);
                } else {
                    dad.prop('checked', false);
                }
            }
        });
    });



});



function chart1() {
    let curr = new Date;
    let week = [];
    let withdraw = [0,0,0,0,0,0,0];
    let earning = [0,0,0,0,0,0,0];
    let monWithdraw = 0, monEarnings = 0;
    let tueWithdraw = 0, tueEarnings = 0;
    let wedWithdraw = 0, wedEarnings = 0;
    let thurWithdraw = 0, thurEarnings = 0;
    let friWithdraw = 0, friEarnings = 0;
    let satWithdraw = 0, satEarnings = 0;
    let sunWithdraw = 0, sunEarnings = 0;
    let sumEarning = 0;
    let sumWithdraw = 0;

    for(let i = 1; i <= 7; i++) {
      let first = curr.getDate() - curr.getDay() + i;
      let day = new Date(curr.setDate(first)).toISOString().slice(0, 10);
      week.push(day);
    }

    transactions.forEach(x => {
      const date  = new Date(x.created_at);
      const currentDayOfMonth = ('0' + date.getUTCDate()).slice(-2);
      const currentMonth = ('0' + (date.getUTCMonth()+1)).slice(-2); 
      const currentYear = date.getUTCFullYear();

      const dateString = currentYear + "-" + (currentMonth) + "-" + currentDayOfMonth;
      
      if(dateString === week[0]) {
          monWithdraw = monWithdraw + x.amount;
          withdraw[0] = monWithdraw;
          monEarnings =monEarnings + x.fee;
          earning[0] = monEarnings;
      }

      if(dateString === week[1]) {
          tueWithdraw = tueWithdraw + x.amount;
          withdraw[1] = tueWithdraw;
          tueEarnings =tueEarnings + x.fee;
          earning[1] = tueEarnings;
      }

      if(dateString === week[2]) {
          wedWithdraw = wedWithdraw + x.amount;
          withdraw[2] = wedWithdraw;
          wedEarnings =wedEarnings + x.fee;
          earning[2] = wedEarnings;
      }

      if(dateString === week[3]) {
          thurWithdraw = thurWithdraw + x.amount;
          withdraw[3] = thurWithdraw;
          thurEarnings =thurEarnings + x.fee;
          earning[3] = thurEarnings;
      }

      if(dateString === week[4]) {
          friWithdraw = friWithdraw + x.amount;
          withdraw[4] = friWithdraw;
          friEarnings =friEarnings + x.fee;
          earning[4] = friEarnings;
      }

      if(dateString === week[5]) {
          satWithdraw = satWithdraw + x.amount;
          withdraw[5] = satWithdraw;
          satEarnings =satEarnings + x.fee;
          earning[5] = satEarnings;
      }

      if(dateString === week[6]) {
          sunWithdraw = sunWithdraw + x.amount;
          withdraw[6] = sunWithdraw;
          sunEarnings =sunEarnings + x.fee;
          earning[6] = sunEarnings;
      }
    });

    var options = {
        chart: {
            height: 230,
            type: "line",
            shadow: {
                enabled: true,
                color: "#000",
                top: 18,
                left: 7,
                blur: 10,
                opacity: 1
            },
            toolbar: {
                show: false
            }
        },
        colors: ["#3dc7be", "#ffa117"],
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: "smooth"
        },
        series: [{
            name: "Earning",
            data: earning
        },
        {
            name: "Withdraw",
            data: withdraw
        }
        ],
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                opacity: 0.0
            }
        },
        markers: {
            size: 6
        },
        xaxis: {
            categories: ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun"],

            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            title: {
                text: "Income"
            },
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            },
            min: 0,
            max: 100000
        },
        legend: {
            position: "top",
            horizontalAlign: "right",
            floating: true,
            offsetY: -25,
            offsetX: -5
        }
    };

    for(let e = 0; e < earning.length; e++) {
        sumEarning += earning[e];
    }

    for(let w = 0; w < withdraw.length; w++) {
        sumWithdraw += withdraw[w];
    }

    document.getElementById("earning").innerText = new Intl.NumberFormat().format(sumEarning);
    document.getElementById("withdraw").innerText = new Intl.NumberFormat().format(sumWithdraw);
    var chart = new ApexCharts(document.querySelector("#chart1"), options);

    chart.render();
}

function chart2() {
    var options = {
        chart: {
            height: 250,
            type: 'bar',
            stacked: true,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '200px',
            },
        },
        series: [{
            name: 'PRODUCT A',
            data: [44, 55, 41, 67, 22, 43]
        }, {
            name: 'PRODUCT B',
            data: [13, 23, 20, 8, 13, 27]
        }, {
            name: 'PRODUCT C',
            data: [11, 17, 15, 15, 21, 14]
        }],
        xaxis: {
            type: 'datetime',
            categories: ['01/01/2019 GMT', '01/02/2019 GMT', '01/03/2019 GMT', '01/04/2019 GMT', '01/05/2019 GMT', '01/06/2019 GMT'],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            }
        },
        legend: {
            position: 'top',
            offsetY: 40,
            show: false,
        },
        fill: {
            opacity: 1
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#chart2"),
        options
    );

    chart.render();

}

function chart3() {
    var options = {
        chart: {
            height: 250,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            },

        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: [5, 7, 5],
            curve: 'straight',
            dashArray: [0, 8, 5]
        },
        series: [{
            name: "Option 1",
            data: [45, 52, 38, 24, 33, 26, 21, 20]
        },
        {
            name: "Option 2",
            data: [35, 41, 62, 42, 13, 18, 29, 37]
        },
        {
            name: 'Option 3',
            data: [87, 57, 74, 99, 75, 38, 62, 47]
        }
        ],
        legend: {
            show: false,
        },
        markers: {
            size: 0,

            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug'
            ],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            }
        },
        tooltip: {

        },
        grid: {
            borderColor: '#f1f1f1',
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#chart3"),
        options
    );

    chart.render();
}
function chart4() {
    var options = {
        chart: {
            height: 250,
            type: 'area',
            toolbar: {
                show: false
            },

        },
        colors: ['#999b9c', '#4CC2B0'], // line color
        fill: {
            colors: ['#999b9c', '#4CC2B0'] // fill color
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        markers: {
            colors: ['#999b9c', '#4CC2B0'] // marker color
        },
        series: [{
            name: 'series1',
            data: [31, 40, 28, 51, 22, 64, 80]
        }, {
            name: 'series2',
            data: [11, 32, 67, 32, 44, 52, 41]
        }],
        legend: {
            show: false,
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July'],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            },
        },
        yaxis: {
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#chart4"),
        options
    );

    chart.render();

}