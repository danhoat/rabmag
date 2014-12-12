
$(document).ready(function($){
    console.log('da vao');
            jQuery('.flexslider').flexslider({
              animation: "slide",
              animationSpeed: 400,
              animationLoop: false,
              itemWidth: 210,
              itemMargin: 1,
             // minItems: getGridSize(), // use function to pull in initial value
             // maxItems: getGridSize(), // use function to pull in initial value
              start: function(slider){
                $('body').removeClass('loading');
                flexslider = slider;
              }
            });            
    });
