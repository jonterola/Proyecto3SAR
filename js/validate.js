function validar() {
    var name = document.getElementById("fname").value;
    var mail = document.getElementById("lmail").value;
    var checkbox = document.getElementById("lcheckbox").value;
    var text = document.getElementById("ltext").value;

    if (name && text) {
        if (mail) {
            var email = mail.split("@");
            if (email.length != 2 || email[0].length == 0) {
                alert("email incorrecto");
                return false;
            }
            else {
                var email2 = email[1].split(".");
                if (email2.length <= 1 || email2[0].length == 0 || email2[email2.length - 1].length < 2) {
                    alert("email incorrecto");
                    return false;
                } else {
                    return true;
                }
            }
        } else {
            return true;
        }
    } else {
        return false;

    }
    return false;
}