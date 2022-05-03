function seePassword(element) {
    var x = document.getElementById(element);
    console.log(element)
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function onChange() {
    const password = document.querySelector('input[name=password]');
    const confirm = document.querySelector('input[name=conf_password]');
    if (confirm.value === password.value) {
        if (passwordValidation(password)) {
            document.getElementById("demo").innerHTML = "Le password sono uguali: ";
            document.getElementById("demo").style = 'color:green';
            document.getElementById("editPwd").type = 'submit';
        }
        else{
            
        }
    }
    else {
        document.getElementById("demo").style = 'color:red';
        document.getElementById("demo").innerHTML = "Password non sono uguali: ";
        document.getElementById("editPwd").type = 'hidden';
    }
}
function passwordValidation(pw) {
    //check empty password field
    if (pw == "") {
        return false;
    }

    //lunga almeno 8 caratteri
    if (pw.length < 8) {
        return false;
    }
    //massimo 15
    if (pw.length > 15) {
        return false;
    } else {
        return true;
    }
}