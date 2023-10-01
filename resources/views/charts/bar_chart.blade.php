<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.head-tags')
        <title> charts </title>
    </head>

    <body class="add-commodity-body">

        @include('layout.main-header')

        <div class="container-fluid px-0 pps-content">



            <main class="pps-main-content">

                <div class="add-commodity-form scrollable-list">


                    <div class="form--header">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <img class="form--brand" src="{{asset('images/admin-dark.ico') }}" alt="">
                        <h1 class="form--title">Charts</h1>
                    </div>

                    <div class="pps-commodities">
                        <div class="flex flex-col--wrap scrollable-list">

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart1">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart2">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="lineChart1">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="mixedChart1">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="pieChart1">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="doughnutChart1">

                                    </canvas>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>

            </main>
        </div>

        @include('layout.main-footer')


        @include('layout.script-tags')

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            $(function(){
                var months = <?php echo json_encode($months); ?>;
                var monthCount = <?php echo json_encode($monthCount); ?>;
                var barCanvas = $("#barChart1");
                var barChart = new Chart(barCanvas, {
                    type: 'bar',
                    data:{
                        labels: months,
                        datasets:[{
                            label: "Bar",
                            data: monthCount,
                            {{--  background: [],  --}}
                        }],
                    },
                    options:{
                        scales:{
                            y:{
                                ticks:{
                                    beginAtZero:true
                                }
                            },
                        }
                    }
                });
            });

            $(function(){
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var barCanvas = $("#barChart2");
                var barChart = new Chart(barCanvas, {
                    type: 'bar',
                    data:{
                        labels: commodities,
                        datasets:[{
                            label: "Commodity Quantity",
                            data: commodityQty,
                            {{--  background: [],  --}}
                            borderWidth: 1,
                            width: 5,
                        }],
                    },
                    options:{
                        scales:{
                            y:{
                                ticks:{
                                    beginAtZero:true
                                }
                            },
                        }
                    }
                });
            });

            $(function(){
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var barCanvas = $("#lineChart1");
                var barChart = new Chart(barCanvas, {
                    type: 'line',
                    data:{
                        labels: commodities,
                        datasets:[{
                            label: "Commodity Quantity",
                            data: commodityQty,
                            fill: false,
                            tension: 0.1,
                            borderColor: 'rgb(75, 192, 192)',
                        }],
                    },

                });
            });

            $(function(){
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var barCanvas = $("#mixedChart1");
                var barChart = new Chart(barCanvas, {
                    data:{
                        datasets: [{
                            type: 'bar',
                            label: "Commodity Quantity",
                            data: commodityQty,
                            borderWidth: 1,
                            backgroundColor: 'indigo'
                        }, {
                            type: 'line',
                            label: "Commodity Quantity",
                            data: commodityQty,
                            borderWidth: 1,
                            fill: false,
                            tension: 0.1,
                            borderColor: 'red',
                            borderWidth: 2,
                        }],
                        labels: commodities,
                    },
                    options:{
                        scales:{
                            y:{
                                ticks:{
                                    beginAtZero:true
                                }
                            },
                        }
                    }
                });
            });

            $(function(){
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var barCanvas = $("#pieChart1");
                var barChart = new Chart(barCanvas, {
                    type: 'pie',
                    data:{
                        labels: commodities,
                        datasets:[{
                            label: "Commodity Quantity",
                            data: commodityQty,
                            borderColor: 'rgb(75, 192, 192)',
                            hoverOffset: 4,
                        }],
                    },

                });
            });

            $(function(){
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var barCanvas = $("#doughnutChart1");
                var barChart = new Chart(barCanvas, {
                    type: 'doughnut',
                    data:{
                        labels: commodities,
                        datasets:[{
                            label: "Commodity Quantity",
                            data: commodityQty,
                            borderColor: 'rgb(75, 192, 192)',
                            hoverOffset: 4,
                        }],
                    },

                });
            });

        </script>

    </body>
</html>
