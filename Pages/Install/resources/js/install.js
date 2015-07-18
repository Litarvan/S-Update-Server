// Starting all when the page finished loading
window.addEventListener('load', startAnimation(), false);

function startAnimation() {
    // Fading out the span slowly after a little delay
    $("#textspan").delay(1000).fadeOut("slow", function() {
        // After a little delay, changing its text then fading in it
        $("#textspan").delay(1000).text("Welcome").fadeIn("slow", function() {
            // Slowly fading out the span after a delay
            $("#textspan").delay(2500).fadeOut("slow", function() {
                // After a little delay, changing its text then fading it (again)
                $("#textspan").delay(1000).text("What a sucessfull setup").fadeIn("slow", function() {
                    $("#textspan").delay(2500).fadeOut("slow", function() {
                        $("#textspan").delay(1000).text("Let's configure me").fadeIn("slow", function() {
                            $("#textspan").delay(2500).fadeOut("slow", function() {
                                showCountries();
                            });
                        });
                    });
                });
            });
        });
    });
}

function showCountries() {
    // Showing the flags after a little delay
    $("#ukflag").delay(1000).fadeIn("slow");
    $("#frenchflag").delay(1000).fadeIn("slow");
}

function frenchSelected() {
    // Selecting the french
    document.getElementById("language").value = "fr_FR";

    // Hiding the english flag
    $("#ukflag").fadeOut("slow");

    // Hiding the french flag after a delay
    $("#frenchflag").delay(1500).fadeOut("slow", function() {
        // Continuing
        continueAnimation();
    });
}

function englishSelected() {
    // Selecting the english
    document.getElementById("language").value = "en_US";

    // Hiding the french flag
    $("#frenchflag").fadeOut("slow");

    // Hiding the english flag after a delay
    $("#ukflag").delay(1500).fadeOut("slow", function() {
        // Continuing
        continueAnimation();
    });
}

function continueAnimation() {
    $("#textspan").delay(1000).text("I need some protection").fadeIn("slow", function() {
        $("#textspan").delay(2500).fadeOut("slow", function() {
            $("#textspan").delay(1000).text("Choose a password to lock me").fadeIn("slow", function() {
                $("#textspan").delay(2500).fadeOut("slow", function() {
                    // Showing the form
                    $("#password").delay(1000).fadeIn("slow");
                    $("#vpassword").delay(1000).fadeIn("slow");
                    $("#sub").delay(1000).fadeIn("slow");
                });
            });
        });
    });
}

function finishConfig() {
    // Checking the password
    if(document.getElementById("password").value != document.getElementById("vpassword").value)
        // Changing the error span
        $("#error").text("Password don't match").fadeIn("fast");
    // Else if the password doens't have at least 5 chars
    else if(document.getElementById("password").value.length < 5)
        // Changing the error span
        $("#error").text("Password need to be at least 5 chars").fadeIn("fast");
    // Else if all is OK
    else {
        // Hiding all
        $("#formDiv").fadeOut("slow", function() {
            $("#textspan").delay(1000).text("Let's go").fadeIn("slow", function() {
                $("#textspan").delay(2500).fadeOut("slow", function() {
                    // Sending the form
                    document.getElementById("form").submit();
                });
            });
        });
    }
}
