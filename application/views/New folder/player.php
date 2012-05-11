<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- //////////// Site Name //////////// -->
<title> - TaranTism - You just gotta dance!</title>

<!-- //////////// Website Icon //////////// -->
<link rel="shortcut icon" href="http://www.tarantism.us/assets/images/tarantismico.png" />

<!-- //////////// STYLESSHEETS //////////// -->
<link href="http://www.tarantism.us/assets/css/style.css" type="text/css" rel="stylesheet" />
<link href="http://www.tarantism.us/assets/css/pirobox_lightbox.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="http://www.tarantism.us/assets/css/nivo-slider.css" type="text/css" media="screen" />

<!-- //////////// SCRIPTS //////////// -->
<script type="text/javascript" src="http://www.tarantism.us/assets/js/jquery.min.js"></script>
<script src="http://www.tarantism.us/assets/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
<script type="text/javascript" src="http://www.tarantism.us/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="http://www.tarantism.us/assets/js/pirobox.min.js"></script>
<script src="http://www.tarantism.us/assets/js/jquery.slidinglabels.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
	$().piroBox({
			my_speed: 400, //animation speed
			bg_alpha: 0.6, //background opacity
			slideShow : true, // true == slideshow on, false == slideshow off
			slideSpeed : 4, //slideshow duration in seconds(3 to 6 Recommended)
			close_all : '.piro_close,.piro_overlay'// add class .piro_overlay(with comma)if you want overlay click close piroBox

	});
});
</script>

<!-- //////////// Settings for fixed sidebar layout //////////// -->
<script type="text/javascript">
$(document).ready(function() {

	function staticNav() { 
		var sidenavHeight = $("#sidenav").height();
		var winHeight = $(window).height();
		var browserIE6 = (navigator.userAgent.indexOf("MSIE 6")>=0) ? true : false;

		if (browserIE6) {
			$("#sidenav").css({'position' : 'absolute'});
		} else {
			$("#sidenav").css({'position' : 'fixed'});
		}
	
		if (sidenavHeight > winHeight) {
			$("#sidenav").css({'position' : 'static'});
		}
	}
	
	staticNav();
	
	$(window).resize(function () { //Each time the viewport is adjusted/resized, execute the function
		staticNav();
	});

});
</script>

<script type="text/javascript" src="http://www.tarantism.us/assets/js/smoothscroll.js"></script>

<!-- //////////// Settings for Nivo Slider //////////// -->
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:15,
		animSpeed:500,
		pauseTime:6000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next &amp; Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left &amp; right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>

<script type="text/javascript">
    $(document).ready(function () {

            // transition effect
            style = 'easeOutBounce';

            // if the mouse hover the image
            $('.photo').hover(
                    function() {
                            //display heading and caption
                            $(this).children('div:first').stop(false,true).animate({top:0},{duration:600, easing: style});
                            $(this).children('div:last').stop(false,true).animate({bottom:0},{duration:600, easing: style});
                    },

                    function() {
                            //hide heading and caption
                            $(this).children('div:first').stop(false,true).animate({top:-50},{duration:600, easing: style});
                            $(this).children('div:last').stop(false,true).animate({bottom:-50},{duration:600, easing: style});
                    }
            );

    });
</script>

<script type="text/javascript">
$(function(){

	$('#contactform').slidinglabels({
	
		/* these are all optional */
		topPosition  : '8px',  // how far down you want each label to start
		leftPosition : '8px',  // how far left you want each label to start
		axis         : 'x',    // can take 'x' or 'y' for slide direction
		speed        : 'fast'  // can take 'fast', 'slow', or a numeric value

	});

});
</script>
<script type="text/javascript" src="http://www.tarantism.us/assets/js/swfobject.js"></script>	
		<script type="text/javascript">

			// JAVASCRIPT VARS
			// the path to the SWF file
			var swfPath = "http://www.tarantism.us/assets/swf/player.swf";
			//swfPath += "?t=" + Date.parse(new Date()); // uncomment this line to activate cache buster		
			
			// stage dimensions
			var stageW = 560;//560//"100%"; // minimum is 450
			var stageH = 300;//400;//"100%"; // minimum is 260
			
			
			// ATTRIBUTES
		    var attributes = {};
		    attributes.id = 'FlashComponent';
		    attributes.name = attributes.id;
		    
			// PARAMS
			var params = {};
			params.bgcolor = "#333333";
			params.allowfullscreen = "true";
			params.allowScriptAccess = "always";			
			//params.wmode = "transparent";
			

		    /* FLASH VARS */
			var flashvars = {};
			
			/// if commented / delete these lines, the component will take the stage dimensions defined 
			/// above in "JAVASCRIPT SECTIONS" section or those defined in the settings xml			
			flashvars.componentWidth = stageW;
			flashvars.componentHeight = stageH;							
			
			/// path to the content folder(where the xml files, images or video are nested)
			/// if you want to use absolute paths(like "http://domain.com/images/....") then leave it empty("")
            // Also, if you want the embed code to work correctly you'll need to set the an absolute path for pathToFiles, like this: http://www.yourwebsite.dom/.../mp3gallery/
			flashvars.pathToFiles = "http://www.tarantism.us/assets/mp3gallery/";
			flashvars.xmlPath = "http://www.tarantism.us/assets/xml/settings.xml";
			flashvars.contentXMLPath = "http://www.tarantism.us/albums/privatexml";
						
			/** EMBED THE SWF**/
			swfobject.embedSWF(swfPath, attributes.id, stageW, stageH, "9.0.124", "js/expressInstall.swf", flashvars, params, attributes);
		</script>
</head>

<body>

<!-- //////////// Container *Holds Left and Right Colums Together* //////////// -->
<div class="container">
    
    <!-- //////////// SideNavbar *Everything in Left-Hand Column* //////////// -->
    <div id="sidenav">
    	<a href="#home"><img src="http://www.tarantism.us/assets/images/Tarantismlogo.png" alt="" class="logo" border="0" /></a>
        
        <!-- //////////// MAIN NAVIGATION //////////// -->
        <ul>
            <!--<li><a class="portfolio" href="#portfolio">Portfolio // 2010</a></li>
            <li><a class="services" href="#services">Services &amp; Rates</a></li>-->
            <li><a class="contact" style="border-bottom: 0;" href="#contact">Contact Me</a></li>
        </ul>
        
        <!-- //////////// SOCIAL NETWORKING BLOCK //////////// -->
        <div id="social">
            <div class="social_facebook"><a href="http://www.facebook.com/" title="">&nbsp;</a></div><!-- //social_facebook -->
            <div class="social_twitter"><a href="http://www.twitter.com/" title="">&nbsp;</a></div><!-- //social_twitter -->
            <div class="social_lastfm"><a href="http://www.last.fm/" title="">&nbsp;</a></div><!-- //social_lastfm -->
            <div class="social_flickr"><a href="http://www.flickr.com/" title="">&nbsp;</a></div><!-- //social_flickr -->
        </div><!-- //social -->
        
        <!-- //////////// Sidenav Footer //////////// -->
        <div id="footer">
            &copy; Interr0Bang LLC 2012
        </div><!-- //footer -->
    </div><!-- //sidenav -->

    <!-- //////////// Anchor used to scroll to HOME //////////// -->
    <a name="home"></a>
    
    <!-- //////////// Content *Everything in Right-Hand Column* //////////// -->
    <div id="content">
	<a name="music"></a>
		<!-- this div will be overwritten by SWF object -->
		<center>
		    <div id="FlashComponent">
			    <p>In order to view this object you need Flash Player 9+ support!</p>
			    <a href="http://www.adobe.com/go/getflashplayer">
				    <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
			    </a>
		    </div>
		</center>
            <br />
            <!-- //////////// NIVO SLIDER //////////// 
            <div id="slider">
                    <img src="http://www.tarantism.us/assets/images/slider/slide1.jpg" alt="" />
                    <img src="http://www.tarantism.us/assets/images/slider/slide2.jpg" alt="" />
                    <a href="http://themeforest.net/user/Psylapse/?ref=psylapse" title=""><img src="images/slider/slide3.jpg" alt="" title="See More Psylapse Templates at Themeforest" /></a>
            </div>
            <br />
            <h2>Welcome to My Online Portfolio, Have a Look Around.</h2>
            <p></p>-->
    <!-- //////////// Anchor used to scroll to Music //////////// -->    
    <?php /*
    <!-- //////////// Anchor used to scroll to PORTFOLIO //////////// -->
    <a name="portfolio"></a>
            
            <h2>Portfolio // 2010 //  Website Design</h2>
            
            <div id="portfolio">
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work01" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work01" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work01" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work02" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work02" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work02" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work03" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work03" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work03" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="featured"></div><!-- //featured -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work04" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work04" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work04" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="featured"></div><!-- //featured -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work05" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work05" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work05" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="featured"></div><!-- //featured -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work06" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work06" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work06" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work07" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work07" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work07" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work08" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work08" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work08" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
                <div class="photowrapper">
                    <div class="latest"></div><!-- //latest -->
                    <div class="photo">
                    <div class="heading"><span>Project Title</span></div>
                    <img src="http://www.tarantism.us/assets/images/portfolio/sample_project/thumb.jpg" alt="" />
                    <div class="imagecaption">
                    <span>Screenshots:</span>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/01.jpg" class="pirobox_work09" title="Project Title">01</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/02.jpg" class="pirobox_work09" title="Project Title">02</a></div>
                    <div class="mini"><a href="http://www.tarantism.us/assets/images/portfolio/sample_project/03.jpg" class="pirobox_work09" title="Project Title">03</a></div>
                    </div><!-- //imagecaption -->
                    </div><!-- //photo -->
                    <div class="photocaption">
                    Project Title
                    </div><!-- //photocaption -->
                </div><!-- //photowrapper -->
                
            </div><!-- //portfolio -->
            
            <p>Commoveo wisi nulla pala illum melior quis. Et luptatum validus wisi ingenium humo quidne, eros lucidus dolore ea vel amet. Capto, praemitto singularis tation duis consequat. Jus vulputate ingenium mauris ut, vero. Enim suscipit exerci eligo dolus decet elit transverbero. </p>

    
    <!-- //////////// Anchor used to scroll to SERVICES //////////// -->
    <a name="services"></a>
            
            <h2>Services &amp; Rates</h2>
            
            <p>Commoveo wisi nulla pala illum melior quis. Et luptatum validus wisi ingenium humo quidne, eros lucidus dolore ea vel amet. Capto, praemitto singularis tation duis consequat. Jus vulputate ingenium mauris ut, vero enim.</p>
            
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th>&nbsp;</th>
                    <th>Lite<br /><strong>$150</strong></th>
                    <th>Basic<br /><strong>$350</strong></th>
                    <th>Full<br /><strong>$550</strong></th>
                </tr>
                <tr>
                    <td class="textright">Design Concepts Presented</td>
                    <td>01</td>
                    <td>02</td>
                    <td>03</td>
                </tr>
                <tr>
                    <td class="textright">Home Page Design</td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                </tr>
                <tr>
                    <td class="textright">Secondary Page Design</td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_no.gif" alt="No" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                </tr>
                <tr>
                    <td class="textright">Full Website Design Rollout</td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_no.gif" alt="No" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_no.gif" alt="No" /></td>
                    <td><img src="http://www.tarantism.us/assets/images/icon_rates_tick.gif" alt="Yes" /></td>
                </tr>
                <tr>
                    <td class="textright">Number of Reverts/Amendments</td>
                    <td>02</td>
                    <td>05</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td class="bottoms">&nbsp;</td>
                    <td class="bottoms"><span class="requestbutton"><a href="#contact">&nbsp;</a></span></td>
                    <td class="bottoms"><span class="requestbutton"><a href="#contact">&nbsp;</a></span></td>
                    <td class="bottoms"><span class="requestbutton"><a href="#contact">&nbsp;</a></span></td>
                </tr>
            </table>
            
            <p>Commoveo wisi nulla pala illum melior quis. Et luptatum validus wisi ingenium humo quidne, eros lucidus dolore ea vel amet. Capto, praemitto singularis tation duis consequat. Jus vulputate ingenium mauris ut, vero. Enim suscipit exerci eligo dolus decet elit transverbero. </p>
	  */?>
    <!-- //////////// Anchor used to scroll to CONTACT //////////// -->        
    <a name="contact"></a>
            
            <h2>Contact Me</h2>
            
            <form action="" method="post" id="contactform">
                <div id="name-wrap" class="slider"> 
                    <label for="name">Name</label> 
                    <input type="text" id="name" name="name" /> 
                </div><!--//name-wrap--> 
                
                <div id="email-wrap"  class="slider"> 
                    <label for="email">E&ndash;mail</label> 
                    <input type="text" id="email" name="email" /> 
                </div><!--//email-wrap-->
                
                <div id="phone-wrap"  class="slider"> 
                    <label for="phone">Phone</label> 
                    <input type="text" id="phone" name="phone" /> 
                </div><!--//phone-wrap--> 
                
                <div id="url-wrap"  class="slider"> 
                    <label for="url">URL</label> 
                    <input type="text" id="url" name="url" /> 
                </div><!--//email-wrap--> 
                
                <div id="comment-wrap"  class="slider"> 
                    <label for="comment">Comment</label> 
                    <textarea cols="53" rows="10" id="comment"></textarea> 
                </div><!--//comment-wrap--> 
                
                <div><button type="submit" id="btn" name="btn">Submit</button></div>
                
            </form>
            <?php /*
            <div id="contactdetails">
                
                <img src="http://www.tarantism.us/assets/images/map.gif" alt="Map" />
                
                <p>
                <strong>FIND ME</strong><br />
                2nd Floor, 246 Upper<br />
                Waterkant Street,<br />
                Cape Town, South Africa
                </p>
                
                <p>
                <strong>CALL ME</strong><br />
                Tel :+27 21 345 6789<br />
                Fax : +27 21 765 4321<br />
                E-mail : <a href="mailto:name@domain.com" title="Email Us">name@domain.com</a>
                </p>
                
                <!-- //////////// You can choose to use Google Maps, it does slow down page loading though //////////// -->
                <!--<iframe width="420" height="268" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.za/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=cape+town,+south+africa&amp;sll=-33.849889,18.424072&amp;sspn=1.083498,2.469177&amp;ie=UTF8&amp;hq=&amp;hnear=Cape+Town,+Western+Cape&amp;ll=-33.856732,18.424072&amp;spn=1.082571,2.469177&amp;z=9&amp;output=embed"></iframe>-->
            </div><!-- //contactdetails -->
		  */?>
            <div class="clearall"></div><!-- //clearall -->
            
            <div id="footfiller">
            </div><!-- //footfiller -->
            
    </div><!-- //content -->
    
</div><!-- //container -->
</body>
</html>