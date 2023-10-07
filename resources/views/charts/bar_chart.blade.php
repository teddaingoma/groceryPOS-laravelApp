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
                        <div class="flex flex-col--wrap">

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
                                    <canvas id="barChart3">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart4">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart5">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart6">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart7">

                                    </canvas>
                                </div>
                            </div>

                            <div class="commodity">
                                <div class="card">
                                    <canvas id="barChart8">

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

                        </div>

                        <div class="flex flex-col--wrap">

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


            </main>
        </div>

        @include('layout.main-footer')


        @include('layout.script-tags')

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            $(function(){

                var months = <?php echo json_encode($months); ?>;
                var monthCount = <?php echo json_encode($monthCount); ?>;
                var commodities = <?php echo json_encode($commodities); ?>;
                var commodityQty = <?php echo json_encode($commodityQty); ?>;
                var actualSales = <?php echo json_encode($actualSales); ?>;
                var customers = <?php echo json_encode($customers); ?>;
                var cusSellCount = <?php echo json_encode($cusSellCount); ?>;
                var suppliers = <?php echo json_encode($suppliers); ?>;
                var supPurchCount = <?php echo json_encode($supPurchCount); ?>;
                var acqDates = <?php echo json_encode($acqDates); ?>;
                var datesCount = <?php echo json_encode($datesCount); ?>;
                var saleMonths = <?php echo json_encode($saleMonths); ?>;
                var soldCommodities = <?php echo json_encode($soldCommodities); ?>;
                var saleCount = <?php echo json_encode($saleCount); ?>;
                var soldCommCount = <?php echo json_encode($soldCommCount); ?>;


                var barChart1 = $("#barChart1");
                var barChart2 = $("#barChart2");
                var barChart3 = $("#barChart3");
                var barChart4 = $("#barChart4");
                var barChart5 = $("#barChart5");
                var barChart6 = $("#barChart6");
                var barChart7 = $("#barChart7");
                var barChart8 = $("#barChart8");
                var lineChart1 = $("#lineChart1");
                var mixedChart1 = $("#mixedChart1");
                var pieChart1 = $("#pieChart1");
                var doughnutChart1 = $("#doughnutChart1");

                var barChart1 = new Chart(barChart1, {
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


                var barChart2 = new Chart(barChart2, {
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

                var barChart3 = new Chart(barChart3, {
                    type: 'bar',
                    data:{
                        labels: commodities,
                        datasets:[{
                            label: "Commodity Sales (MWK)",
                            data: actualSales,
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

                var barChart4 = new Chart(barChart4, {
                    type: 'bar',
                    data:{
                        labels: customers,
                        datasets:[{
                            label: "Customer Sell Count",
                            data: cusSellCount,
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

                var barChart5 = new Chart(barChart5, {
                    type: 'bar',
                    data:{
                        labels: suppliers,
                        datasets:[{
                            label: "Supplier Purchase Count",
                            data: supPurchCount,
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

                var barChart6 = new Chart(barChart6, {
                    type: 'bar',
                    data:{
                        labels: acqDates,
                        datasets:[{
                            label: "Commodity Purchase Count per month",
                            data: datesCount,
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

                var barChart7 = new Chart(barChart7, {
                    type: 'bar',
                    data:{
                        labels: saleMonths,
                        datasets:[{
                            label: "Commodity Sale Count per month",
                            data: saleCount,
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

                var barChart8 = new Chart(barChart8, {
                    type: 'bar',
                    data:{
                        labels: soldCommodities,
                        datasets:[{
                            label: "Commodity Sale Count per commodity ",
                            data: soldCommCount,
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

                var lineChart1 = new Chart(lineChart1, {
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

                var mixedChart1 = new Chart(mixedChart1, {
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

                var pieChart1 = new Chart(pieChart1, {
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

                var doughnutChart1 = new Chart(doughnutChart1, {
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

            $(function(){

            });

            $(function(){

            });

            $(function(){

            });

            $(function(){

            });

            $(function(){

            });

            $(function(){

            });

        </script>

    </body>
</html>
