
//Договор
$(function(){
	var btnUpload=$('#upload-dogovor');
	var status=$('#status-dogovor');
	var preloader=$('#preloader-dogovor');
	new AjaxUpload(btnUpload, {
		action: 'upload.php',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
				// extension is not allowed
					status.text('Поддерживаемые форматы JPG, PNG или GIF');
					return false;
			}
			status.text('');
			preloader.show();
		},
		onComplete: function(file, response){
			//On completion clear the status
			preloader.hide();
			//Add uploaded file to list
			if(response != null) {
				$('#files-dogovor').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-dogovor').text('Изменить');
				$('#apply-dogovor').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=dogovor',
							success: function(data){
								if(data != null) {
									$('#files-dogovor').html('<img src="/auth/profile/tmp/' + response + '" alt="">');									
									status.text(data);
									$('#apply-dogovor').hide();
								}
								else {
									$('#status-dogovor').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-dogovor').text('файл не загружен!');
			}
		}
	});
});
