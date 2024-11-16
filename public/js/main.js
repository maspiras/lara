$(document).ready(function() {	
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
		options.async = true;
	}); 
}); 
var AjaxLib = {
	getAjax: function( dataURL ) {
		return jQuery.ajax({
			cache: false,
			url: dataURL
		});	
	},
	getAjaxDataJson: function( dataURL, query ) {
		return jQuery.ajax({
			data: query,
			dataType: 'json',
			url: dataURL
		});	
	},
	delAjaxData: function( dataURL ) {
		return jQuery.ajax({
			dataType: "json",
			url: dataURL,					
			cache: false
		});
	},	
	postAjaxData: function( dataURL, formData) {		
		return jQuery.post(dataURL, formData, function (data) {
		}, 'json'); 
	},
	
	postAjaxUpload: function( dataURL, formData){
	return jQuery.post( {
			url:  dataURL,
			data: formData,
			processData: false,
			contentType: false,
			dataType: 'json'
		});
	},
	test:function(){
		return 'testing to';
	}
};

var CommonLib = {
	MoneyFormat: function(amount, decimal=2){
		return amount.toFixed(decimal).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	},

	deBounce: function(id, data, display){
		var debounceTimeout = null;
		id.on('change keyup', function(event){
		    clearTimeout(debounceTimeout);
		    debounceTimeout = setTimeout(data, 5000);
		});
	}
};

// Set the options that I want
/* toastr.options = {	
	"positionClass": "toast-top-center",
	timeOut : 1000
  };
 */