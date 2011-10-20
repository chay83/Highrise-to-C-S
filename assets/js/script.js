$(function() {


	$('form').submit(function(event){
		
		event.preventDefault(); 
		
		$('table').addClass('loading');
		$('#submit').attr('disabled','disabled');
		
	    var $form = $( this ),
	        url = $form.attr( 'action' );
		
	    $.post( url, $(this).serialize(),
	      function( data ) {	      
	      	 $results = $(data).find('header').html();
	         $($results).find('ul li').each(function(){
	         	var $message = $('<span class="message" />');
	         	$message.text($(this).text());
	         	$message.appendTo($('div.row:eq("' + $(this).index() + '")'));
	         });
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