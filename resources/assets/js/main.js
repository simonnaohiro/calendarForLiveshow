let submit = document.getElementById('submit');
let load_ani = document.getElementById('load-ani');




submit.addEventListener('click', function(){
    if(load_ani.style.display == 'none'){
        load_ani.style.display = '';
    }
    load_ani.classList.add('loader');

    fadeOut(load_ani, 4000, removeLoader);
});

var removeLoader = function() {
    load_ani.classList.remove('loader');
}

var fadeOut = function(element, time, callback) {
    var fadeTime     = (time) ? time : 400,
        keyFrame     = 30,
        stepTime     = fadeTime / keyFrame,
        minOpacity   = 0,
        stepOpacity  = 1 / keyFrame,
        opacityValue = 1,
        sId          = '';
 
    if (!element) return;
 
    element.setAttribute('data-fade-stock-display', element.style.display.replace('none', ''));
 
    var setOpacity = function(setNumber) {
        if ('opacity' in element.style) {
            element.style.opacity = setNumber;
        } else {
            element.style.filter = 'alpha(opacity=' + (setNumber * 100) + ')';
 
            if (navigator.userAgent.toLowerCase().match(/msie/) &&
                !window.opera && !element.currentStyle.hasLayout) {
                element.style.zoom = 1;
            }
        }
    };
 
    if (!callback || typeof callback !== 'function') callback = function() {};
 
    setOpacity(1);
 
    sId = setInterval(function() {
        opacityValue = Number((opacityValue - stepOpacity).toFixed(12));
 
        if (opacityValue < minOpacity) {
            opacityValue = minOpacity;
            element.style.display = 'none';
            clearInterval(sId);
        }
 
        setOpacity(opacityValue);
 
        if (opacityValue === minOpacity) callback();
    }, stepTime);
 
    return element;
};