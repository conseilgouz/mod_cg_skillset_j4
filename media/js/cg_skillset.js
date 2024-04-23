/**
 * CG Skillset module
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE
 * From JD SkillSet 1.7
 */
 var options_skillset = [];
 
document.addEventListener('DOMContentLoaded', function() {
    mains = document.querySelectorAll('.cg_skillset');
    for(var i=0; i<mains.length; i++) {
        var $this = mains[i];
        myid = $this.getAttribute("data");
        options_skillset[myid] = Joomla.getOptions('cg_skillset_'+myid);
        init_skill(myid);
        go_skill(myid);
    }
})
function init_skill(myid) {
    let options = options_skillset[myid];
    if (options.customstyle == "0") return;
    for (var i=0; i< options.skillsets;i++) {
        id = '#skillset-skillsets'+i+'-'+myid;
        field = document.querySelector(id+' .counter-title');
        if (field) {
            field.style.fontSize = options.titleSize + 'px';
            field.style.color = options.titleColor;
        }
        field = document.querySelector(id+' .counter-title a');
        if (field) {
            field.style.fontSize = options.titleSize + 'px';
            field.style.color = options.titleColor;
        }
        field = document.querySelector(id+' .counter-number .count');
        if (field) {
            field.style.fontSize = options.numberSize + 'px';
            field.style.color = options.numberColor;
        }
        field = document.querySelector(id+' .counter-number .symbol');
        if (field) {
            field.style.fontSize = options.symbolSize + 'px';
            field.style.color = options.symbolColor;
        }
        field = document.querySelector(id+' .count-icon');
        if (field) {
            field.style.fontSize = options.iconSize + 'px';
            field.style.color = options.iconColor;
        }
    }
    if (options.animationShape == "0") return;
    id = '#cg_skillset'+myid;
    fields = document.querySelectorAll(id+" .circular-progress");
    fields.forEach(sizes);
    fields = document.querySelectorAll(id+" .inner-circle");
    fields.forEach(sizesIn);
    
    fields = document.querySelectorAll(id+" .inner-circle");
    for (var i=0; i< fields.length;i++) {
        fields[i].style.backgroundColor = fields[i].getAttribute("data-inner-circle-color");
    }
}
const sizes = (EL) => {
    let id = EL.getAttribute('data-id');
    let options = options_skillset[id];
    text_container = EL.querySelector('.counter-text-container');
    val = Math.max(text_container.offsetWidth, text_container.offsetHeight);
    if (options.animationShape == "round") {
        EL.style.width=  (val + 40) + 'px';
        EL.style.height= (val + 40) + 'px';
    }
    if (options.animationShape == "rect") {
        EL.style.width=  (val + 40) + 'px';
        EL.style.height= (val -10) + 'px';
        EL.style.borderRadius = "30%";
    }
}
const sizesIn = (EL) => {
    let id = EL.getAttribute('data-id');
    let options = options_skillset[id];
    EL.style.width=  (parseInt(EL.parentNode.offsetWidth) - 20) + 'px';
    EL.style.height= (parseInt(EL.parentNode.offsetHeight)- 20) + 'px';
    if (options.animationShape == "rect") {
        EL.style.borderRadius = "30%";
    }
}
function go_skill(id)  {
    var _element = document.querySelector('#cg_skillset'+id+'.skillset-not-counted');
    // Element on screen ?
    if ( _element && _element.length != 0 && elementInViewport(_element)) {
            _element.classList.remove('skillset-not-counted');
            counts = document.querySelectorAll('#'+_element.id+" .count").forEach(counter);
    } else { // not visible : check on scroll
        window.onscroll = function() {
            var _element = document.querySelector('#cg_skillset'+id+'.skillset-not-counted');
            if ( _element && _element.length != 0 && elementInViewport(_element)) {
                _element.classList.remove('skillset-not-counted');
                counts = document.querySelectorAll('#'+_element.id+" .count").forEach(counter);
                }
            };
    }
}
// from https://stackoverflow.com/questions/123999/how-can-i-tell-if-a-dom-element-is-visible-in-the-current-viewport
var elementInViewport = function(element) {
    var _this = element;
    var rect = _this.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
    );    
};
// from https://stackoverflow.com/questions/70746105/animate-counter-from-start-to-end-value
 const ease = {
  linear: t => t,
  inOutQuad: t => t<.5 ? 2*t*t : -1+(4-2*t)*t,
  // Find out more at: https://gist.github.com/gre/1650294
};
const counter = (EL) => {

  const duration = 4000; // Animate all counters equally for a better UX

  const start = parseInt(EL.textContent, 10); // Get start and end values
  const end = parseInt(EL.dataset.counter, 10); // PS: Use always the radix 10!

  if (start === end) return; // If equal values, stop here.

  const range = end - start; // Get the range
  let curr = start; // Set current at start position
  
  const timeStart = Date.now();
  width = EL.style.width;
  // document.documentElement.style.setProperty('--progress-bar-width', width+"px");

  const loop = () => {
    progressBar = EL.parentNode.parentNode.parentNode;
    progressColor = progressBar.getAttribute("data-progress-color");
    
    let elaps = Date.now() - timeStart;
    if (elaps > duration) elaps = duration; // Stop the loop
    const norm = ease.inOutQuad(elaps / duration); // normalised value + easing
    const step = norm * range; // Calculate the value step
    curr = start + step; // Increment or Decrement current value
    EL.textContent = Math.trunc(curr); // Apply to UI as integer
    percent = (curr / end) * 100;
    if (progressColor) { // progressbar exisrs
        progressBar.style.background = `conic-gradient(${progressColor} ${
        percent * 3.6
        }deg,${progressBar.getAttribute("data-bg-color")} 0deg)`;
    }
    if (elaps < duration) requestAnimationFrame(loop); // Loop
  };

  requestAnimationFrame(loop); // Start the loop!
};
