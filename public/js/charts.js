import Chart from 'chart.js/auto';

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
