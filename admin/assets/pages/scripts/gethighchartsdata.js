/*
 Highcharts JS Data API (2016-12-07)

 (c) 2009-2016 Wagura Maurice

 License: www.waguramaurice.cf
*/

$(function () {
var chart;
$(document).ready(function() {
$.getJSON("http://localhost/iebc_kambo/admin/inc/data.php", function(json) {
$.getJSON("http://localhost/iebc_kambo/admin/inc/data2.php", function(data) {
chart = new Highcharts.Chart({
chart: {
renderTo: 'container',
type: 'column',
marginRight: 130,
marginBottom: 25
},
title: {
text: 'Candidates Ratio',
x: -20 //center
},
subtitle: {
text: '',
x: -20
},
xAxis: {
categories: ['Elective Candidates']
},
yAxis: {
title: {
text: 'Candidates'
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
tooltip: {
formatter: function() {
return '<strong>'+ this.series.name +'</strong><br/>'+
this.x +': '+ this.y;
}
},
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -10,
y: 100,
borderWidth: 0
},
series: json
});

})});

});

});