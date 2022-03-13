/*
     * Create:cherry(2022/01/12)
     * Update:cherry(2022/01/14)
     * This function is used to show Yearly Order Chart using apex chart.
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
      text: 'Yearly Order Sales',
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
      categories: orderYearly, // to show years in x-axis
      title: {
        text: 'Years',
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
     * Create:cherry(2022/01/12)
     * Update:cherry(2022/01/14)
     * This function is used to show Yearly Coin Chart using apex chart.
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
    text: 'Yearly Coin Sales',
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
    categories: coinYearly, // to show years in x-axis
    title: {
      text: 'Years'
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


