function seePassword(element) {
    var x = document.getElementById(element);
    console.log(element)
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function comparePassword()
{
    var pw1 = document.getElementById("password").value;  
    var pw2 = document.getElementById("conf_password").value;  
    if(pw1=pw2)
    {
        return true;
    }
    return false;
}
function passwordValidation() {
    var pw = document.getElementById("pswd").value;
    //check empty password field
    if(pw == "") {
       document.getElementById("message").innerHTML = "**Fill the password please!";
       return false;
    }
   
   //lunga almeno 8 caratteri
    if(pw.length < 8) {
       document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";
       return false;
    }
  
  //massimo 15
    if(pw.length > 15) {
       document.getElementById("message").innerHTML = "**Password length must not exceed 15 characters";
       return false;
    } else {
       alert("Password is correct");
    }
  }