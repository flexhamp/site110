//Фото пользователя
$(function(){
	var btnUpload=$('#upload-avatar');
	var status=$('#status-foto-user');
	var preloader=$('#preloader-user');
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
			//Add uploaded file to list
			preloader.hide();
			if(response != null) {
				$('#user-foto-img').html('<img src="/auth/profile/tmp/' + response + '" alt=""  >');
				$('#upload-avatar').text('изменить');
				$('#apply-avatar').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=foto_user',
							success: function(data){
								if(data != null) {
									$('#user-foto-img').html('<img src="/auth/profile/tmp/' + response + '" alt=""  >');
									status.text(data);
									$('#apply-avatar').hide();
								}
								else {
									status.text('Картинка не добавленна!');
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
//Договор
$(function(){
	var btnUpload=$('#upload-dogovor');
	var status=$('#status-dogovor');
	var preloader=$('#preloader-dogovor');
	var doc = "";
	new AjaxUpload(btnUpload, {
		action: 'upload.php',
		name: 'uploadfile',
		onSubmit: function(file, ext){
			if (! (ext && /^(jpg|png|jpeg|gif|doc|docx|xls|xlsx|pdf|zip|rar)$/.test(ext))){
				// extension is not allowed
					status.text('Данный формат не поддерживается');
					return false;
			}
			status.text('');
			preloader.show();
			doc = ext;
		},
		onComplete: function(file, response){
			//On completion clear the status
			preloader.hide();
			//Add uploaded file to list
			if(response != null) {
				
				if(! (doc && /^(jpg|png|jpeg|gif)$/.test(doc))){
					$('#files-dogovor').html('<img src="/auth/profile/users/default-doc.png" alt="">');
				}
				else {
					$('#files-dogovor').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				}					
				
				$('#upload-dogovor').text('Изменить');
				$('#apply-dogovor').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=dogovor',
							success: function(data){
								if(data != null) {
									if(! (doc && /^(jpg|png|jpeg|gif)$/.test(doc))){
										$('#files-dogovor').html('<img src="/auth/profile/users/default-doc.png" alt="">');
									}
									else {
										$('#files-dogovor').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									}	
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
//Паспорт
$(function(){
	var btnUpload=$('#upload-pasport');
	var status=$('#status-pasport');
	var preloader=$('#preloader-pasport');
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
				$('#files-pasport').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-pasport').text('Изменить');
				$('#apply-pasport').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=pasport',
							success: function(data){
								if(data != null) {
									$('#files-pasport').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-pasport').hide();
								}
								else {
									$('#status-pasport').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-pasport').text('файл не загружен!');
			}
		}
	});
});
//Свидетельство
$(function(){
	var btnUpload=$('#upload-svidetelstvo');
	var status=$('#status-svidetelstvo');
	var preloader=$('#preloader-svidetelstvo');
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
				$('#files-svidetelstvo').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-svidetelstvo').text('Изменить');
				$('#apply-svidetelstvo').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=svidetelstvo',
							success: function(data){
								if(data != null) {
									$('#files-svidetelstvo').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-svidetelstvo').hide();
								}
								else {
									$('#status-svidetelstvo').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-svidetelstvo').text('файл не загружен!');
			}
		}
	});
});
//Свидетельство (обратная сторона)
$(function(){
	var btnUpload=$('#upload-svidetelstvo-b');
	var status=$('#status-svidetelstvo-b');
	var preloader=$('#preloader-svidetelstvo-b');
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
				$('#files-svidetelstvo-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-svidetelstvo-b').text('Изменить');
				$('#apply-svidetelstvo-b').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=svidetelstvo_b',
							success: function(data){
								if(data != null) {
									$('#files-svidetelstvo-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-svidetelstvo-b').hide();
								}
								else {
									$('#status-svidetelstvo-b').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-svidetelstvo-b').text('файл не загружен!');
			}
		}
	});
});
//Страховка
$(function(){
	var btnUpload=$('#upload-strahovka');
	var status=$('#status-strahovka');
	var preloader=$('#preloader-strahovka');
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
				$('#files-strahovka').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-strahovka').text('Изменить');
				$('#apply-strahovka').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=strahovka',
							success: function(data){
								if(data != null) {
									$('#files-strahovka').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-strahovka').hide();
								}
								else {
									$('#status-strahovka').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-strahovka').text('файл не загружен!');
			}
		}
	});
});
//Лицензия
$(function(){
	var btnUpload=$('#upload-licenzia');
	var status=$('#status-licenzia');
	var preloader=$('#preloader-licenzia');
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
				$('#files-licenzia').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-licenzia').text('Изменить');
				$('#apply-licenzia').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=licenzia',
							success: function(data){
								if(data != null) {
									$('#files-licenzia').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-licenzia').hide();
								}
								else {
									$('#status-licenzia').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-licenzia').text('файл не загружен!');
			}
		}
	});
});
//Права
$(function(){
	var btnUpload=$('#upload-prava');
	var status=$('#status-prava');
	var preloader=$('#preloader-prava');
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
				$('#files-prava').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-prava').text('Изменить');
				$('#apply-prava').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=prava',
							success: function(data){
								if(data != null) {
									$('#files-prava').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-prava').hide();
								}
								else {
									$('#status-prava').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-prava').text('файл не загружен!');
			}
		}
	});
});
//Права (Обратная сторона)
$(function(){
	var btnUpload=$('#upload-prava-b');
	var status=$('#status-prava-b');
	var preloader=$('#preloader-prava-b');
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
				$('#files-prava-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-prava-b').text('Изменить');
				$('#apply-prava-b').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=prava_b',
							success: function(data){
								if(data != null) {
									$('#files-prava-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-prava-b').hide();
								}
								else {
									$('#status-prava-b').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-prava-b').text('файл не загружен!');
			}
		}
	});
});
//Авто (сторона а)
$(function(){
	var btnUpload=$('#upload-avto-a');
	var status=$('#status-avto-a');
	var preloader=$('#preloader-avto-a');
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
				$('#files-avto-a').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-avto-a').text('Изменить');
				$('#apply-avto-a').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=avto_a',
							success: function(data){
								if(data != null) {
									$('#files-avto-a').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-avto-a').hide();
								}
								else {
									$('#status-avto-a').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-avto-a').text('файл не загружен!');
			}
		}
	});
});
//Авто (сторона б)
$(function(){
	var btnUpload=$('#upload-avto-b');
	var status=$('#status-avto-b');
	var preloader=$('#preloader-avto-b');
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
				$('#files-avto-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
				$('#upload-avto-b').text('Изменить');
				$('#apply-avto-b').show(function(){
					$(this).click(function(){
						$.ajax({
							type: "POST",
							url: "upload.php",
							data: 'filename='+response+'&action=avto_b',
							success: function(data){
								if(data != null) {
									$('#files-avto-b').html('<img src="/auth/profile/tmp/' + response + '" alt="">');
									status.text(data);
									$('#apply-avto-b').hide();
								}
								else {
									$('#status-avto-b').text('Картинка не добавленна!');
								}
							}
						})
					})
				})
			}
			else{
				$('#files-avto-b').text('файл не загружен!');
			}
		}
	});
});