<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {literal}
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data_chart = {/literal}{foreach from=$chart item=item}
                                                {$item}
                                            {/foreach}{literal};
                var data = new google.visualization.arrayToDataTable(data_chart);
                data.addColumn('string', 'Status');
                data.addColumn('number', 'Percentage');
                var options = {
                    title: 'My Daily Activities'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
    {/literal}
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>

<input type="hidden"  id="dataChart" value="{$chart}"></input>
{foreach from=$chart item=item}
{$item}
{/foreach}
</body>
</html>
