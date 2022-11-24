$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

class requestData {
    post(params) {
        let url = params.url
        let data = params.data

        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (result) {
                    resolve(result)
                },
                error: function (result) {
                    alert('Oops! Something went wrong ..')
                }
            })
        })
    }

    get(params) {
        let url = params.url

        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                contentType: 'application/json',
                success: function (result) {
                    resolve(result)
                },
                error: function (result) {
                    alert('Oops! Something went wrong ..')
                }
            })
        })
    }
}

const ajaxRequest = new requestData()

$('.date-picker').datetimepicker({
    timepicker: false,
    format: 'Y-m-d'
})

function showToast(type, message) {
    toastr.option = {
        "timeout": "5000"
    }
    toastr[type](message)
}