function checkFields() {
    // Getting the fields
    var password = document.getElementById('password');
    var vpassword = document.getElementById('vpassword');

    // Checking the passwords
    if(password.value == vpassword.value) {
        // Setting the background of the fields green
        password.style.backgroundColor = "green";
        vpassword.style.backgroundColor = "green";
    } else {
        // Setting the background of the fields red
        password.style.backgroundColor = "red";
        vpassword.style.backgroundColor = "red";
    }
}

function checkAndSubmit() {
    // If the fields passwords are the same
    if(document.getElementById('password').value == document.getElementById('vpassword').value)
        // Submiting the form
        document.getElementById('passwordForm').submit();
}
