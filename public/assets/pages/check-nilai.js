const kriteria = $('#kriteria').data('kriteria')

function searchValidate() {
    if ($('#search-nip').val().length === 0) {
        $('#btn-search-penilaian').attr('disabled', true)
        return
    }

    if ($('#periode-penilaian').val().length === 0) {
        $('#btn-search-penilaian').attr('disabled', true)
        return
    }

    $('#btn-search-penilaian').removeAttr('disabled')
}

$('#periode-penilaian').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy-mm',
    onClose: function (dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        searchValidate()
    }
})

$('#search-nip').on('input', searchValidate)

$('#btn-search-penilaian').on('click', function () {
    $('#null-penilaian').hide()
    $('#error-penilaian').hide()
    $('#penilaian-data').hide()
    $('#penilaian-loader').show()

    const data = {
        nip: $('#search-nip').val(),
        periode: $('#periode-penilaian').val()
    }

    ajaxRequest.post({
        url: '/karyawan/nilai/get',
        data: data
    }).then(res => {
        if (res.error) {
            $('#null-penilaian').hide()
            $('#penilaian-loader').hide()
            $('#penilaian-data').hide()
            $('#error-message').html(res.message)
            $('#error-penilaian').show()
            return
        }

        $('#null-penilaian').hide()
        $('#error-penilaian').hide()
        $('#penilaian-loader').hide()

        if (!res.error) {
            $('#detail-nip').html(res.data.nip)
            $('#detail-nama').html(res.data.nama)
            $('#detail-divisi').html(res.data.divisi)

            let tData = ``
            const n_total = [0, 0, 0, 0, 0]

            kriteria.forEach(k => {
                let tempTData = `<tr><td>${k.label}</td>`

                for (let i = 1; i <= 5; i++) {
                    const nilai = res.data.penilaian.find(n => n.key === k.key).nilai
                    if (i === nilai) {
                        n_total[i - 1] = n_total[i - 1] + nilai
                        tempTData += `<td style="text-align: center;"><i class="fas fa-check"></i></td>`
                    } else {
                        tempTData += `<td></td>`
                    }
                }

                tempTData += `</tr>`
                tData += tempTData
            });

            let tData_n_total = `<tr><td style="text-align: center; font-weight: 600;">Nilai Total</td>`
            n_total.forEach(n => tData_n_total += `<td style="text-align: center;">${n}</td>`)
            tData_n_total += `</tr>`
            tData += tData_n_total

            tData += `<tr>
                <td style="text-align: center; font-weight: 600;">Skor (Nilai Total/Jumlah Aspek)</td>
                <td colspan="5" style="text-align: center; font-weight: 600;">${res.data.total}</td>
            </tr>`

            $('#tbody-nilai').html(tData)
            $('#penilaian-data').show()
        }
    })
})