//Call at the time of upload
function upload(fileObj){
	var par = window.document;
	var frm = fileObj.form;
	var div_id = parseInt(Math.random() * 100000);

	// hide old iframe
	var iframes = par.getElementsByTagName('iframe');
	var iframe = iframes[iframes.length - 1];
	iframe.className = 'hidden';

	// create new iframe
	var new_iframe = par.createElement('iframe');
	new_iframe.src = 'pm-upload.php';
	new_iframe.frameBorder = '0';
	new_iframe.style.height = '75px';
	par.getElementById('iframe_container').appendChild(new_iframe);

	// add image progress
	var images = par.getElementById('images_container');
	var new_div = par.createElement('div');
	new_div.id = div_id;
	
	var new_img = par.createElement('img');
	new_img.src = 'images/indicator2.gif';
	new_img.style.marginLeft = '33px';
	new_img.style.marginTop = '50px';
	new_div.appendChild(new_img);
	images.appendChild(new_div);
	
	var errorDiv = par.getElementById('error');
	errorDiv.innerHTML = "";
	errorDiv.style.display = 'none';
	
	// send
	frm.div_id.value = div_id;
	setTimeout(frm.submit(),5000);
}

//Call when upload completed
function setUploadedImage(imgSrc, fileTempName, divId) {
	var par = window.document;
		
	var images = par.getElementById('images_container');

	var imgdiv = par.getElementById(divId);
	var image = imgdiv.getElementsByTagName('img')[0];
	imgdiv.removeChild(image);
	
	var image_new = par.createElement('img');
	image_new.src = imgSrc;
	image_new.className = 'pic';

	var image_label = par.createElement('input');
	image_label.type = "text";
	image_label.maxLength = "40";
	image_label.size = "12";
	image_label.value = "Label";
	image_label.name = "title[]";
	
	var image_hidden = par.createElement('input');
	image_hidden.type = "hidden";
	image_hidden.value = "1";
	image_hidden.name = "delFlag[]";
	
	var image_name = par.createElement('input');
	image_name.type = "hidden";
	image_name.value = fileTempName + ",new";
	image_name.name = "imageName[]";
	
	var image_del_link = par.createElement('a');
	image_del_link.href = "javascript:void(0)";
	image_del_link.appendChild(par.createTextNode("Delete"));
			
	var br = par.createElement('br');
	
	imgdiv.appendChild(image_new);
	imgdiv.appendChild(image_label);
	imgdiv.appendChild(image_hidden);
	imgdiv.appendChild(image_name);
	imgdiv.appendChild(br);
	imgdiv.appendChild(image_del_link);
	
	image_label.onfocus = function() {
		eval(labelOnFocus(image_label));
	}
	
	image_label.onblur = function() {
		eval(labelOnBlur(image_label));
	}
	
	image_del_link.onclick = function() {
		eval(deleteLinkOnClick(image_del_link, ''));
	}
}

// call when error occurred at the time of upload
function uploadError(divId, oName) {
	var par = window.document;
	var images = par.getElementById('images_container');
	var imgdiv = par.getElementById(divId);
	images.removeChild(imgdiv);
	var errorDiv = par.getElementById('error');
	errorDiv.innerHTML = oName + " has invalid file type.";
	errorDiv.style.display = '';
}

function labelOnFocus(image_label) {
	if (image_label.value == "Label") {
		image_label.value = "";
	}
}

function labelOnBlur(image_label) {
	if (image_label.value == "") {
		image_label.value = "Label";
	}
}

function deleteLinkOnClick(delLink, delFlag) {
	var par = window.document;
	var imgDiv = delLink.parentNode;
	var image_hidden = delFlag == '' ? imgDiv.childNodes[2] : par.getElementById(delFlag);

	if (image_hidden.value == '1') {
		
		image_hidden.value = '0';
		delLink.removeChild(delLink.childNodes[0]);
		delLink.appendChild(par.createTextNode("Restore"));
		delLink.style.color = '#FF0000';
	}
	else {
		image_hidden.value = '1';
		delLink.removeChild(delLink.childNodes[0]);
		delLink.appendChild(par.createTextNode("Delete"));
		delLink.style.color = '#64B004';
	}
}