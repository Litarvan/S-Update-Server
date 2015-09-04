var circlesActivated = false;
var serverActivated;
var backgroundPath;

function startAnimation() {
    // Slowing fading out the shark avatar
    $('#sharklogo').fadeOut("slow");

    // Slowing fading in the logo after 1 second
    $('#logo').fadeIn("slow");

    // Starting the canvas animations
    drawCanvas();

    // If the server is activated
    if(serverActivated)
        // Doing the start animation
        doServerStartAnimation();
}

function drawCanvas() {
    // Getting the canvas and its context
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");

    // Setting opacity 0.25
    ctx.globalAlpha = 0.25;

    // The circle radius
    var radius = 105;

    // Draw the circle
    function draw() {
        // Clearing the canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Draws the circle
        function drawCircle() {
            // If the radius is 105 and the server is activated
            if(radius == 105 && serverActivated)
                // Stopping
                return;

            // Setting opacity to 0.25
            ctx.globalAlpha = 0.25;

            // If the radius is bigger than 135px
            if(radius > 135)
                // Fading the circle out
                ctx.globalAlpha = 0.25 - ((radius - 135) / 100);

            // Else if the radius is smaller than 110
            else if (radius < 120)
                // Fading the circle in
                ctx.globalAlpha = 0.0 + (radius - 105) / 60;

            // Drawing the circle
            ctx.beginPath();
            ctx.arc(canvas.width / 2, canvas.height / 2, radius, 0, 2 * Math.PI);
            ctx.strokeStyle = "#fff";
            ctx.lineWidth = 15;
            ctx.stroke();

            // Incrementing its radius
            radius += radius / 200;

            // If the radius is bigger than 175 (the circle do all the canvas)
            if(radius > 160) {
                // Reseting the radius
                radius = 105;

                // If we need to stop
                if(!circlesActivated)
                    // Stopping
                    return;
            }
        }

        // Draws the circle around the logo
        function drawLogoCircle() {
            // Setting the opacity to opaque
            ctx.globalAlpha = 1.0;

            // Just drawing the circle
            ctx.beginPath();
            ctx.arc(canvas.width / 2, canvas.height / 2, 100, 0, 2 * Math.PI);

            // If the server is activated
            if(serverActivated)
                // Setting the color to green
                ctx.strokeStyle = "#00ff00";

            // Else if it isn't
            else
                // Setting the color to red
                ctx.strokeStyle = "#ff0000";

            ctx.lineWidth = 10;
            ctx.stroke();
        }

        // Drawing the circle animation
        drawCircle();

        // Drawing the circle around the logo
        drawLogoCircle();

        // Re-drawing
        requestAnimationFrame(draw);
    }

    // Starting the animation
    draw();
}

function start(activated, background) {
    // Setting the server state
    serverActivated = activated;

    // Setting the circle activated to the inverse of if the server is activated
    circlesActivated = !serverActivated;

    // Setting the background path (given by the back end part)
    backgroundPath = background;

    // If the server isn't activated
    if(!serverActivated)
        // Removing the background
        document.body.style.backgroundImage = "none";

    // Starting all when the page finished loading
    window.addEventListener('load', startAnimation(), false);

    // Getting the canvas
    var canvas = $("#canvas");

    // Getting the logo
    var logo = document.getElementById("logo");

    // When the mouse is on
    canvas.mouseover(function() {
        // Setting the logo image to the hover image
        logo.src = logo.src.replace(".png", "_hover.png");
    });

    // When the mouse click on it
    canvas.click(function() {
        // If the server isn't activated
        if(!serverActivated)
            // Activating it
            activateServer();

        // Else, if the server is activated
        else
            // Desactivating it
            desactivateServer();
    });

    // When the mouse leave the canvas
    canvas.mouseleave(function() {
        // Setting the logo image to the normal image
        logo.src = logo.src.replace("_hover.png", ".png");
    });
}

function activateServer() {
    // Desactivating the circles
    circlesActivated = false;

    // Activating the server
    serverActivated = true;

    // Starting the start animation
    doServerStartAnimation();

    // Sending a disable request to the server
    sendRequest("../set-enabled/true");
}

function desactivateServer() {
    // Activating the circles
    circlesActivated = true;

    // Desactivating the server
    serverActivated = false;

    // Removing the background
    document.body.style.backgroundImage = "none";

    // Starting the stop animation
    doServerStopAnimation();

    // Sending a disable request to the server
    sendRequest("../set-enabled/false");
}

function doServerStartAnimation() {
    // Changing background
    document.body.style.backgroundImage = "url(" + backgroundPath + ")";

    // Moving the logo
    $("#centerDiv").animate({ top: '32%' }, function() {
        // Getting the infos div
        var infos = document.getElementById("infos");

        // Printing the jQuery version in it
        infos.innerHTML = infos.innerHTML.replace("jQueryVersion", jQuery.fn.jquery);

        // Fading the text logo
        $("#textlogo").fadeIn();

        // Fading the infos
        $("#infos").fadeIn(function() {
            // Fading the buttons
            $("#statistics").fadeIn();
            $("#settings").fadeIn(function() {
                $("#disconnect").fadeIn();
                $("#about").fadeIn();
            });
        });
    });
}

function doServerStopAnimation() {
    // Fading the buttons
    $("#disconnect").fadeOut();
    $("#about").fadeOut(function() {
        $("#statistics").fadeOut();
        $("#settings").fadeOut(function() {
            // Fading out the infos
            $("#infos").fadeOut();

            // Fading out the text logo
            $("#textlogo").fadeOut(function() {
                // Moving the logo
                $("#centerDiv").animate({ top: '50%'});

                // Removing the background
                document.body.style.backgroundImage = "none";
            });
        });
    });
}

function sendRequest(request) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", request, true);
    xhr.send(null);
}
