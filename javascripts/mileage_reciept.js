function uploadReceipt(){

	// Get the element will use to fire the function
	var checkbox = document.getElementById('reciept_input');
	// Use the File API to access the files information
	var file = checkbox.files[0];
	// Get the file type
	var type = file.type;
	// Image directory to store

	if(type != 'jpg' || 'png' || 'gif' || 'tiff'){
		alert('The file you are trying to upload must be a image file type!');
	} else {
		console.log('Success at this point!');
	}

}