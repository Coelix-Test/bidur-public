window.makeItRain = async function(n, append) {

  var fallTime, rotateTime, delayTime;
  var colors = [ '#e3b436', '#eec447', '#d4a21f' ];

  if (!n) { n = 20 }

  for (var i = 0; i < n; i++) {
    let el = document.createElement('div');
    el.classList.add('fetti');

    fallTime = ((Math.random() * 10) + 3);
    rotateTime = ((Math.random() * 2) + 1);

    el.style.left = Math.floor(append.offsetWidth * Math.random()) + 'px';
    el.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    el.style.animation = `fettiFall ${fallTime}s linear, fettiRotate ${rotateTime}s infinite linear`;
    // el.style.transition = `top ${delayTime}s linear`

    setTimeout(() => {
      append.removeChild(el);
    }, fallTime * 1000);

    append.appendChild(el);
  }

};


window.UUID = function uuidv4() {
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
