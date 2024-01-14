{{--  @extends('layout.app')

@section('content')





@endsection  --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grocery POS system - Welcome @auth {{ auth()->user()->name }} @endauth</title>
        @include('layout.head-tags')
    </head>
    <body>
        @include('layout.main-header')

        @include('layout.menu-bar-toggler')

        <div class="container-fluid px-0 pps-content">

            <div class="pps-aside">
                @include('layout.main-sidebar')
                @include('layout.main-sidebar-wide')
                @include('layout.main-icon-sidebar')
            </div>

            <main class="pps-main-content">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show text-wrap" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="pps-main-content-header">
                    <span class="icon-container icon--circle">
                        <img class="icon" src="{{ asset('images/dashboard-dark.ico') }}" alt="">
                    </span>
                    <h2 class="pps-main-content-title">

                        Dashboard

                        @if( auth()->user()->businesses !== null )
                            | {{ auth()->user()->businesses->name }}
                        @else
                            unregistered business
                        @endif

                    </h2>
                </div>

                <div class="pps-main-content-body">

                    <nav class="pps-body-nav">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Visual Charts</button>
                            <button class="nav-link" id="nav-category-tab" data-bs-toggle="tab" data-bs-target="#nav-category" type="button" role="tab" aria-controls="nav-category" aria-selected="true">Category</button>

                        </div>
                    </nav>

                    <div class="tab-content pps-body-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            <div class="pps-commodities">

                                <div class="flex flex-col--wrap">

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of times items were bought per month</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart1"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number or Level of Quantity of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart2"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Total sales amount of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart3"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of times customer bought item(s)</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart4"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of times item(s) were bought from supplier</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart5"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of item(s) acquired in a month</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart6"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of times item(s) were sold in a month</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart7"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Bar Graph</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number of times an item has sold</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="barChart8"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Line Chart</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number or Level of Quantity of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="lineChart1"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Mixed Chart</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number or Level of Quantity of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="mixedChart1"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Pie Chart</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number or Level of Quantity of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="pieChart1"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="commodity">
                                        <div class="card card--secondary">
                                            <header class="card__header">
                                                <div class="commodity__icon">
                                                    <img class="icon" src="{{ asset('images/charts-dark.ico') }}" alt="">
                                                    <h3 class="commodity__name">Doughnut Pie Chart</h3>
                                                </div>
                                                <div class="commodity__tags">
                                                    <span class="commodity__description">Number or Level of Quantity of an item</span>
                                                </div>
                                            </header>
                                            <div class="card__body">

                                                <canvas id="doughnutChart1"></canvas>

                                            </div>
                                        </div>
                                    </div>

                                    @if( auth()->user()->businesses()->count() )
                                        @forelse ($user_commodities as $commodity)
                                            @if ($commodity->business_id == auth()->user()->businesses->id)
                                                <x-commodity :commodity="$commodity" />
                                            @endif
                                        @empty
                                            <div class="commodity">
                                                <p> {{ auth()->user()->name }}, your inventory list is empty </p>

                                                <button class="btn btn--primary btn--icon btn--outline">
                                                    <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                                                    <span class="btn__text">
                                                        <a class="nav-link" href="{{ route('home.create') }}">Add</a>
                                                    </span>
                                                </button>
                                            </div>
                                        @endforelse
                                    @else
                                        unregistered business
                                    @endif


                                </div>

                            </div>

                        </div>

                        <div class="tab-pane fade show" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">

                            <div class="pps-commodities">

                                <div class="flex flex-col--wrap scrollable-list">
                                    @if( auth()->user()->businesses()->count() )
                                        @forelse (auth()->user()->categories as $category)
                                        <div class="commodity">
                                            <div class="card">
                                                <header class="card__header">
                                                    <div class="commodity__icon">

                                                        <h3 class="commodity__name">{{  $category->name }}</h3>
                                                    </div>
                                                </header>

                                                <div class="card__body">
                                                    <span class="commodity__acquisition-date">
                                                        <span class="acquisition-text">Created On</span>
                                                            <span class="badge acquisition-date">{{ date('d-m-Y', strtotime($category->created_at)) }}</span>
                                                    </span>
                                                    <span class="commodity__category">
                                                        <span class="category-text">Commodity (s) :</span>
                                                        <div class="category-values">
                                                            @forelse ($category->Commodities as $commodity)
                                                                <a href="{{ route('home.show', $commodity->id) }}" class="link">
                                                                    <span class="badge category-value">{{ $commodity -> name }}</span>
                                                                </a>
                                                            @empty
                                                                <span class="badge category-value">no comodities</span>
                                                            @endforelse
                                                        </div>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            <div class="commodity">
                                                <p> {{ auth()->user()->name }}, you dont have any categories yet </p>

                                                <button class="btn btn--primary btn--icon btn--outline">
                                                    <img class="icon" src="{{ asset('images/add-commodity-dark.ico') }}" alt="">
                                                    <span class="btn__text">
                                                        <a class="nav-link" href="{{ route('category.create') }}">Add</a>
                                                    </span>
                                                </button>
                                            </div>
                                        @endforelse
                                    @else
                                        unregistered business
                                    @endif


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
                    var soldItems = <?php echo json_encode($soldItems); ?>;
                    var saleCount = <?php echo json_encode($saleCount); ?>;
                    var soldItemCount = <?php echo json_encode($soldItemCount); ?>;


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
                            labels: soldItems,
                            datasets:[{
                                label: "Commodity Sale Count per commodity ",
                                data: soldItemCount,
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

        </script>

    </body>
</html>
