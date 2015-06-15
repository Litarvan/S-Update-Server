var stopCircle = false;

function startAnimation(activated) {
    jQuery(function() {
        // Slowing fading out the shark avatar
        $('#sharklogo').fadeOut("slow");
    });

    jQuery(function() {
        // Slowing fading in the logo after 1 second
        $('#logo').fadeIn("slow");
    });

    if(!activated)
        doCircles();
}

function doCircles() {
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

        // If we need to stop
        if(stopCircle)
            // Stopping
            return;

        // Drawing the circle
        ctx.beginPath();
        ctx.arc(canvas.width / 2, canvas.height / 2, radius, 0, 2 * Math.PI);
        ctx.strokeStyle = "#fff";
        ctx.lineWidth = 15;
        ctx.stroke();

        // Incrementing its radius
        radius += radius / 200;

        // If the radius is bigger than 125px
        if(radius > 135)
            // Fading the circle out
            ctx.globalAlpha = 0.25 - ((radius - 135) / 100);

        // Else if the radius is smaller than 110
        else if (radius < 120)
            // Fading the circle in
            ctx.globalAlpha = 0.0 + (radius - 105) / 60;

        // Else
        else
            // Setting opacity to 0.25
            ctx.globalAlpha = 0.25;

        // If the radius is bigger than 175 (the circle do all the canvas)
        if(radius > 160)
            // Reseting the radius
            radius = 105;

        // Re-drawing
        requestAnimationFrame(draw);
    }

    // Starting the animation
    draw();
}

function start(activated) {
    // If the server isn't activated
    if(!activated)
        // Removing the background
        document.body.style.backgroundImage = "none";

    // Starting all when the page finished loading
    window.addEventListener('load', startAnimation(activated), false);

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
        if(!activated)
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
    stopCircle = true;
    // TODO: Activate the server
}

function desactivateServer() {
    // TODO: Desactivate the server
}
