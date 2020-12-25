(function ($) {
	'use strict';
	$(function () {
		$('#order-listing').DataTable({
			"aLengthMenu": [
				[5, 10, 15, -1],
				[5, 10, 15, "All"]
			],
			"iDisplayLength": 5,
			"bLengthChange": false,
			"language": {
				search: "Sort By :"
			}
		});
		$('#order-listing').each(function () {
			let datatable = $(this);
			// SEARCH - Add the placeholder for Search and Turn this into in-line form control
			let search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
			search_input.attr('placeholder', 'Pencarian');
			// search_input.removeClass('form-control-sm');
			let s = datatable.closest('.dataTables_wrapper').find(".dataTables_filter").append(`<a href="${BASE_URL}${URI_1}/create" class="btn btn-primary ml-2">Tambah Data</a>`);
		});
	});
})(jQuery);
