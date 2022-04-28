function seePassword(element) {
    var x = document.getElementById(element);
    console.log(element)
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}