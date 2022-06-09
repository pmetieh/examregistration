/*  function popup(){
    $(function(){
        alert('jQuery on Index page');
    });
}

function dropdownMenu(){
    	$(function(){
        $('ul > li').hover(
        function(){ 
            $('ul', this).css({display: "block",
                               width : "150px";,
                               position: "absolute",
                               top: "30px" });
            $('ul', this).stop().slideDown(2000), function(){$('ul', this).stop().slideUp(3000)});
    });
}*/
//var visibleImage;
function moveImage(){
    
    $(function(){
       // alert('Switching image');
       // switchImge();
       var numImages = $('#image_div img').length;
       // alert('Number of images in gallery '+ numImages);
        //alert('The wrapper set contains ..');
        //for( var i = 0; i < numImages; i++)
        //{
        //var firstObj = $('#image_div img').filter(':first');
        //    alert('First object : ' + firstObj.attr('id'));
        //alert('First object parent Id : ' + firstObj.parent().attr('id'));
        //alert('Next image id : ' + firstObj.next().attr('id'));
       // }
       setInterval(function(){switchImge(numImages)}, 10000);
        //alert($('img').hasClass('hidden'));
    });
}


function switchImge(numImages){


     //alert('Number of Images : ' + numImages);

       var visibleImage = $('.changeImage');
      // alert('Visible Image has class  and ID : ' + visibleImage.attr('class') + ' ' + visibleImage.attr('id'));
       // alert('First vissible image ' + visibleImage.length);
        var nextImage = visibleImage.next('img');
       // alert('next image length : ' + nextImage.length);
       // alert('next image ID  : ' + nextImage.attr('src')); //$('img', this)
       //alert('next image is  : ' + nextImage.is());
    //we have reached the end of the set of images
        //then wrap arround to the first image
        //getAttribute('id'));

        if(nextImage.length == 0)
        {
            //move to the first
           //alert('moving to first ...');
            nextImage = $('#image_div img').filter(':first');
          //  alert('First image length : ' + nextImage.length);
          //alert('first Image has class' + nextImage.attr('class'));
        }

        //this is where the change happens
        if(nextImage.hasClass('hidden'))
        {
           // alert('Yes next img has class ' + nextImage.attr('class'));
            //change the class on the visible image to hidden
            visibleImage.removeClass('changeImage').addClass('hidden').fadeOut(100);
            //move the next image with class hidden into position 
            nextImage.removeClass('hidden').addClass('changeImage').fadeIn(100);

            visibleImage = nextImage.next();
        }

       
      //  alert('Visible Image ' + visibleImage.length );
}

function test() {

}


