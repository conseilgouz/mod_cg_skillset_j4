/**
 * CG Skillset module
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE
 * From JD SkillSet 1.7
 */
document.addEventListener('DOMContentLoaded', function() {
    mains = document.querySelectorAll('.cg_skillset');
    for(var i=0; i<mains.length; i++) {
        var $this = mains[i];
        myid = $this.getAttribute("data");
        go_skill(myid);
    }
})
function go_skill(id)  {
    window.onscroll = function() {
        var _element = document.querySelector('#cg_skillset'+id+'.skillset-not-counted');
        if ( _element && _element.length != 0 && elementInViewport(_element)) {
            _element.classList.remove('skillset-not-counted');
            counts = document.querySelectorAll('#'+_element.id+" .count").forEach(counter);
            }
        };
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

  const loop = () => {
    let elaps = Date.now() - timeStart;
    if (elaps > duration) elaps = duration; // Stop the loop
    const norm = ease.inOutQuad(elaps / duration); // normalised value + easing
    const step = norm * range; // Calculate the value step
    curr = start + step; // Increment or Decrement current value
    EL.textContent = Math.trunc(curr); // Apply to UI as integer
    if (elaps < duration) requestAnimationFrame(loop); // Loop
  };

  requestAnimationFrame(loop); // Start the loop!
};
