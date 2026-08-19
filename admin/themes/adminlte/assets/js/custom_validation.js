$(document).ready(function(){
    $('body').on('keyup','input,textarea',function(){
        const inputField = $(this);
        const inputFieldId = $(this).attr('id');
        const inputValue = inputField.val();
        if(inputFieldId!='google_map'){
        //const cleanInput = inputValue.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
        const cleanInput = inputValue.replace(/<[^>]*>/gi, '');
        inputField.val(cleanInput);

        }else{
            const cleanInput = inputValue.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
            inputField.val(cleanInput);
        }
    })
});

function onlyAlphabets(e) {
    e = e || window.event;
    var charCode1 = e.which || e.keyCode;
    //if ((charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122) || (charCode1 == 32 || charCode1 == 8 || charCode1 == 46))
    if ((charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122))
        return true;
    return e.preventDefault(), false;
}

function onlyAlphabetsWithSpace(e) {
    e = e || window.event;
    var charCode1 = e.which || e.keyCode;
    //if ((charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122) || (charCode1 == 32 || charCode1 == 8 || charCode1 == 46))
    if ((charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122)||(charCode1 == 32))
        return true;
    return e.preventDefault(), false;
}

function onlyNumber(id) {
    var input = document.getElementById(id);
    var pattern = /^[6-9][0-9]{0,9}$/;
    var value = input.value;
    !pattern.test(value) && (input.value = value = '');
    input.addEventListener('input', function() {
        var currentValue = this.value;
        if(currentValue && !pattern.test(currentValue)) this.value = value;
        else value = currentValue;
    });
}

function onlyNumerics(e) {
    e = e || window.event;
    var charCode1 = e.which || e.keyCode;
    if ((charCode1 >= 48 && charCode1 <= 57) || (charCode1 == 8))
        return true;
    return e.preventDefault(), false;
}

function onlyNumbers(e,t){
    e = e || window.event;
    var charCode = e.which || e.keyCode;
    if (String.fromCharCode(charCode).match(/[0-9]/g))
        return true;
    return e.preventDefault(), false;
}

function onlyAlphabetsWithHyphen(e) {
    e = e || window.event;
    var charCode1 = e.which || e.keyCode;
    //if ((charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122) || (charCode1 == 32 || charCode1 == 8 || charCode1 == 46))
    if ((charCode1 >= 48 && charCode1 <= 57)||(charCode1 == 32)||(charCode1 >= 65 && charCode1 <= 90) || (charCode1 >= 97 && charCode1 <= 122)||(charCode1 == 45))
        return true;
    return e.preventDefault(), false;
}