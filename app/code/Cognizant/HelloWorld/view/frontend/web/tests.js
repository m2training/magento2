define(function() {
    'use strict';

    var mageJsComponent = function(config, node){
        console.log("test module javascript file loading through Requirejs");
        console.log(config);
        console.log(node); 
    }

    return mageJsComponent;

})