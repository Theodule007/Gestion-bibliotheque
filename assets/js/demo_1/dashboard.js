(function ($) {

  // Doughnut chart
  $.ajax({
  url: "http://localhost:8888/app/functions/get_doughnut_chart_data.php",
  method: "GET",
  success: function(data){
  var doughnut_chart_labels = [];
  var doughnut_chart_data = [];
  var json_string = JSON.parse(data);
  for (const property in json_string) {
  doughnut_chart_labels.push(property);
  doughnut_chart_data.push(json_string[property])
  }
  
  'use strict';
  $(function () {
  if ($("#doughnutChart").length) {
  var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
  var doughnutPieData = {
  datasets: [{
  data: doughnut_chart_data,
  backgroundColor: [
  ChartColor[0],
  ChartColor[1],
  ChartColor[2],
  ChartColor[3],
  ChartColor[5],
  ],
  borderColor: [
  ChartColor[0],
  ChartColor[1],
  ChartColor[2],
  ChartColor[3],
  ChartColor[5]
  ],
  }],
  
  labels: doughnut_chart_labels
  };
  
  var doughnutPieOptions = {
  cutoutPercentage: 75,
  animationEasing: "easeOutBounce",
  animateRotate: true,
  animateScale: false,
  responsive: true,
  maintainAspectRatio: true,
  showScale: true,
  legend: false,
  
  legendCallback: function (chart) {
  var text = [];
  text.push('<div class="chartjs-legend"><ul>');
  for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
  text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
  text.push('</span>');
  if (chart.data.labels[i]) {
  text.push(chart.data.labels[i]);
  }
  text.push('</li>');
  }
  text.push('</div></ul>');
  return text.join("");
  },
  layout: {
  padding: {
  left: 0,
  right: 0,
  top: 0,
  bottom: 0
  }
  }
  };
  var doughnutChart = new Chart(doughnutChartCanvas, {
  type: 'doughnut',
  data: doughnutPieData,
  options: doughnutPieOptions
  });
  document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
  }
  
  });
  
  },
  error: function(data){},
  
  });
  
  // End doughnut chart
  
  // Stacked bar chart
  var stacked_bar_labels = [];
  var stacked_bar_distributed_data = [];
  var stacked_bar_received_data = [];
  $.ajax({
  url: "http://localhost:8888/app/functions/get_stacked_barchart_data.php",
  method: "GET",
  success: function(data){
  var newArr = JSON.parse(data);
  var arrayLength = newArr.length;
  for (var i = 0; i < arrayLength; i++) {
  stacked_bar_labels.push(newArr[i].category);
  stacked_bar_distributed_data.push(newArr[i].distribute_total);
  stacked_bar_received_data.push(newArr[i].receive_total);
  
  }
  'use strict';
  $(function () {
  if ($("#stackedbarChart").length) {
  var stackedbarChartCanvas = $("#stackedbarChart").get(0).getContext("2d");
  var stackedbarChart = new Chart(stackedbarChartCanvas, {
  type: 'bar',
  data: {
  labels: stacked_bar_labels,
  datasets: [{
  label: "Distributed",
  backgroundColor: ChartColor[0],
  borderColor: ChartColor[0],
  borderWidth: 1,
  data: stacked_bar_distributed_data
  },
  {
  label: "Received",
  backgroundColor: ChartColor[1],
  borderColor: ChartColor[1],
  borderWidth: 1,
  data: stacked_bar_received_data
  }
  ]
  },
  options: {
  responsive: true,
  maintainAspectRatio: true,
  legend: false,
  categoryPercentage: 0.5,
  stacked: true,
  layout: {
  padding: {
  left: 0,
  right: 0,
  top: 0,
  bottom: 0
  }
  },
  scales: {
  xAxes: [{
  display: true,
  scaleLabel: {
  display: true,
  labelString: 'Item Categories',
  fontSize: 12,
  lineHeight: 2
  },
  ticks: {
  fontColor: '#bfccda',
  stepSize: 50,
  min: 0,
  max: 150,
  autoSkip: true,
  autoSkipPadding: 15,
  maxRotation: 0,
  maxTicksLimit: 10
  },
  gridLines: {
  display: false,
  drawBorder: false,
  color: 'transparent',
  zeroLineColor: '#eeeeee'
  }
  }],
  yAxes: [{
  display: true,
  scaleLabel: {
  display: true,
  labelString: 'Quantity distributed and received',
  fontSize: 12,
  lineHeight: 2
  },
  ticks: {
  fontColor: '#bfccda',
  stepSize: 50,
  min: 0,
  max: 500,
  autoSkip: true,
  autoSkipPadding: 15,
  maxRotation: 0,
  maxTicksLimit: 10
  },
  gridLines: {
  drawBorder: false
  }
  }]
  },
  legend: {
  display: false
  },
  
  legendCallback: function (chart) {
  var text = [];
  text.push('<div class="chartjs-legend"><ul>');
  for (var i = 0; i < chart.data.datasets.length; i++) {
  // console.log(chart.data.datasets[i]); // see what's inside the obj.
  text.push('<li>');
  text.push('<span style="background-color:' + chart.data.datasets[i].backgroundColor + '">' + '</span>');
  text.push(chart.data.datasets[i].label);
  text.push('</li>');
  }
  text.push('</ul></div>');
  return text.join("");
  },
  elements: {
  point: {
  radius: 0
  }
  }
  }
  });
  document.getElementById('stacked-bar-traffic-legend').innerHTML = stackedbarChart.generateLegend();
  }
  
  // End stacked bar chart
  
  });
  
  },
  error: function(data){},
  
  });
  
  })(jQuery);