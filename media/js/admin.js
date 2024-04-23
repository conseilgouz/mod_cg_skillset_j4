/**
 * CG Skillset module
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE
 * From JD SkillSet 1.7
 */
document.addEventListener("DOMContentLoaded", function(){
    // check CG custom classes
    fields = document.querySelectorAll('.view-module .clear');
    for(var i=0; i< fields.length; i++) {
        let field = fields[i];
        field.parentNode.parentNode.style.clear = "both";
    }
    fields = document.querySelectorAll('.view-module .left');
    for(var i=0; i< fields.length; i++) {
        let field = fields[i];
        field.parentNode.parentNode.style.float = "left";
    }
    fields = document.querySelectorAll('.view-module .right');
    for(var i=0; i< fields.length; i++) {
        let field = fields[i];
        field.parentNode.parentNode.style.float = "right";
    }
    fields = document.querySelectorAll('.view-module .half');
    for(var i=0; i< fields.length; i++) {
        let field = fields[i];
        field.style.width = "50%";
    }
    fields = document.querySelectorAll('.view-module .gridauto');
    for(var i=0; i< fields.length; i++) {
        let field = fields[i];
        field.parentNode.parentNode.style.gridColumn = "auto";
    }
})