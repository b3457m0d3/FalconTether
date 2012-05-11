<a name="contact"></a>
            
            <h2>Contact Us</h2>
            <?php echo validation_errors(); ?>
            <form action="http://www.tarantism.us/" method="post" id="contactform">
                <div id="name-wrap" class="slider"> 
                    <label for="name">Name</label> 
                    <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>"/> 
                </div><!--//name-wrap--> 
                
                <div id="email-wrap"  class="slider"> 
                    <label for="email">E&ndash;mail</label> 
                    <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>"/> 
                </div><!--//email-wrap-->
                
                <div id="phone-wrap"  class="slider"> 
                    <label for="phone">Phone</label> 
                    <input type="text" id="phone" name="phone"/> 
                </div><!--//phone-wrap--> 
                
                <div id="url-wrap"  class="slider"> 
                    <label for="url">URL</label> 
                    <input type="text" id="url" name="url" /> 
                </div><!--//email-wrap--> 
                
                <div id="comment-wrap"  class="slider"> 
                    <label for="comment">Comment</label> 
                    <textarea cols="53" rows="10" name="comment" id="comment"><?php echo set_value('comment'); ?></textarea> 
                </div><!--//comment-wrap--> 
                
                <div><button type="submit" id="btn" name="btn">Submit</button></div>
                
            </form><?php
	    
	    /*
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
