	$(document).ready(function(){
									
				$("#upload").uploadify({
						uploader: '<?php echo base_url();?>system/application/uploadify/uploadify.swf',
						script: '<?php echo base_url();?>system/application/uploadify/uploadify.php',
						cancelImg: '<?php echo base_url();?>system/application/uploadify/cancel.png',
						folder: '/MultiUpload/system/application/uploads',
						scriptAccess: 'always',
						multi: true,
						'onError' : function (a, b, c, d) {
							 if (d.status == 404)
								alert('Could not find upload script.');
							 else if (d.type === "HTTP")
								alert('error '+d.type+": "+d.info);
							 else if (d.type ==="File Size")
								alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
							 else
								alert('error '+d.type+": "+d.text);
							},
						'onComplete'   : function (event, queueID, fileObj, response, data) {
											//Post response back to controller
											$.post('<?php echo site_url('upload/uploadify');?>',{filearray: response},function(info){
												$("#target").append(info);  //Add response returned by controller																		  
											});								 			
						}
				});				
	});