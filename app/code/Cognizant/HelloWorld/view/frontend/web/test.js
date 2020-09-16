define(function() {
    'use strict';

    return function(config, node){
        console.log("test module javascript file loading through Requirejs");
        console.log(config);
        console.log(node);
    }

})