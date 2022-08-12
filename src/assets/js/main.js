const Auth = {};
$(function() {
	hidePreload();
	$('.sumo_select').SumoSelect();
	$('.btn_action__delete').on('click', function() {
		const _id = $(this).data('id');
		return confirmAlert('Apakah anda yakin ingin menghapus data ini?', () => {
			const form = $('.delete_form');
			form.attr('action', form.attr('action').replace(':id', _id));
			form.submit();
		});
	});
	$('form').on('submit', function() {
		showPreload();
	});

	$('table #checkall').click(function() {
		var is_checked = $(this).is(':checked');
		$('table .checkboxTable').prop('checked', !is_checked).trigger('click');
	});

	if (document.querySelector('.richtextEditor')) {
		CKEDITOR.replace(document.querySelector('.richtextEditor'), {
			height: '300px',
			removeDialogTabs: 'link:upload;image:upload',
			extraPlugins: 'font'
		});
	}
});
function confirmAlert(message, callback) {
	swal({
		text: message,
		icon: `${BASE_URL}/vendor/starterkit/img/confirm.png`,
		buttons: {
			cancel: {
				text: 'Tidak',
				visible: true,
				className: 'btn btn-cancel-alert'
			},
			confirm: {
				text: 'Ya',
				className: 'btn btn-confirm-alert'
			}
		}
	}).then((confirm) => {
		if (confirm) {
			return callback();
		}
	});
}

function bulkDeleteSelected() {
	let checked = $('table .checkboxTable').is(':checked');
	if(checked){
		return confirmAlert('Apakah anda yakin ingin menghapus data terpilih?', () => {
			$('#form_bulk_action').submit();
		});
	}else{
		swal({
			text: "Mohon pilih data yang ingin dihapus",
			icon: `${BASE_URL}/vendor/starterkit/img/confirm.png`,
			buttons: {
				cancel: {
					text: 'Oke',
					visible: true,
					className: 'btn btn-confirm-alert'
				},
			}
		})
	}
}

function showPreload() {
	$('.loading-screen').show();
}
function hidePreload() {
	$('.loading-screen').hide();	
}

function number_format(angka) {
	if(angka){
		angka = angka.toString();
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return rupiah;
	}else{
		return ''
	}
}