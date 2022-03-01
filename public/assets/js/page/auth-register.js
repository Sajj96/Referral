"use strict";

$(document).on('keyup', '#username',function() {
  var text = $(this).val();
  $(this).val(text.replace(/[^A-Za-z0-9]/g,''));
});

$(".pwstrength").pwstrength();

// get the country data from the plugin
var countryData = window.intlTelInputGlobals.getCountryData(),
  telInput = document.querySelector("#phone"),
  addressDropdown = document.querySelector("#address-country"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");


// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialize
var it = window.intlTelInput(telInput, {
	initialCountry: 'tz',
	autoPlaceholder: 'aggressive',
	utilsScript: utilUrl,
	geoIpLookup: function(callback) {
        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
          var countryCode = (resp && resp.country) ? resp.country : "us";
          callback(countryCode);
        });
      },
    separateDialCode: true
});

// populate the country dropdown
for (var i = 0; i < countryData.length; i++) {
    var country = countryData[i];
    var optionNode = document.createElement("option");
    optionNode.value = country.iso2;
    var textNode = document.createTextNode(country.name);
    optionNode.appendChild(textNode);
    addressDropdown.appendChild(optionNode);
  }
  // set it's initial value
  addressDropdown.value = it.getSelectedCountryData().iso2;
  $("#address-country").val(it.getSelectedCountryData().iso2).find("option[value=" + it.getSelectedCountryData().iso2 +"]").attr('selected', true);
  
  // listen to the telephone input for changes
  telInput.addEventListener('countrychange', function(e) {
    addressDropdown.value = it.getSelectedCountryData().iso2;
  });
  
  // listen to the address dropdown for changes
  addressDropdown.addEventListener('change', function() {
    it.setCountry(this.value);
  });

  var reset = function() {
    telInput.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
  };
  
  // on blur: validate
  telInput.addEventListener('blur', function() {
    reset();
    if (telInput.value.trim()) {
      if (it.isValidNumber()) {
        validMsg.classList.remove("hide");
      } else {
        telInput.classList.add("error");
        var errorCode = it.getValidationError();
        errorMsg.innerHTML = errorMap[errorCode];
        errorMsg.classList.remove("hide");
      }
    }
  });
  
  // on keyup / change flag: reset
  telInput.addEventListener('change', reset);
  telInput.addEventListener('keyup', reset);
  