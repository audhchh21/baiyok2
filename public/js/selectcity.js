$(document).ready(function () {
    var province = $('#province').select2();
    var district = $('#district').select2();
    var subdistrict = $('#subdistrict').select2();
    var zipcode = $('#zipcode').select2();

    var opt_province = '<option value="selected">----- เลือก จังหวัด -----</option>';
    var opt_district = '<option value="selected">----- เลือก อำเภอ -----</option>';
    var opt_subdistrict = '<option value="selected">----- เลือก ตำบล -----</option>';
    var opt_zipcode = '<option value="selected">----- เลือก รหัสไปรษณีย์ -----</option>';
    $('#province').html(opt_province);
    $('#district').html(opt_district);
    $('#subdistrict').html(opt_subdistrict);
    $('#zipcode').html(opt_zipcode);
    $('.collapse').collapse()
    $('#city').DataTable();
    $.ajax({
        global: false,
        url: '{{ route("getcity") }}',
        type: 'GET',
        data: ({
            'type': 'province',
        }),
        dataType: 'JSON',
        async: false,
        success: function (results) {
            var op_province = opt_province;
            $.each(results, function (count, value) {
                console.log(value);
                op_province += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
            });
            $('#province').html(op_province);
            $('#district').html(opt_district);
            $('#subdistrict').html(opt_subdistrict);
            $('#zipcode').html(opt_zipcode);
            district.prop("disabled", true);
            subdistrict.prop("disabled", true);
            zipcode.prop("disabled", true);
        }
    });

    $('#province').on('select2:select', function () {
        console.log($('#province').val());
        $.ajax({
            global: false,
            url: '{{ route("getcity") }}',
            type: 'GET',
            data: ({
                'type': 'district',
                'id': $('#province').val()
            }),
            dataType: 'JSON',
            async: false,
            success: function (results) {
                var op_district = opt_district;
                $.each(results, function (count, value) {
                    console.log(value);
                    op_district += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('#district').html(op_district);
                $('#subdistrict').html(opt_subdistrict);
                $('#zipcode').html(opt_zipcode);
                district.prop("disabled", false);
                subdistrict.prop("disabled", true);
                zipcode.prop("disabled", true);
            }
        });
    });

    $('#district').on('select2:select', function () {
        console.log($('#district').val());
        $.ajax({
            global: false,
            url: '{{ route("getcity") }}',
            type: 'GET',
            data: ({
                'type': 'subdistrict',
                'id': $('#district').val()
            }),
            dataType: 'JSON',
            async: false,
            success: function (results) {
                var op_subdistrict = opt_subdistrict;
                $.each(results, function (count, value) {
                    console.log(value);
                    op_subdistrict += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
                });
                $('#subdistrict').html(op_subdistrict);
                $('#zipcode').html(opt_zipcode);
                district.prop("disabled", false);
                subdistrict.prop("disabled", false);
                zipcode.prop("disabled", true);
            }
        });
    });

    $('#subdistrict').on('select2:select', function () {
        console.log($('#subdistrict').val());
        $.ajax({
            global: false,
            url: '{{ route("getcity") }}',
            type: 'GET',
            data: ({
                'type': 'zipcode',
                'id': $('#subdistrict').val()
            }),
            dataType: 'JSON',
            async: false,
            success: function (results) {
                var op_zipcode = opt_zipcode;
                console.log(results.zip_code);
                op_zipcode += '<option value="' + results.id + '" selected>' + results.zip_code + '</option>';
                $('#zipcode').html(op_zipcode);
                district.prop("disabled", false);
                subdistrict.prop("disabled", false);
                zipcode.prop("disabled", true);
            }
        });
    });
});
