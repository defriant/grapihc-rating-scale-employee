document.title = 'Pizza Hut - Dashboard Penilaian'

$('#periode-penilaian').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy-mm',
    onClose: function (dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
})

let chartPenilaian
let isSetPenilaianChart = false

function createPenilaianChart(res) {
    const chartLabel = res.data.map(v => v.nama)
    const chartData = res.data.map(v => v.total)

    $('#chart-penilaian').css('max-height', `${75 * res.data.length}px`)

    $('#tbody-penilaian').html(res.data.map(v => `<tr>
                                                    <td>${v.nama}</td>
                                                    <td>${v.total}</td>
                                                </tr>`))

    $('#chart-loader').hide()
    $('#row-penilaian').show()

    const ctx = document.getElementById('chart-penilaian')
    chartPenilaian = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabel,
            datasets: [{
                label: 'Skor',
                data: chartData,
                borderWidth: 3,
                borderColor: mainColor,
                backgroundColor: chartBarColor,
                barThickness: 25
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    isSetPenilaianChart = true
}

function updatePenilaianChart(res) {
    const chartLabel = res.data.map(v => v.nama)
    const chartData = res.data.map(v => v.total)

    $('#chart-penilaian').css('max-height', `${75 * res.data.length}px`)

    $('#tbody-penilaian').html(res.data.map(v => `<tr>
                                                    <td>${v.nama}</td>
                                                    <td>${v.total}</td>
                                                </tr>`))

    chartPenilaian.data = {
        labels: chartLabel,
        datasets: [{
            label: 'Skor',
            data: chartData,
            borderWidth: 3,
            borderColor: mainColor,
            backgroundColor: chartBarColor,
            barThickness: 25
        }]
    }

    chartPenilaian.update()
    $('#chart-loader').hide()
    $('#row-penilaian').show()
}

function getChartData() {
    $('#null-karyawan').hide()

    ajaxRequest.post({
        url: '/dashboard/chart-data',
        data: {
            periode: $('#periode-penilaian').val()
        }
    }).then(res => {
        if (res.data.length === 0) {
            $('#chart-loader').hide()
            $('#null-karyawan').show()
            return
        }

        !isSetPenilaianChart ? createPenilaianChart(res) : updatePenilaianChart(res)
    })
}

getChartData()

$('#search-penilaian').on('click', function () {
    $('#row-penilaian').hide()
    $('#chart-loader').show()
    getChartData()
}) 