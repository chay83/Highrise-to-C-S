<?php
require_once 'functions.php';

if(isset($_POST['tag'])){
	
	
	foreach($_POST['tag'] as $key => $tag){
		$CS = $_POST['list'][$key];
		$HR = $tag;
		$result = hrToCs($HR,$CS);
		
		$message = '';
		
		if($result->was_successful()) {
		     
		    
		    if($result->response->TotalExistingSubscribers > 0) {
		        $message .= 'Updated '.$result->response->TotalExistingSubscribers.' existing subscribers in the list';        
		    } else if($result->response->TotalNewSubscribers > 0) {
		        $message .= 'Added '.$result->response->TotalNewSubscribers.' to the list';
		    } else if(count($result->response->DuplicateEmailsInSubmission) > 0) { 
		        $message .= $result->response->DuplicateEmailsInSubmission.' were duplicated in the provided array.';
		    }
		}
		
		$messages[] = $message;
	}
	
	
	
}

?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Highrise to Create&amp;Send</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="assets/js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container">
    <header>
		<?php 
			if(isset($messages)){
				echo "<ul>";
				foreach($messages as $message){
					echo "<li>" . $message . "</li>";
				}
				echo "</ul>";
			}
		?>
    </header>
    <div id="main" role="main">
		<form method="post" action="">
			<div class="row">
				<table>
						<tr>
							<td>Import Highrise contacts with tag</td>
							<td>
								<select name="tag[]">
									<?php
										foreach(getTags() as $tag){
											echo '<option value="' . $tag->id . '">' . $tag->name . '</option>';
										
										}							
									?>						
								</select>
							</td>
							<td>
								Into the 'Create &amp; Send' List
								
							</td>
							<td>
								<select name="list[]">
									<?php
										foreach(getLists() as $list){
											echo '<option value="' . $list->ListID . '">' . $list->Name . '</option>';
										
										}							
									?>						
								</select>
							</td>
						</tr>
				</table>
				<ul>
					<li><a href="#add" class="add">Add</a></li>
					<li><a href="#delete" class="remove">Remove</a></li>
 				</ul>
			</div>
			
			
			<input type="submit" value="go" id="submit" />
		</form>
    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="assets/js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="assets/js/plugins.js"></script>
  <script defer src="assets/js/script.js"></script>
  <!-- end scripts-->

 

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
