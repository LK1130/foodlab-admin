// {{-- For Sending Order Array to Order rangeChart.js --}}
let orderArray;
// {{-- For Sending Coin Array to Coin rangeChart.js --}}
let coinArray;
// {{-- For Sending order Array to Order rangeChart.js --}}
let orderDaily;
// {{-- For Sending  coin Array to  Coin rangeChart.js --}}
let coinDaily;

// let checkTable = () => {
//     if ($('#orderRow').length != 0) {
//         document.getElementById('ordertable').style.display = 'flex';
//     } else {
//         document.getElementById('ordertable').style.display = 'none';
//     }

//     if ($('#coinRow').length != 0) {
//         document.getElementById('cointable').style.display = 'flex';
//     } else {
//         document.getElementById('cointable').style.display = 'none';
//     }
// }
// checkTable();
rangeChart123();
document.getElementById('rangeSearchSubmit').addEventListener('click', (e) => {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
            },
        });
        let order = document.getElementById('orders');
        let date = {
            "fromDate": `${document.getElementById('start-date').value}`,
            "toDate": ` ${document.getElementById('end-date').value}`
        };

        $.ajax({
            type: "POST",
            url: "/rangeChart",
            data: { data: date },
            success: function(res) {
                // console.log(res);
                orderArray = res[3];
                coinArray = res[1];
                orderDaily = res[2];
                coinDaily = res[0];
                rangeChart123();
                console.log(orderArray);
                console.log(coinArray);
                console.log(res[3]);
                console.log(res[1]);
                let totalOrder = 0,
                    totalCoin = 0;
                for (let i = 0; i < res[3].length; i++) {
                    totalOrder += res[3][i];
                }
                for (let x = 0; x < res[1].length; x++) {
                    totalCoin += res[1][x];
                }
                if ($('#orderRow').length != 0) {
                    $('#orders').empty();
                }
                if ($('#coinRow').length != 0) {
                    $('#coins').empty();
                }
                $('#orders').append(`
                  <tr id='orderRow'>
                    <th>${document.getElementById('start-date').value}</th>
                    <th>${document.getElementById('end-date').value}</th>
                    <th>${totalOrder}</th>
                  </tr>
                  `);

                $('#coins').append(`
                  <tr id='coinRow'>
                    <th>${document.getElementById('start-date').value}</th>
                    <th>${document.getElementById('end-date').value}</th>
                    <th>${totalCoin}</th>
                  </tr>
                  `);
                // checkTable();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
            },
            error: function(err) {
                console.log(err);
            },
        });
    })
    /*
     * Create:cherry(2022/01/13)
     * Update:cherry(2022/01/14)
     * This function is used to show searching Order list with chart using apex chart.
     */

    function rangeChart123(){
var options = {
    series: [{
        name: "Order Transaction",
        data: orderArray
    }, ],
    chart: {
        height: 400,
        type: 'line',
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.5
        },
        toolbar: {
            show: true
        }
    },
    colors: ['#77B6EA'],
    dataLabels: {
        enabled: true,
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Order Sales',
        align: 'left'
    },
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {
        size: 1
    },
    xaxis: {
        categories: orderDaily, // to show dates in x-axis
        title: {
            text: 'Dates'
        }
    },
    yaxis: {
        title: {
            text: 'Amount'
        },
        min: 0
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
};

var chart = new ApexCharts(document.getElementById("chart"), options);
chart.render();
/*
 * Create:cherry(2022/01/13)
 * Update:cherry(2022/01/14)
 * This function is used to show searching Coin lists with Chart using apex chart.
 */


var options1 = {
    series: [{
        name: "Coin",
        data: coinArray
    }],
    chart: {
        height: 400,
        type: 'line',
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
        },
        toolbar: {
            show: true
        }
    },
    colors: ['#ffa600'],
    dataLabels: {
        enabled: true,
    },
    stroke: {
        curve: 'smooth'
    },
    title: {
        text: 'Coin Sales',
        align: 'left'
    },
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {
        size: 1
    },
    xaxis: {
        categories: coinDaily, // to show dates in x-axis
        title: {
            text: 'Dates'
        }
    },
    yaxis: {
        title: {
            text: 'Amount'
        },
        min: 0
    },
    legend: {
        position: 'bottom',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
};
var chart1 = new ApexCharts(document.getElementById("chart1"), options1);
chart1.render();}