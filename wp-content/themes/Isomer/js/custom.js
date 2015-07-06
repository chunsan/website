jQuery(document).ready(function($){

    // Flexslider
    $('#slider-box').flexslider({
        controlNav: false
    });

    // Fitvids         
    $("#video-box").fitVids();

    //portfolio filter
    $(function(){
        $('#folio-filter a').click(function(e){
        	$('#folio-filter li').removeClass('active');
        	$(this).parent('li').addClass('active');
        	var itemSelected = $(this).attr('data-filter');
        	$('.folio-item').each(function(){
        		if (itemSelected == '.all'){
        			$(this).removeClass('filtered').removeClass('selected');
        			return;
        		} else if($(this).is(itemSelected)){
        			$(this).removeClass('filtered').addClass('selected');
        		} else{
        			$(this).removeClass('selected').addClass('filtered');
        		}
        	});
        });
    });



                $('#scotch-panel').scotchPanel({
                    containerSelector: 'body',
                    direction: 'right',
                    duration: 300,
                    transition: 'ease',
                    clickSelector: '.toggle-panel',
                    distanceX: '250px',
                    enableEscapeKey: true
                });


});