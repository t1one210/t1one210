$(document).ready(function(){
	
	$("solutions-slider").owlCarousel({
		loop: true,
		margin: 0,
		autoWight: true,
		items: 2,
		nav: true,
	});

    $(function() {
    // Owl Carousel
    var owl = $(".owl-carousel");
    owl.owlCarousel({
    items: 1,
    margin: 10,
    loop: true,
    nav: true,
    autoHeight : true,
    });
    });

    
	/*$('.owl-carousel').click(function(event) {
		$('.item').removeClass('.active')
		var num = $(this).attr('.item');
		$('.owl-carousel'+num).addClass('.item')
	});
    */
    
  /*$('.next').click(function(){
    $('.front').removeClass('active');
    $('.front1').addClass('active');
    $('.back').show();

});

$('prev').click(function(){
    $('a').removeClass('front');
    $(this).addClass('back');
    $('.back').show();
    $('.front').hide();
});
  
	$('.buttons, .prev, .next').on('click', function(){
		$('.solutions-bottom').removeClass('front');
		$('.solutions-bottom').toggleClass('front1');
		$(this).parent().next().toggle( "slow");
		return false;
	});*/
  
    $('.menu').on('click', function(){    
    $('#podmenu').toggle("slow");
    });
  
	jQuery('.fa fa-search').on("click", function(){
        var search = jQuery(this).closest('search1');
        search.toggleClass("active");
        if (search.hasClass("active")) {
            search.find("input").focus();
        }
        
        // нажатие на внешние блоки
        jQuery(document).on("mouseup", function(e) {
            if (!search.is(e.target) && search.has(e.target).length === 0 && search.hasClass("active")) {
                search.toggleClass("active");
            }
        });
        
        return false;
    });
});