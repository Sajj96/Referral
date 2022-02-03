'use strict';
$(function () {

    var cleaveC = new Cleave('.currency', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    //Advanced form with validation
    var form = $('#wizard_with_validation').show();

    form.validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        rules: {
            'confirm': {
                equalTo: '#password'
            }
        }
    });
    
    $('#amount').on('blur', () => {
        var amount = $('#amount').val();
        amount = parseFloat(amount.replace(/,/g, ''));
        var deposit = amount - 900;
        $('#deposit').val(deposit);
    });
});