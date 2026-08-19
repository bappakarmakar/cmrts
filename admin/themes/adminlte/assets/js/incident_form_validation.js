// Incident Pincode Validation
$(function () {
    $(".pin_code_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_pin_code").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_pin_code").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// Identity Name Validation
function Identity_Known_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var identity_known_name_lbl_error = document.getElementById("identity_known_name_lbl_error");
    identity_known_name_lbl_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        identity_known_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// Identity Pincode Validation
$(function () {
    $(".identity_pin_code_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_identity_pin_code").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_identity_pin_code").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// Identity Phone No Validation
$(function () {
    $(".identity_phone_no_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_identity_phone_no").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_identity_phone_no").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// Local Person Name Validation
function Local_Person_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var lbl_error_local_person_name = document.getElementsByClassName("lbl_error_local_person_name");
    lbl_error_local_person_name.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        lbl_error_local_person_name.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// Official Involved Name Validation
function Official_Involved_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var lbl_error_official_involved_name = document.getElementsByClassName("lbl_error_official_involved_name");
    lbl_error_official_involved_name.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        lbl_error_official_involved_name.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// Official Involved Mobile Validation
$(function () {
    $(".officials_involved_contact_no_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_official_involved_mobile").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_official_involved_mobile").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP One Name Validation
function CP_One_First_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_one_first_name_lbl_error = document.getElementById("cp_one_first_name_lbl_error");
    cp_one_first_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_one_first_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
function CP_One_Middle_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_one_middle_name_lbl_error = document.getElementById("cp_one_middle_name_lbl_error");
    cp_one_middle_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_one_middle_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
function CP_One_Last_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_one_last_name_lbl_error = document.getElementById("cp_one_last_name_lbl_error");
    cp_one_last_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_one_last_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP One Pincode Validation
$(function () {
    $(".cp_one_pin_code_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_cp_one_pin_code").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_cp_one_pin_code").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP One Phone No Validation
$(function () {
    $(".cp_one_phone_no_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_cp_one_phone_no").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_cp_one_phone_no").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP One Father Name Validation
function CP_One_Father_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_one_father_name_lbl_error = document.getElementById("cp_one_father_name_lbl_error");
    cp_one_father_name_lbl_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_one_father_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP One Mother Name Validation
function CP_One_Mother_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_one_mother_name_lbl_error = document.getElementById("cp_one_mother_name_lbl_error");
    cp_one_mother_name_lbl_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_one_mother_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP One Father Mobile Validation
$(function () {
    $("#cp_one_father_mobile_no").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_one_father_mobile_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_one_father_mobile_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP One Mother Mobile Validation
$(function () {
    $("#cp_one_mother_mobile_no").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_one_mother_mobile_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_one_mother_mobile_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP Two Name Validation
function CP_Two_First_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_two_first_name_lbl_error = document.getElementById("cp_two_first_name_lbl_error");
    cp_two_first_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_two_first_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
function CP_Two_Middle_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_two_middle_name_lbl_error = document.getElementById("cp_two_middle_name_lbl_error");
    cp_two_middle_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_two_middle_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
function CP_Two_Last_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_two_last_name_lbl_error = document.getElementById("cp_two_last_name_lbl_error");
    cp_two_last_name_lbl_error.innerHTML = "";
    var regex = /^(?=.*[a-z])[a-z\s.'-]+$/i;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_two_last_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP Two Pincode Validation
$(function () {
    $(".cp_two_pin_code_vaidate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_two_pin_code_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_two_pin_code_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP Two Phone No Validation
$(function () {
    $(".cp_two_phone_no_vaidate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_two_phone_no_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_two_phone_no_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP Two Father Name Validation
function CP_Two_Father_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_two_father_name_lbl_error = document.getElementById("cp_two_father_name_lbl_error");
    cp_two_father_name_lbl_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_two_father_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP Two Mother Name Validation
function CP_Two_Mother_Name_Validate(e) {
    var keyCode = e.keyCode || e.which;
    var cp_two_mother_name_lbl_error = document.getElementById("cp_two_mother_name_lbl_error");
    cp_two_mother_name_lbl_error.innerHTML = "";
    var regex = /^[a-zA-Z\s]+$/;
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        cp_two_mother_name_lbl_error.innerHTML = "Only Alphabets allowed.";
    }
    return isValid;
}
// CP Two Father Mobile Validation
$(function () {
    $("#cp_two_father_mobile_no").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_two_father_mobile_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_two_father_mobile_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// CP Two Mother Mobile Validation
$(function () {
    $("#cp_two_mother_mobile_no").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#cp_two_mother_mobile_lbl_error").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#cp_two_mother_mobile_lbl_error").html("Only Numbers allowed.");
        }
        return isValid;
    });
});
// Copy Paste Validation
// window.onload = () => {
//  const identity_known_name_input = document.getElementById('identity_known_name');
//  identity_known_name_input.onpaste = e => e.preventDefault();

//  const local_person_name_input = document.getElementById('local_person_name');
//  local_person_name_input.onpaste = e => e.preventDefault();

//  const official_involved_name_input = document.getElementById('official_involved_name');
//  official_involved_name_input.onpaste = e => e.preventDefault();

//  const cp_one_f_name_input = document.getElementById('cp_one_f_name');
//  cp_one_f_name_input.onpaste = e => e.preventDefault();

//  const cp_one_m_name_input = document.getElementById('cp_one_m_name');
//  cp_one_m_name_input.onpaste = e => e.preventDefault();

//  const cp_one_l_name_input = document.getElementById('cp_one_l_name');
//  cp_one_l_name_input.onpaste = e => e.preventDefault();

//  const cp_one_father_name_input = document.getElementById('cp_one_father_name');
//  cp_one_father_name_input.onpaste = e => e.preventDefault();

//  const cp_one_mother_name_input = document.getElementById('cp_one_mother_name');
//  cp_one_mother_name_input.onpaste = e => e.preventDefault();

//  const cp_two_f_name_input = document.getElementById('cp_two_f_name');
//  cp_two_f_name_input.onpaste = e => e.preventDefault();

//  const cp_two_m_name_input = document.getElementById('cp_two_m_name');
//  cp_two_m_name_input.onpaste = e => e.preventDefault();

//  const cp_two_l_name_input = document.getElementById('cp_two_l_name');
//  cp_two_l_name_input.onpaste = e => e.preventDefault();

//  const cp_two_father_name_input = document.getElementById('cp_two_father_name');
//  cp_two_father_name_input.onpaste = e => e.preventDefault();

//  const cp_two_mother_name_input = document.getElementById('cp_two_mother_name');
//  cp_two_mother_name_input.onpaste = e => e.preventDefault();

//  const pin_code_input = document.getElementById('pin_code');
//  pin_code_input.onpaste = e => e.preventDefault();

//  const identity_pin_code_input = document.getElementById('identity_pin_code');
//  identity_pin_code_input.onpaste = e => e.preventDefault();

//  const identity_phone_no_input = document.getElementById('identity_phone_no');
//  identity_phone_no_input.onpaste = e => e.preventDefault();

//  const cp_one_pin_code_input = document.getElementById('cp_one_pin_code');
//  cp_one_pin_code_input.onpaste = e => e.preventDefault();

//  const cp_one_phone_no_input = document.getElementById('cp_one_phone_no');
//  cp_one_phone_no_input.onpaste = e => e.preventDefault();

//  const cp_one_father_mobile_no_input = document.getElementById('cp_one_father_mobile_no');
//  cp_one_father_mobile_no_input.onpaste = e => e.preventDefault();

//  const cp_one_mother_mobile_no_input = document.getElementById('cp_one_mother_mobile_no');
//  cp_one_mother_mobile_no_input.onpaste = e => e.preventDefault();

//  const cp_two_pin_code_input = document.getElementById('cp_two_pin_code');
//  cp_two_pin_code_input.onpaste = e => e.preventDefault();

//  const cp_two_phone_no_input = document.getElementById('cp_two_phone_no');
//  cp_two_phone_no_input.onpaste = e => e.preventDefault();

//  const cp_two_father_mobile_no_input = document.getElementById('cp_two_father_mobile_no');
//  cp_two_father_mobile_no_input.onpaste = e => e.preventDefault();

//  const cp_two_mother_mobile_no_input = document.getElementById('cp_two_mother_mobile_no');
//  cp_two_mother_mobile_no_input.onpaste = e => e.preventDefault();
// }

function phone_number_validation() {
  var input = document.querySelector(".no");
  var pattern = /^[6-9][0-9]{0,9}$/;
  var value = input.value;
  !pattern.test(value) && (input.value = value = '');
  input.addEventListener('input', function() {
     var currentValue = this.value;
     if(currentValue && !pattern.test(currentValue)) this.value = value;
     else value = currentValue;
  });
};