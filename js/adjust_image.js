/**
 * Created by Paul on 7/12/2015.
 */
/*$(function(){

    moveLeft();
});*/

function moveLeft(){
    $('#leftBtn').click(function(){
       // alert('Moving image left');

        visibleImage = $('.changeImage');
       // alert('Visible Image has class  and ID : ' + visibleImage.attr('class') + ' ' + visibleImage.attr('id'));
        // alert('First vissible image ' + visibleImage.length);
        var prevImage = visibleImage.prev();
       // alert('previous image length : ' + prevImage.length);
       // alert('previous image ID  : ' + prevImage.attr('id')); //$('img', this)
        //we have reached the end of the set of images
        //then wrap arround to the first image
        //getAttribute('id'));
        if(prevImage.length == 0)
        {
            //move to the first
          //     alert('moving to first ...');
            prevImage = $('#image_div img').filter(':first');
            //   alert('First image length : ' + nextImage.length);
            //   alert('first Image has class' + nextImage.attr('class'));
          //  alert('first Image has Id' + prevImage.attr('id'));
        }

        //this is where the change happens
        if(prevImage.hasClass('hidden'))
        {
            // alert('Yes next img has class ' + nextImage.attr('class'));
            //change the class on the visible image to hidden
            visibleImage.removeClass('changeImage').addClass('hidden').fadeOut(100);
            //move the previous image with class hidden into position
            prevImage.removeClass('hidden').addClass('changeImage').fadeIn(100);

            //visibleImage = prevImage.next();
        }


        //  alert('Visible Image ' + visibleImage.length );




    });
}


function moveRight(){
    $('#rightBtn').click(function(){
       // alert('Moving image right');

        visibleImage = $('.changeImage');
       // alert('Visible Image has class  and ID : ' + visibleImage.attr('class') + ' ' + visibleImage.attr('id'));
        // alert('First vissible image ' + visibleImage.length);
        var nextImage = visibleImage.next();
        //alert('next image length : ' + nextImage.length);
       // alert('next image ID  : ' + nextImage.attr('id')); //$('img', this)
        //we have reached the end of the set of images
        //then wrap arround to the first image
        //getAttribute('id'));
        if(nextImage.length == 0)
        {
            //move to the first
          //  alert('moving to first ...');
            nextImage = $('#image_div img').filter(':first');
            //   alert('First image length : ' + nextImage.length);
          //  alert('first Image has Id ' + nextImage.attr('id'));
        }

        //this is where the change happens
        if(nextImage.hasClass('hidden'))
        {
            // alert('Yes next img has class ' + nextImage.attr('class'));
            //change the class on the visible image to hidden
            visibleImage.removeClass('changeImage').addClass('hidden').fadeOut(100);
            //move the previous image with class hidden into position
            nextImage.removeClass('hidden').addClass('changeImage').fadeIn(100);

            //visibleImage = prevImage.next();
        }


        //  alert('Visible Image ' + visibleImage.length );

    });
}