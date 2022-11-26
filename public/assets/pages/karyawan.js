document.title = 'Pizza Hut - Data Karyawan'

// ===== GET =====
function getKaryawan() {
    ajaxRequest.get({ url: '/karyawan/get' }).then(res => {
        $('#loader-karyawan').hide()

        if (res.data.length === 0) {
            $('#null-karyawan').show()
            $('#table-karyawan').hide()
            return
        }

        $('#null-karyawan').hide()
        $('#table-karyawan').show()

        const tRow = res.data.map(v => `<tr>
            <td>${v.nip}</td>
            <td>${v.nama}</td>
            <td>${v.tgl_lahir}</td>
            <td>${v.divisi}</td>
            <td>
                <button
                    id="editData"
                    class="btn-table-action edit"
                    data-toggle="modal"
                    data-target="#modalEdit"
                    onclick="editAction(${JSON.stringify(v).replaceAll(`"`, `'`)})"
                >
                    <i class="fas fa-cog"></i>
                </button>
                &nbsp;
                <button
                    id="deleteData"
                    class="btn-table-action delete"
                    data-toggle="modal"
                    data-target="#modalDelete"
                    onclick="deleteAction(${JSON.stringify(v).replaceAll(`"`, `'`)})"
                >
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>`)

        $('#table-karyawan tbody').html(tRow)
    })
}

getKaryawan()

// ===== ADD =====
function validateInput() {
    let isValid = true

    $.each($('#modalInput input, #modalInput select'), function (i, v) {
        if (v.value.length === 0) {
            isValid = false
            return false
        }
        isValid = true
    })

    if (!isValid) return $('#btn-input-data').attr('disabled', true)
    return $('#btn-input-data').removeAttr('disabled')
}

$('#modalInput').on('show.bs.modal', validateInput)
$('#modalInput input').on('input', validateInput)
$('#modalInput select, #modalInput #tgl_lahir').on('change', validateInput)

$('#btn-input-data').on('click', function () {
    $(this).attr('disabled', true)

    const data = {
        nip: $('#modalInput #nip').val(),
        nama: $('#modalInput #nama').val(),
        tgl_lahir: $('#modalInput #tgl_lahir').val(),
        divisi: $('#modalInput #divisi').val()
    }

    ajaxRequest.post({
        url: '/karyawan/add',
        data: data
    }).then(res => {
        if (res.error) {
            validateInput()
            showToast('error', res.message)
            return
        }

        getKaryawan()
        showToast('success', res.message)
        $('#modalInput #nip').val('')
        $('#modalInput #nama').val('')
        $('#modalInput #tgl_lahir').val('')
        $('#modalInput #divisi').val('')
        $('#modalInput').modal('hide')
    })
})

// ===== EDIT =====
function editAction(data) {
    $('#modalEdit #id').val(data.id)
    $('#modalEdit #nip').val(data.nip)
    $('#modalEdit #nama').val(data.nama)
    $('#modalEdit #tgl_lahir').val(data.tgl_lahir)
    $('#modalEdit #divisi').val(data.divisi)
    validateEdit()
}

function validateEdit() {
    let isValid = true

    $.each($('#modalEdit input, #modalEdit select'), function (i, v) {
        if (v.value.length === 0) {
            isValid = false
            return false
        }
        isValid = true
    })

    if (!isValid) return $('#btn-edit-data').attr('disabled', true)
    return $('#btn-edit-data').removeAttr('disabled')
}

$('#modalEdit').on('show.bs.modal', validateEdit)
$('#modalEdit input').on('input', validateEdit)
$('#modalEdit select, #modalEdit #tgl_lahir').on('change', validateEdit)

$('#btn-edit-data').on('click', function () {
    $(this).attr('disabled', true)

    const data = {
        id: $('#modalEdit #id').val(),
        nama: $('#modalEdit #nama').val(),
        tgl_lahir: $('#modalEdit #tgl_lahir').val(),
        divisi: $('#modalEdit #divisi').val()
    }

    ajaxRequest.post({
        url: '/karyawan/update',
        data: data
    }).then(res => {
        if (res.error) {
            validateEdit()
            showToast('error', res.message)
            return
        }

        getKaryawan()
        showToast('success', res.message)
        $('#modalEdit').modal('hide')
    })
})

// ===== DELETE =====
function deleteAction(data) {
    $('#modalDelete #delete-warning-message').html(`Hapus karyawan ${data.nama} ?`)
    $('#modalDelete #id').val(data.id)
}

$('#modalDelete').on('show.bs.modal', function () {
    $('#btn-delete-data').removeAttr('disabled')
})

$('#btn-delete-data').on('click', function () {
    $(this).attr('disabled', true)

    const data = {
        id: $('#modalDelete #id').val()
    }

    ajaxRequest.post({
        url: '/karyawan/delete',
        data: data
    }).then(res => {
        if (res.error) {
            showToast('error', res.message)
            return
        }

        getKaryawan()
        showToast('success', res.message)
        $('#modalDelete').modal('hide')
    })
})