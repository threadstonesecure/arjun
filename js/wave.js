function Curve(points) {
  this.points = points;
  this.ballRadius = 3;
  this.speed = 0.12;
  this.vy = 2 + Math.random() * 2;
}

Curve.prototype.draw = function() {
  var length = this.points.length - 2,
  ctrlPoint = {},
  i;

  ctx.save();
  ctx.beginPath();
  ctx.moveTo(this.points[0].x, this.points[0].y);
  for (i = 1; i < length; i++) {
    ctrlPoint.x = (this.points[i].x + this.points[i + 1].x) / 2;
    ctrlPoint.y = (this.points[i].y + this.points[i + 1].y) / 2; 
    ctx.quadraticCurveTo(this.points[i].x, this.points[i].y, ctrlPoint.x, ctrlPoint.y);
  }
  ctx.quadraticCurveTo(this.points[i].x, this.points[i].y, this.points[i + 1].x, this.points[i + 1].y);
  ctx.lineTo(W, this.points[i + 1].y);
  ctx.lineTo(W, H);
  ctx.lineTo(0, H);
  ctx.lineTo(0, this.points[0].y);
  ctx.closePath();
  ctx.fillStyle = '#00A388';
  ctx.fill();
  ctx.restore();
}

function getMousePos(element) {
  var mouse = {x: 0, y: 0};
  element.addEventListener('mousemove', function(e){
    mouse.x = e.pageX;
    mouse.y = e.pageY;
  }, false);
  return mouse;
}

var canvas = document.querySelector('canvas'),
    ctx = canvas.getContext('2d'),
    W = canvas.width = window.innerWidth,
    H = canvas.height = window.innerHeight,
    limit = W / 2.2,
    points = [],
    mouse = getMousePos(canvas),
    curve;

for (var x = 0; x <= W + 100; x += 100) {
  points.push({
    x: x,
    y: H / 1.7,
    oldY: H / 1.7,
    targetY: H / 1.7 - H / 3 + Math.random() * ((H / 3) * 2),
    speed: 0.1,
    vy: 5 + Math.random() * 5,
    gravity: 0.85,
    vyy: 3 + Math.random() * 4
  });
}

curve = new Curve(points);

function drawCurve(curve) {
  var dx, dy, dist;
  curve.points.forEach(function(point) {
    dx = mouse.x - point.x;
    dy = mouse.y - point.y;
    dist = Math.sqrt(dx * dx + dy * dy);
    if (dist < 200) {
      point.vy = (point.targetY - point.y) * point.speed;
    } else {
      point.vy += (point.oldY - point.y) * point.speed;
      point.vy *= point.gravity;
    }
    point.y += point.vy;
  });
  curve.draw(ctx);
}

(function drawFrame(){
  window.requestAnimationFrame(drawFrame, canvas);
  ctx.fillStyle = '#FFFF9D';
  ctx.fillRect(0, 0, W, H);
  drawCurve(curve);
}());