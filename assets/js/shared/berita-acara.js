const readURL = (input) => {
	if (input.files && input.files.length > 0) {
		const imgPreview = document.querySelector("#preview");
		// if(imgPreview.hasChildNodes()) {
		// 	document.querySelectorAll("#preview > div").forEach(el => el.remove());
		// }
		const inputLength = input.files.length;
		for (let i = 0; i < inputLength; i++) {
			let reader = new FileReader();
			let div = document.createElement("div");
			div.setAttribute("class", `col-4`);
			reader.onload = function (e) {
				div.innerHTML += `<img class='img img-fluid' src="${e.target.result}" />`;
			}
			reader.readAsDataURL(input.files[i]);
			imgPreview.appendChild(div);
		}
	}
}

if(document.getElementById("uraian_materi")) {
	$("#uraian_materi").summernote({
		height: 280,
		tabSize:1
	});
}

 const toggleOtherApp = (el) => {
	const customAppNameEl = document.getElementById('otherAppName');
	if(el.getAttribute('data-checked') === 'false') {
		el.setAttribute('data-checked', 'true');
		customAppNameEl.innerHTML = `<input type="text" name="jenis_aplikasi[]" placeholder="Masukkan nama aplikasi yang digunakan" class="form-control">`;
	} else {
		el.setAttribute('data-checked', 'false');
		customAppNameEl.innerHTML = '';
	}
 }
