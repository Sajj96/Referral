'use strict';
$(function () {

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
        var deposit = amount - deducted;
        $('#deposit').val(deposit);
    });
});