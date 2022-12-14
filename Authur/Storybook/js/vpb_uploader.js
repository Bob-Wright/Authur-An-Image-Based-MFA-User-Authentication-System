/***********************************************************************************************************
* This script was adapted from Vasplus Programming Blog
   Fancy Multiple File Upload using Ajax, Jquery and PHP
   Written by Vasplus Programming Blog
   Website: www.vasplus.info
   Email: info@vasplus.info
  
  *********************************Copyright Information*****************************************************
   This script has been released with the aim that it will be useful.
   Please, do not remove this copyright information from the top of this page.
  If you want the copyright info to be removed from the script then you have to buy this script.
  This script must not be used for commercial purpose without the consent of Vasplus Programming Blog.
  This script must not be sold.
 All Copy Rights Reserved by Vasplus Programming Blog
 14*************************************************************************************************************/

function vpb_multiple_file_uploader(vpb_configuration_settings)
{
	this.vpb_settings = vpb_configuration_settings;
	this.vpb_files = "";
	this.vpb_browsed_files = []
	var self = this;
	var vpb_msg = "Sorry, your browser does not support this application. Thank You!";
	
	//Get all browsed file extensions
	function vpb_file_ext(file) {
		return (/[.]/.exec(file)) ? /[^.]+$/.exec(file.toLowerCase()) : '';
	}
	
	/* Display added files which are ready for upload */
	//with their file types, names, size, date last modified along with an option to remove an unwanted file
	vpb_multiple_file_uploader.prototype.vpb_show_added_files = function(vpb_value)
	{
		this.vpb_files = vpb_value;
		if(this.vpb_files.length > 0)
		{
			var vpb_added_files_displayer = vpb_file_id = "";
 			for(var i = 0; i<this.vpb_files.length; i++)
			{
				//Use the names of the files without their extensions as their ids
				var files_name_without_extensions = this.vpb_files[i].name.substr(0, this.vpb_files[i].name.lastIndexOf('.')) || this.vpb_files[i].name;
				//.replace(/[\s]/g, '_')
				vpb_file_id = files_name_without_extensions.replace(/[^a-z0-9\s]/gi, '').replace(/[\s]/g, '_');
				
				var vpb_file_to_add = vpb_file_ext(this.vpb_files[i].name);
				var vpb_class = $("#added_class").val();
				var vpb_file_icon;
				
				//Check and display File Size
				var vpb_fileSize = (this.vpb_files[i].size / 1024);
				if (vpb_fileSize / 1024 > 1)
				{
					if (((vpb_fileSize / 1024) / 1024) > 1)
					{
						vpb_fileSize = (Math.round(((vpb_fileSize / 1024) / 1024) * 100) / 100);
						var vpb_actual_fileSize = vpb_fileSize + " GB";
					}
					else
					{
						vpb_fileSize = (Math.round((vpb_fileSize / 1024) * 100) / 100)
						var vpb_actual_fileSize = vpb_fileSize + " MB";
					}
				}
				else
				{
					vpb_fileSize = (Math.round(vpb_fileSize * 100) / 100)
					var vpb_actual_fileSize = vpb_fileSize  + " KB";
				}
				
				//Check and display the date that files were last modified
				var vpb_date_last_modified = new Date(this.vpb_files[i].lastModifiedDate);
				var hh = vpb_date_last_modified.getHours();
				var nn = vpb_date_last_modified.getMinutes();
				if (nn <= 9) {nn = '0' + nn;}
				var dd = vpb_date_last_modified.getDate();
				var mm = vpb_date_last_modified.getMonth() + 1;
				var yyyy = vpb_date_last_modified.getFullYear();
				var vpb_date_last_modified_file = mm + '/' + dd + '/' + yyyy + '@' + hh + ':' + nn;
				
				//File Display Classes
				if( vpb_class == 'vpb_blue' ) { 
					var new_classc = 'vpb_white';
				} else {
					var new_classc = 'vpb_blue';
				}
				
				if(typeof this.vpb_files[i] != undefined && this.vpb_files[i].name != "")
				{
					//Check for the type of file browsed so as to represent each file with the appropriate file icon
					
					vpb_file_icon = '<img src="images/general.png" width="60px" align="absmiddle" border="0" alt="" />';

					if( vpb_file_to_add == "jpg" || vpb_file_to_add == "JPG" || vpb_file_to_add == "jpeg" || vpb_file_to_add == "JPEG" || vpb_file_to_add == "gif" || vpb_file_to_add == "GIF" || vpb_file_to_add == "png" || vpb_file_to_add == "PNG" || vpb_file_to_add == "mp3" || vpb_file_to_add == "MP3" ) 
					{
						vpb_file_icon = '<img src="images/images_file.gif" width="60px" align="absmiddle" border="0" alt="" />';
					}
					if( vpb_file_to_add == "txt" || vpb_file_to_add == "TXT") 
					{
						vpb_file_icon = '<img src="images/txt.png" width="60px" align="absmiddle" border="0" alt="" />';
					}
					
					//Assign browsed files to a variable so as to later display them below
					vpb_added_files_displayer += '<tr id="add_fileID'+vpb_file_id+'" class="'+new_classc+'"><td>'+vpb_file_icon+' '+this.vpb_files[i].name.substring(0, 48)+'</td><td><span id="uploading_'+vpb_file_id+'"><span style=color:blue;>Ready</span></span></td><td>'+vpb_actual_fileSize+'</td><td>'+vpb_date_last_modified_file+'</td><td><span id="remove'+vpb_file_id+'"><span class="vpb_files_remove_left_inner" onclick="vpb_remove_this_file(\''+vpb_file_id+'\',\''+this.vpb_files[i].name+'\');">Remove</span></span></td></tr></div>';
					
				}
			}
			//Display browsed files on the screen to the user who wants to upload them
			$("#add_files").append(vpb_added_files_displayer);
			$("#added_class").val(new_classc);
		}
	}
	
	//File Reader
	vpb_multiple_file_uploader.prototype.vpb_read_file = function(vpb_e) {
		if(vpb_e.target.files) {
			self.vpb_show_added_files(vpb_e.target.files);
			self.vpb_browsed_files.push(vpb_e.target.files);
		} else {
			alert('Sorry, a file you have specified could not be read.');
		}
	}
	
	function addEvent(type, el, fn){
	if (window.addEventListener){
		el.addEventListener(type, fn, false);
	} else if (window.attachEvent){
		var f = function(){
		  fn.call(el, window.event);
		};			
		el.attachEvent('on' + type, f)
	}
}
	
	//Get the ids of all added files and also start the upload when called
	vpb_multiple_file_uploader.prototype.vpb_starter = function() {
		if (window.File && window.FileReader && window.FileList && window.Blob) {		
			 var vpb_browsed_file_ids = $("#"+this.vpb_settings.vpb_form_id).find("input[type='file']").eq(0).attr("id");
			 document.getElementById(vpb_browsed_file_ids).addEventListener("change", this.vpb_read_file, false);
			 document.getElementById(this.vpb_settings.vpb_form_id).addEventListener("submit", this.vpb_submit_added_files, true);
		} 
		else { alert(vpb_msg); }
	}
	
	//Call the uploading function on the upload button
	vpb_multiple_file_uploader.prototype.vpb_submit_added_files = function(){ self.vpb_upload_bgin(); }
	
	//Start uploads
	vpb_multiple_file_uploader.prototype.vpb_upload_bgin = function() {
		if(this.vpb_browsed_files.length > 0) {
			for(var k=0; k<this.vpb_browsed_files.length; k++){
				var file = this.vpb_browsed_files[k];
				this.vasPLUS(file,0);
			}
		}
	}
	
	//Main file uploader
	vpb_multiple_file_uploader.prototype.vasPLUS = function(file,file_counter)
	{
		if(typeof file[file_counter] != undefined && file[file_counter] != '')
		{
			//Use the file names without their extensions as their ids
			var files_name_without_extensions = file[file_counter].name.substr(0, file[file_counter].name.lastIndexOf('.')) || file[file_counter].name;
			var ids = files_name_without_extensions.replace(/[^a-z0-9\s]/gi, '').replace(/[\s]/g, '_');
			var vpb_browsed_file_ids = $("#"+this.vpb_settings.vpb_form_id).find("input[type='file']").eq(0).attr("id");
			
			var removed_file = $("#"+ids).val();
			
			if ( removed_file != "" && removed_file != undefined && removed_file == ids )
			{
				self.vasPLUS(file,file_counter+1);
			}
			else
			{
				var dataString = new FormData();
				dataString.append('upload_file',file[file_counter]);
				dataString.append('upload_file_ids',ids);
					
				$.ajax({
					type:"POST",
					url:this.vpb_settings.vpb_server_url,
					data:dataString,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() 
					{
						$("#uploading_"+ids).html('<div align="left"><img src="images/progress.gif" width="60px" align="absmiddle"></div>');
						$("#remove"+ids).html('<div align="center" style="font-family:Verdana, Geneva, sans-serif;color:blue;">Uploading...</div>');
						//alert("here we are");
					},
					success:function(response) 
					{
						setTimeout(function() {
							var response_brought = response.indexOf(ids);
							if ( response_brought != -1) {
								$("#uploading_"+ids).html('<div align="left" style="font-family:Verdana, Geneva, sans-serif;color:green;">Completed</div>');
								$("#remove"+ids).html('<div align="center" style="font-family:Verdana, Geneva, sans-serif;color:green;">Uploaded</div>');
							} else {
								var fileType_response_brought = response.indexOf('file_type_error');
								if ( fileType_response_brought != -1) {
									
									var filenamewithoutextension = response.replace('file_type_error&', '').substr(0, response.replace('file_type_error&', '').lastIndexOf('.')) || response.replace('file_type_error&', '');
									var fileID = filenamewithoutextension.replace(/[^a-z0-9\s]/gi, '').replace(/[\s]/g, '');
									$("#uploading_"+fileID).html('<div align="left" style="font-family:Verdana, Geneva, sans-serif;color:red;">Invalid File</div>');
									$("#remove"+fileID).html('<div align="center" style="font-family:Verdana, Geneva, sans-serif;color:orange;">Cancelled</div>');
									
								} else {
									var filesize_response_brought = response.indexOf('file_size_error');
									if ( filesize_response_brought != -1) {
										var filenamewithoutextensions = response.replace('file_size_error&', '').substr(0, response.replace('file_size_error&', '').lastIndexOf('.')) || response.replace('file_size_error&', '');
										var fileID = filenamewithoutextensions.replace(/[^a-z0-9\s]/gi, '').replace(/[\s]/g, '');
										$("#uploading_"+fileID).html('<div align="left" style="font-family:Verdana, Geneva, sans-serif;color:red;">Exceeded Size</div>');
										$("#remove"+fileID).html('<div align="center" style="font-family:Verdana, Geneva, sans-serif;color:orange;">Cancelled</div>');
									} else {
										var general_response_brought = response.indexOf('general_system_error');
										if ( general_response_brought != -1) {
											alert('Sorry, the file was not uploaded...');
											$("#uploading_"+ids).html('<div align="left" style="font-family:Verdana, Geneva, sans-serif;color:red;">Failed...</div>');
											$("#remove"+ids).html('<div align="center" style="font-family:Verdana, Geneva, sans-serif;color:red;">Upload failed...</div>');
										}
										else { /* Do nothing */}
									}
								}
							}
							if (file_counter+1 < file.length ) {
								self.vasPLUS(file,file_counter+1); 
							} 
							else {}
						},2000);
					}
				});
			 }
		} 
		else { alert('Sorry, this system could not verify the identity of the file you were trying to upload.'); }
	}
	this.vpb_starter();
}

function vpb_remove_this_file(id, filename)
{
	if(confirm('If you are sure to remove the file: '+filename+' then click on OK otherwise, Cancel it.'))
	{
		$("#vpb_removed_files").append('<input type="hidden" id="'+id+'" value="'+id+'">');
		$("#add_fileID"+id).slideUp();
	}
	return false;
}