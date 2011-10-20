/* Author: 

*/

$(document).ready(function(){
	$('form').submit(function(event){
		$('table').addClass('loading');
		$('#submit').attr('disabled','disabled');
		
	    /* stop form from submitting normally */
	    event.preventDefault(); 
	        
	    /* get some values from elements on the page: */
	    var $form = $( this ),
	        url = $form.attr( 'action' );
	
	    /* Send the data using post and put the results in a div */
	    $.post( url, $(this).serialize(),
	      function( data ) {
	      
	         $('header').html($(data).find('header').html());
	         $('table').removeClass('loading');
	         $('#submit').removeAttr('disabled');
	         
	      }
	    );
		
		return false;	
	});
	
	$('a.add').live('click',function(e){
		e.preventDefault();
		
		$row = $(this).closest('div.row');		
		$row.clone().hide().insertAfter($row).show('slow');
		
		if($('div.row').size() > 1){
			$('a.remove').show();		
		}else{
			$('a.remove').hide();
		}
	
		return false;
	});
	$('a.remove').live('click',function(e){
		e.preventDefault();
		
		$row = $(this).closest('div.row');		
		$row.hide('slow',function(){
			$(this).remove();
			if($('div.row').size() == 1){
				$('a.remove').hide();
			}	
		});
		
		return false;
		
		
	
	});
});