<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Queries and Charts</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    @vite(['resources/css/card.css'])
</head>

<body>

    <header>
        <h1>Tracking Request Statistics</h1>
        <h3 style="color:#b91d47">
            On this page, there are some statistics that observed as a result of querying the database.
        </h3>
        <h5> - The first statistics query gives the number of requests in the last six months</h5>
        <h5> - The second statistics shows the eight most used carriers in the last six months</h5>
        <h5> - The last two statistics give the five most used ports of loading and
            five ports of discharges for a company</h5>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <canvas id="0" style="max-width: 100%">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <canvas id="1" style="max-width: 100%">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <canvas id="2" style="max-width: 100%">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="box">
                        <div class="content">
                            <canvas id="3" style="max-width: 100%">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var colors = ["#b91d47", "#00aba9", "#2b5797", "#1e7145", "#6b8e23", "#e97451",
            "#b91d47", "#00aba9", "#2b5797", "#1e7145", "red", "green", "blue", "orange", "brown",
            "black", "purple", "#9966cc"
        ];

        /*
        ready function parameters: chart type / chart title
        */
        ready("bar", "Monthly Tracking Request Count");
        ready("pie", "Most Used Carriers");
        ready("horizontalBar", "Most used Pol for X Company");
        ready("horizontalBar", "Most used Pod for X Company");

        var $queue = 0;

        function ready(type, text) {
            const labels = [];
            const values = [];

            $(document).ready(function() {
                $.ajax({
                    url: '/tracking-statistics',
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        for ($i = 0; $i < response['charts'][$queue]['label'].length; $i++) {
                            labels.push(response['charts'][$queue]['label'][$i]);
                            values.push(response['charts'][$queue]['value'][$i]);

                        }
                        console.log("labels query" + $queue + "=> " + labels);
                        console.log("values query" + $queue + "=> " + values);

                        chart_id = "" + $queue + "";

                        var chart = myChartFunction(chart_id, type, labels, values, text);

                        chart.options.legend.display = (chart_id == "1") ? true : false;

                        $queue = $queue + 1;

                    }
                });
            });
        }

        Chart.defaults.global.defaultFontColor = "#000";

        function myChartFunction(id, type, labels, values, text) {
            var barColors = colors.sort(() => Math.random() - 0.5);
            barColors = barColors.slice(0, labels.length);

            return new Chart(id, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: barColors,
                        data: values,
                    }]
                },
                options: {
                    title: {
                        display: true,
                        fontColor: "#b91d47",
                        text: text
                    }
                }

            });
        }
    </script>

</body>

</html>
