const showConfirmDelete = (dataType, dataId) => {
	if (dataType !== '' && dataId !== '') {
		Swal.fire({
			title: 'Konfirmasi',
			text: 'Apakah Anda yakin akan menghapus data ini?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#dc3544',
			confirmButtonText: 'Ya, Hapus.',
			cancelButtonText: 'Batalkan',
		}).then((value) => {
			if (value.isConfirmed) {
				const actionURL = `${BASE_URL}${dataType}/delete/${dataId}`;

				const body = document.querySelector("body");

				//Form Delete
				const form = document.createElement("form");
				form.setAttribute("method", "POST");
				form.setAttribute("action", actionURL);

				//Input Method
				const inputMethod = document.createElement("input");
				inputMethod.setAttribute("type", "hidden");
				inputMethod.setAttribute("name", "_method");
				inputMethod.setAttribute("value", "DELETE");

				//Input Data Type
				const inputDataType = document.createElement("input");
				inputDataType.setAttribute("type", "hidden");
				inputDataType.setAttribute("name", "data_type");
				inputDataType.setAttribute("value", dataType);

				//Input Data ID
				const inputDataId = document.createElement("input");
				inputDataId.setAttribute("type", "hidden");
				inputDataId.setAttribute("name", "data_id");
				inputDataId.setAttribute("value", dataId);

				const br = document.createElement("br");

				form.appendChild(inputDataType);
				form.appendChild(br.cloneNode());
				form.appendChild(inputDataId);
				form.appendChild(br.cloneNode());
				form.appendChild(inputMethod);

				form.setAttribute('action', actionURL);

				body.appendChild(form);
				form.submit();
			}
		});
	}
}

const confirmLogout = () => {
	Swal.fire({
		title: 'Konfirmasi',
		text: 'Apakah Anda yakin akan keluar?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#dc3544',
		confirmButtonText: 'Ya, Keluar.',
		//cancelButtonColor: '',
		cancelButtonText: 'Batalkan',
	}).then((value) => {
		if (value.isConfirmed) {
			const body = document.querySelector("body");
			const actionURL = `${BASE_URL}/logout`;

			//Form logout
			const form = document.createElement("form");
			form.setAttribute("method", "POST");
			form.setAttribute("action", actionURL);

			const inputMethod = document.createElement("input");
			inputMethod.setAttribute("type", "hidden");
			inputMethod.setAttribute("name", "logout");
			inputMethod.setAttribute("value", "TRUE");

			form.appendChild(inputMethod);

			form.setAttribute('action', actionURL);

			body.appendChild(form);
			form.submit();
		}
	});
}

const loadSelect2 = () => {
	$('.select2').select2();
};


(function ($) {
	'use strict';
	$(function () {
		$('#data-table').DataTable({
			"aLengthMenu": [
				[5, 10, 15, -1],
				[5, 10, 15, "All"]
			],
			"iDisplayLength": 10,
			"language": {
				search: ""
			}
		});
		$('#data-table').each(function () {
			let datatable = $(this);
			// SEARCH - Add the placeholder for Search and Turn this into in-line form control
			let search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
			search_input.attr('placeholder', 'Search');
			search_input.removeClass('form-control-sm');
			// LENGTH - Inline-Form control
			let length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
			length_sel.removeClass('form-control-sm');
		});
	});
})(jQuery);

$('[data-toggle="tooltip"]').tooltip();

const getKelas = (elmt) => {
	if(elmt.value !== '') {
		const programStudiId = elmt.value;
		$.get(`${BASE_URL}kelas/getkelasbyprogramstudi/${programStudiId}`, (response) => {
			const result = JSON.parse(response);
			if(result.data.length > 0) {
				const listKelas = $("#list-kelas");
				$("#list-kelas > option").remove();
				$("#list-kelas").append(`<option selected disabled>-- Pilih Kelas --</option>`);
				$.each(result.data, (i, v) => {
					listKelas.append(`<option value='${v.id_kelas}'>${v.nama_kelas}/${v.semester}</option>`);
				});
			}
		});
	}
}

const changeKelas = (el) => {
	const programStudiContainer = $("select[name=id_program_studi]");
	if(programStudiContainer.val() === '' || programStudiContainer.val() === null) {
		Swal.fire({
			title: 'Warning',
			text: 'Silahkan pilih program studi terlebih dahulu!',
			icon: 'info',
		}).then(res => {
			$("select[name=id_program_studi]").select2();
			programStudiContainer.focus();
		})
	}
};

const setMultiClass = (val) => {
	$("#list-kelas").select2('destroy');
	if(val) {
		$("#is-multi-class").val(1);
		$("#list-kelas > option:nth-child(1)").remove();
		$("#list-kelas").attr('multiple', 'multiple');
		$("#list-kelas").attr('data-placeholder', '-- Pilih Kelas --');
		$("#list-kelas").select2({
			placeholder: '-- Pilih Kelas --',
			val: ''
		});
	} else {
		$("#is-multi-class").val(0);
		$("#list-kelas").prepend(`<option selected disabled>-- Pilih Kelas --</option>`);
		$("#list-kelas").removeAttr('multiple');
		$("#list-kelas").select2();
		$("#list-kelas").select2('val', '');
	}
}
