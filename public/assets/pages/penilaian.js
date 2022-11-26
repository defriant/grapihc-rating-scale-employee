document.title = 'Pizza Hut - Penilaian Karyawan'
const kriteria = $('#kriteria').data('kriteria')

$('#periode-penilaian').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy-mm',
    onClose: function (dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
})

function getPenilaian() {
    $('#modalUpdatePenilaian #periode').val($('#periode-penilaian').val())

    const data = {
        'periode': $('#periode-penilaian').val()
    }

    ajaxRequest.post({
        url: '/penilaian/get',
        data: data
    }).then(res => {
        let tData = ``

        function createTdNilai(nilai) {
            switch (nilai) {
                case '5':
                    return `<td style="text-align: center;" title="Sangat Baik"><span style="font-weight: 600;">A</span> <span style="font-size: 13px">(${nilai})</span></td>`

                case '4':
                    return `<td style="text-align: center;" title="Baik"><span style="font-weight: 600;">B</span> <span style="font-size: 13px">(${nilai})</span></td>`

                case '3':
                    return `<td style="text-align: center;" title="Cukup"><span style="font-weight: 600;">C</span> <span style="font-size: 13px">(${nilai})</span></td>`

                case '2':
                    return `<td style="text-align: center;" title="Kurang"><span style="font-weight: 600;">D</span> <span style="font-size: 13px">(${nilai})</span></td>`

                case '1':
                    return `<td style="text-align: center;" title="Sangat Kurang"><span style="font-weight: 600;">E</span> <span style="font-size: 13px">(${nilai})</span></td>`

                default:
                    return `<td style="text-align: center;">-</td>`
            }
        }

        $.each(res.data, (i, v) => {
            const dataPenilaian = v.penilaian.map(v => createTdNilai(v.nilai))

            tData += `<tr>
                        <td>${v.nama}</td>
                        ${dataPenilaian}
                        <td>
                            <button
                                id="editData"
                                class="btn-table-action edit"
                                data-toggle="modal"
                                data-target="#modalUpdatePenilaian"
                                onclick="updatePenilaianAction(${JSON.stringify(v).replaceAll(`"`, `'`)})"
                            >
                                <i class="fas fa-cog"></i>
                            </button>
                        </td>
                    </tr>`
        })

        $('#tbody-penilaian').html(tData)
        $('#penilaian-karyawan-loader').hide()
        $('#table-penilaian').show()
    })
}

getPenilaian()
$('#search-penilaian').on('click', function () {
    $('#table-penilaian').hide()
    $('#penilaian-karyawan-loader').show()
    getPenilaian()
})

// ===== UPDATE PENILAIAN =====
function updatePenilaianAction(data) {
    $('#modalUpdatePenilaian #id').val(data.id)
    $('#modalUpdatePenilaian #nip').val(data.nip)
    $('#modalUpdatePenilaian #nama').val(data.nama)

    kriteria.forEach(k => {
        const nilai = data.penilaian.find(d => d.key === k.key).nilai
        $(`#modalUpdatePenilaian #${k.key}`).val(nilai !== '-' ? nilai : '')
    });
}

$('#btn-update-penilaian').on('click', function () {
    $(this).attr('disabled', true)

    const data = {
        id: $('#modalUpdatePenilaian #id').val(),
        periode: $('#modalUpdatePenilaian #periode').val(),
        penilaian: kriteria.map(k => {
            return {
                'key': k.key,
                'nilai': $(`#modalUpdatePenilaian #${k.key}`).val()
            }
        })
    }

    ajaxRequest.post({
        url: '/penilaian/update',
        data: data
    }).then(res => {
        $(this).removeAttr('disabled')
        getPenilaian()
        showToast('success', res.message)
        $('#modalUpdatePenilaian').modal('hide')
    })
})