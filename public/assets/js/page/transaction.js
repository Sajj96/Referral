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

    $('#amount').on('blur keyup', () => {
        var amount = $('#amount').val(),
            deposit = 0,
            fee = 0;
        amount = parseFloat(amount.replace(/,/g, ''));

        if (amount >= 15000 && amount <= 50000) {
            fee = 1000;
            deposit = amount - fee;
            $('#deposit').val(deposit);
            $('#fee').val(fee);
            $('#fee_info').text("Fee: TZS " + fee);
        } else if (amount >= 51000 && amount <= 100000) {
            fee = 2000;
            deposit = amount - fee;
            $('#deposit').val(deposit);
            $('#fee').val(fee);
            $('#fee_info').text("Fee: TZS " + fee);
        } else if (amount >= 101000 && amount <= 500000) {
            fee = 5000;
            deposit = amount - fee;
            $('#deposit').val(deposit);
            $('#fee').val(fee);
            $('#fee_info').text("Fee: TZS " + fee);
        } else if (amount >= 501000 && amount <= 1000000) {
            fee = 10000;
            deposit = amount - fee;
            $('#deposit').val(deposit);
            $('#fee').val(fee);
            $('#fee_info').text("Fee: TZS " + fee);
        } else if(amount >= 1010000){
            fee = 15000;
            deposit = amount - fee;
            $('#deposit').val(deposit);
            $('#fee').val(fee);
            $('#fee_info').text("Fee: TZS " + fee);
        } else {
            $('#deposit').val("");
            $('#fee').val("");
            $('#fee_info').text("");
        }
    });

    $('#balance').on('change', function(){
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if(valueSelected == "trivia") {
            $('#balance-amount').text(trivia);
        } else if(valueSelected == "video") {
            $('#balance-amount').text(video);
        } else if(valueSelected == "whatsapp"){
            $('#balance-amount').text(whatsapp);
        } else {
            $('#balance-amount').text(balance);
        }
    });
});