const signaturePreview = document.querySelector('#signature-preview');
const imgPreview = document.querySelector('#signature-preview img');
const inputFile = document.querySelector('input[name=signature]');

const showImagePreview = (input) => {
	signaturePreview.classList.remove('hidden');
	const imgSource = input.files[0];
	if(imgSource) {
		imgPreview.src = URL.createObjectURL(imgSource);
	}
}

const resetImage = () => {
	imgPreview.src = `${BASE_URL}assets/images/img-placeholder.png`;
	inputFile.value = '';
}
