<html>
<body>
<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1',
                                                                 'packages':['corechart']}]}"></script>
<script>
google.setOnLoadCallback(drawChart);
function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'x');
    data.addColumn('number', 'values');
    data.addColumn({id:'i0', type:'number', role:'interval'});
    data.addColumn({id:'i1', type:'number', role:'interval'});
    data.addColumn({id:'i2', type:'number', role:'interval'});
    data.addColumn({id:'i2', type:'number', role:'interval'});
    data.addColumn({id:'i2', type:'number', role:'interval'});
    data.addColumn({id:'i2', type:'number', role:'interval'});

    data.addRows([
        ['a', 100, 90, 110, 85, 96, 104, 120],
        ['b', 120, 95, 130, 90, 113, 124, 140],
        ['c', 130, 105, 140, 100, 117, 133, 139],
        ['d', 90, 85, 95, 85, 88, 92, 95],
        ['e', 70, 74, 63, 67, 69, 70, 72],
        ['f', 30, 39, 22, 21, 28, 34, 40],
        ['g', 80, 77, 83, 70, 77, 85, 90],
        ['h', 100, 90, 110, 85, 95, 102, 110]]);

    // The intervals data as narrow lines (useful for showing raw source
    // data)
    var options_lines = {
        title: 'Line intervals, default',
        curveType:'function',
        lineWidth: 2,
        intervals: { 'style':'line' }, // Use line intervals.
        legend: 'none',
    };

    var chart_lines = new google.visualization.LineChart(document.getElementById('chart_lines'));
    chart_lines.draw(data, options_lines);
}
</script>
<div id="chart_lines" style="width: 900px; height: 500px;"></div>
</body>
</html>