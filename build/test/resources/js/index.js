var activateServer, backgroundPath, circlesActivated, desactivateServer, doServerStartAnimation, doServerStopAnimation, drawCanvas, sendRequest, serverActivated, start, startAnimation;

circlesActivated = false;

serverActivated = void 0;

backgroundPath = void 0;

startAnimation = function() {
  $('#sharklogo').fadeOut('slow');
  $('#logo').fadeIn('slow');
  drawCanvas();
  if (serverActivated) {
    doServerStartAnimation();
  }
};

drawCanvas = function() {
  var canvas, ctx, draw, radius;
  canvas = document.getElementById('canvas');
  ctx = canvas.getContext('2d');
  ctx.globalAlpha = 0.25;
  radius = 150;
  draw = function() {
    var drawCircle, drawLogoCircle;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawCircle = function() {
      if (radius === 105 && serverActivated) {
        return;
      }
      ctx.globalAlpha = 0.25;
      if (radius > 135) {
        ctx.globalAlpha = 0.25 - ((radius - 135) / 100);
      } else if (radius < 120) {
        ctx.globalAlpha = (radius - 105) / 60;
      }
      ctx.beginPath();
      ctx.arc(canvas.width / 2, canvas.height / 2, radius, 0, 2 * Math.PI);
      ctx.strokeStyle = '#fff';
      ctx.lineWidth = 15;
      ctx.stroke();
      radius += radius / 200;
      if (radius > 160) {
        radius = 105;
        if (!circlesActivated) {
          return;
        }
      }
    };
    drawLogoCircle = function() {
      ctx.globalAlpha = 1.0;
      ctx.beginPath();
      ctx.arc(canvas.width / 2, canvas.height / 2, 100, 0, 2 * Math.PI);
      if (serverActivated) {
        ctx.strokeStyle = '#00ff00';
      } else {
        ctx.strokeStyle = '#ff0000';
      }
      ctx.lineWidth = 10;
      ctx.stroke();
    };
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawCircle();
    drawLogoCircle();
    requestAnimationFrame(draw);
  };
  ctx.globalAlpha = 0.25;
  radius = 105;
  draw();
};

start = function(activated, background) {
  var canvas, logo;
  serverActivated = activated;
  circlesActivated = !serverActivated;
  backgroundPath = background;
  if (!serverActivated) {
    document.body.style.backgroundImage = 'none';
  }
  window.addEventListener('load', startAnimation(), false);
  canvas = $('#canvas');
  logo = document.getElementById('logo');
  canvas.mouseover(function() {
    logo.src = logo.src.replace('.png', '_hover.png');
  });
  canvas.click(function() {
    if (!serverActivated) {
      activateServer();
    } else {
      desactivateServer();
    }
  });
  canvas.mouseleave(function() {
    logo.src = logo.src.replace('_hover.png', '.png');
  });
};

activateServer = function() {
  circlesActivated = false;
  serverActivated = true;
  doServerStartAnimation();
  sendRequest('../set-enabled/true');
};

desactivateServer = function() {
  circlesActivated = true;
  serverActivated = false;
  document.body.style.backgroundImage = 'none';
  doServerStopAnimation();
  sendRequest('../set-enabled/false');
};

doServerStartAnimation = function() {
  document.body.style.backgroundImage = 'url(' + backgroundPath + ')';
  $('#centerDiv').animate({
    top: '32%'
  }, function() {
    var infos;
    infos = document.getElementById('infos');
    infos.innerHTML = infos.innerHTML.replace('jQueryVersion', jQuery.fn.jquery);
    $('#textlogo').fadeIn();
    $('#infos').fadeIn(function() {
      $('#statistics').fadeIn();
      $('#settings').fadeIn(function() {
        $('#disconnect').fadeIn();
        $('#about').fadeIn();
      });
    });
  });
};

doServerStopAnimation = function() {
  $('#disconnect').fadeOut();
  $('#about').fadeOut(function() {
    $('#statistics').fadeOut();
    $('#settings').fadeOut(function() {
      $('#infos').fadeOut();
      $('#textlogo').fadeOut(function() {
        $('#centerDiv').animate({
          top: '50%'
        });
        document.body.style.backgroundImage = 'none';
      });
    });
  });
};

sendRequest = function(request) {
  var xhr;
  xhr = new XMLHttpRequest;
  xhr.open('GET', request, true);
  xhr.send(null);
};
