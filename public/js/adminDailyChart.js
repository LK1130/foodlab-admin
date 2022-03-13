/*
     * Create:cherry(2022/01/13)
     * Update:cherry(2022/01/14)
     * This function is used to show daily Order Chart using apex chart.
     */
var options = {
    series: [
      {
        name: "Order Transaction",
        data: orderArray
      },
    ],
    chart: {
      height:400,
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
    colors: ['#77B6EA'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: 'smooth'
    },
    title: {
      text: 'Daily Order Sales',
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
     * This function is used to show Daily Coin Chart using apex chart.
     */
var options1 = {
      series: [
        {
          name: "Coin",
          data: coinArray
        }
      ],
    chart: {
      height:400,
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
      text: 'Daily Coin Sales',
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
  chart1.render();


