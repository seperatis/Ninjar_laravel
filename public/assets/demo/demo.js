type = ['', 'info', 'success', 'warning', 'danger'];

stats = {

    formatter: function (value, decimal, unit) {
        if (value === 0) {
            return "0 " + unit;
        } else {
            var si = [
                {value: 1, symbol: ""},
                {value: 1e3, symbol: "k"},
                {value: 1e6, symbol: "M"},
                {value: 1e9, symbol: "G"},
                {value: 1e12, symbol: "T"},
                {value: 1e15, symbol: "P"},
                {value: 1e18, symbol: "E"},
                {value: 1e21, symbol: "Z"},
                {value: 1e24, symbol: "Y"}
            ];
            for (var i = si.length - 1; i > 0; i--) {
                if (value >= si[i].value) {
                    break;
                }
            }
            return ((value / si[i].value).toFixed(decimal).replace(/\.0+$|(\.[0-9]*[1-9])0+$/, "$1") + " " + si[i].symbol + unit);
        }
    },

    convertUTCDateToLocalDate: function (date) {
        var newDate = new Date(date.getTime() + date.getTimezoneOffset() * 60 * 1000);
        var localOffset = date.getTimezoneOffset() / 60;
        var hours = date.getUTCHours();
        newDate.setHours(hours - localOffset);
        return newDate;
    },

    convertLocalDateToUTCDate: function (date, toUTC) {
        date = new Date(date);
        //Local time converted to UTC
        var localOffset = date.getTimezoneOffset() * 60000;
        var localTime = date.getTime();
        if (toUTC) {
            date = localTime + localOffset;
        } else {
            date = localTime - localOffset;
        }
        newDate = new Date(date);
        return newDate;
    },

    initDashboardPageCharts: function () {
        var source_data = $('#data').val();
        var source_chart_data = JSON.parse(source_data);
        poolHashRate = [];
        poolHashRate_unit = '';
        networkHashRate = [];
        networkHashRate_unit = '';
        networkDifficulty = [];
        networkDifficulty_unit = '';
        connectedMiners = [];
        connectedMiners_unit = '';
        connectedWorkers = [];
        connectedWorkers_unit = '';
        labels = [];

        $.each(source_chart_data, function (index, value) {
            var createDate = stats.convertLocalDateToUTCDate(new Date(value.created), false);
            labels.push(createDate.getHours() + ":00");
            spliter = stats.formatter(value.poolHashrate, 2, '').split(' ');
            poolHashRate.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                poolHashRate_unit = spliter[1];
            }

            spliter = stats.formatter(value.networkHashrate, 2, '').split(' ');
            networkHashRate.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                networkHashRate_unit = spliter[1];
            }

            spliter = stats.formatter(value.networkDifficulty, 2, '').split(' ');
            networkDifficulty.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                networkDifficulty_unit = spliter[1];
            }

            spliter = stats.formatter(value.connectedMiners, 2, '').split(' ');
            connectedMiners.push(parseFloat(stats.formatter(value.connectedMiners, 2, '').split(' ')[0]));
            if (spliter[1]) {
                connectedMiners_unit = spliter[1];
            }

            spliter = stats.formatter(value.connectedWorkers, 2, '').split(' ');
            connectedWorkers.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                connectedWorkers_unit = spliter[1];
            }
        });
        id = 'pool_hashrate_chart';
        chart_title = 'Pool Hashrate';
        stats.initChart(id, labels, poolHashRate, poolHashRate_unit, chart_title);
        id = 'miner_chart';
        chart_title = 'Miners';
        stats.initChart(id, labels, connectedMiners, connectedMiners_unit, chart_title);
        id = 'network_hashrate_chart';
        chart_title = 'Network Hashrate';
        stats.initChart(id, labels, networkHashRate, networkHashRate_unit, chart_title);
        id = 'network_difficulty_chart';
        chart_title = 'Network Hashrate';
        stats.initChart(id, labels, networkDifficulty, networkDifficulty_unit, chart_title);

    },

    initChart: function (id, labels, data, unit, chart_title) {

        gradientChartOptionsConfigurationWithTooltipBlue = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.0,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#2380f7",
                        callback: function (value, index, values) {
                            return value + unit;
                        }
                    },
                }],

                xAxes: [{
                    barPercentage: 1.0,
                    gridLines: {
                        drawBorder: true,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#2380f7"
                    }
                }]
            }
        };
        var ctx = document.getElementById(id).getContext('2d');
        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.1)');
        gradientStroke.addColorStop(0.4, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors


        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: chart_title,
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#d346b1',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#d346b1',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#d346b1',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: data,
                }]
            },
            options: gradientChartOptionsConfigurationWithTooltipBlue
        };
        var myChartData = new Chart(ctx, config);
    },
};

miners = {
    loadMinerChart: function () {
        miners_data = JSON.parse($('#miners').val());
        labels = [];
        rate_data = [];
        sharesPerSecond_data = [];
        hashrate_unit = '';
        sharesPerSecond_unit = '';
        $.each(miners_data, function (index, value) {
            labels.push('.. .. ' + value.miner.substring(value.miner.length - 10, value.miner.length));

            spliter = stats.formatter(value.hashrate, 2, '').split(' ');
            rate_data.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                hashrate_unit = spliter[1];
            }

            spliter = stats.formatter(value.sharesPerSecond, 3, '').split(' ');
            sharesPerSecond_data.push(parseFloat(spliter[0]));
            if (spliter[1]) {
                sharesPerSecond_unit = spliter[1];
            }
        });
        id = 'hashrate';
        color = '';
        miners.initBarChart(labels, rate_data, hashrate_unit, id, 'rgba(29,140,248,0.8)', 'rgba(29,140,248,0.1)');
        id = "sharesPerSecond";
        miners.initBarChart(labels, sharesPerSecond_data, sharesPerSecond_unit, id, 'rgba(225,78,202,0.8)', 'rgba(225,78,202,0.1)');
    },
    initBarChart: function (labels, data, unit, id, color1, color2) {
        gradientBarChartConfigurationWithGrid = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest",

            },
            responsive: true,
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(253,93,147,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        beginAtZero: true,
                        padding: 20,
                        fontColor: "#9e9e9e",
                        callback: function (value, index, values) {
                            return value + unit;
                        }
                    }
                }],

                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(253,93,147,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }]
            }
        };


        var ctx = document.getElementById(id).getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, color1);
        gradientStroke.addColorStop(0, color2); //blue colors


        var myChart = new Chart(ctx, {
            type: 'bar',
            responsive: true,
            data: {
                labels: labels,
                datasets: [{
                    label: id,
                    fill: true,
                    backgroundColor: gradientStroke,
                    hoverBackgroundColor: gradientStroke,
                    borderColor: color1,
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    data: data,
                }]
            },
            options: gradientBarChartConfigurationWithGrid
        });
    }
}
