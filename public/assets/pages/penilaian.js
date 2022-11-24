const kriteria = $('#kriteria').data('kriteria')

console.log(kriteria);

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
    $('#table-penilaian').hide()
    $('#penilaian-karyawan-loader').show()

    const data = {
        'periode': $('#periode-penilaian').val()
    }

    ajaxRequest.post({
        url: '/penilaian/get',
        data: data
    }).then(res => {
        let tData = ``

        $.each(res.data, (i, v) => {
            const dataPenilaian = v.penilaian.map(v => `<td style="text-align: center;">${v.nilai}</td>`)

            tData += `<tr>
                        <td>${v.nama}</td>
                        ${dataPenilaian}
                        <td>
                            <button
                                id="editData"
                                class="btn-table-action edit"
                                data-toggle="modal"
                                data-target="#modalEdit"
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

$('#search-penilaian').on('click', getPenilaian)