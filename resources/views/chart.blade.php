@extends('layout')

@section('content')
    <div id="app" style="width:100%; height:400px;"></div>
@endsection

@section('custom_js')
    <script>

        var app = new Vue({
            el: '#app',
            data: {},
            mounted: function(){
                this.fetchWeeklyDataForChart();
            },
            methods: {
                fetchWeeklyDataForChart: function () {

                    axios.get('/chartdata')
                        .then(function (response) {

                            if (typeof response.data[0] != 'undefined') {

                                //prepping data
                                var dataForSeries = [];
                                for (var i in response.data[0]) {
                                    obj = new Object();
                                    obj.name = response.data[0][i].week_start_date;
                                    obj.data = [
                                        Number(response.data[0][i].cohort_size),
                                        response.data[0][i].activate_account,
                                        response.data[0][i].profile_information,
                                        response.data[0][i].jobs_interested,
                                        response.data[0][i].experience,
                                        response.data[0][i].freelancer,
                                        response.data[0][i].freelancer,
                                        response.data[0][i].approval
                                    ];

                                    dataForSeries.push(obj);
                                }

                                //drawing the chart
                                var app = new Vue({
                                    el: '#app',
                                    data: {},
                                    mounted: function(){
                                        Highcharts.chart('app', {
                                            chart: {
                                                type: 'spline'
                                            },
                                            title: {
                                                text: 'User Retention'
                                            },
                                            xAxis: {
                                                categories: [
                                                    'Create account',
                                                    'Activate account',
                                                    'Provide profile information',
                                                    'What jobs are you interested in ?',
                                                    'Do you have relevant experience in these jobs ?',
                                                    'Are you freelancer ?',
                                                    'Waiting for approval',
                                                    'Approval'
                                                ]
                                            },
                                            yAxis: {
                                                title: {
                                                    text: 'Precentage of users'
                                                }
                                            },
                                            series: dataForSeries
                                        });
                                    },
                                });
                            } else {

                                alert('No data');
                            }

                        })
                        .catch(function (error) {
                            console.log(error);
                            alert('Something went wrong');
                        });
                }
            }
        });
    </script>
@endsection