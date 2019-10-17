$(document).ready(function() {
	$("#alertalldel").on("show.bs.modal", function(e) {
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-action-footer #confirmdel').data('form', form);
	});

	$("#alertalldel").find(".modal-action-footer #confirmdel").on('click', function() {
		$(this).data('form').submit();
	});
	
	$(".alert-main").fadeTo(3000, 1).slideUp(1000, function(){
		$(".alert-main").alert('close');
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
	$("#filemanager").fancybox({
		'width' : 900,
		'height' : 500,
		'type' : 'iframe',
		'autoScale'	: false,
		'autoSize' : false
	});
	
	$("#filemanager-multi").fancybox({
		'width' : 900,
		'height' : 500,
		'type' : 'iframe',
		'autoScale'	: false,
		'autoSize' : false
	});
	
	$(".btn-loading-overlay").on("click", function(e) {
		$('#loading-overlay').appendTo('body').show();
	});
	
	$('#title').on('input', function() {
		var permalink;
		permalink = $.trim($(this).val());
		permalink = permalink.replace(/\s+/g,' ');
		$('#seotitle').val(permalink.toLowerCase());
		$('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
		$('#seotitle').val($.trim($('#seotitle').val()));
		$('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
	});

	$('#seotitle').on('input', function() {
		var permalink;
		permalink = $(this).val();
		permalink = permalink.replace(/\s+/g,' ');
		$('#seotitle').val(permalink.toLowerCase());
		$('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
		$('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
	});
	
	$('.form-group .select-style').select2({ minimumResultsForSearch: Infinity });
});

$(function() {
	var activeUrl = window.location.href;
	var activePage = activeUrl.split('/');
	
	$('.aside-body .nav-aside li a').each(function(){
		var currentPage = $(this).attr('href');
		var currentActivePage = currentPage.split('/');
		if (activePage[activePage.length-3] == currentActivePage[currentActivePage.length-3]) {
			if (currentActivePage[currentActivePage.length-2] == 'undefined') {
				$(this).parent().addClass('active').addClass('show');
			} else {
				if (activePage[activePage.length-2] + '-' + activePage[activePage.length-1] == currentActivePage[currentActivePage.length-2] + '-' + currentActivePage[currentActivePage.length-1]) {
					$(this).parent().addClass('active').addClass('show');
					$(this).parent().parent().parent().addClass('active').addClass('show');
				}
			}
		}
	});
});

var deleter = {
	linkSelector          : "a[data-delete]",
	modalTitle            : "Are you sure?",
	modalMessage          : "You will not be able to recover this entry.",
	modalConfirmButtonText: "Yes",
	laravelToken          : null,
	url                   : "/",

	init: function() {
		$(this.linkSelector).on('click', {self:this}, this.handleClick);
	},

	handleClick: function(event) {
		event.preventDefault();
		
		var self = event.data.self;
		var link = $(this);

		self.modalTitle             = link.data('title') || self.modalTitle;
		self.modalMessage           = link.data('message') || self.modalMessage;
		self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
		self.url                    = link.attr('href');
		self.laravelToken           = $("meta[name=csrf-token]").attr('content');

		self.confirmDelete();
	},

	confirmDelete: function() {
		var that = this;
		
		swal({
			title				: this.modalTitle,
			text				: this.modalMessage,
			type				: "warning",
			showCancelButton	: true,
			confirmButtonColor	: "#DD6B55",
			confirmButtonText	: this.modalConfirmButtonText,
			confirmButtonClass	: 'btn btn-danger',
			cancelButtonClass	: 'btn btn-secondary',
			buttonsStyling		: false,
			animation			: false,
			focusConfirm		: false,
		}).then(function(result) {
			if (result.value) {
				var form =
					$('<form>', {
						'method': 'POST',
						'action': that.url
					});

				var token =
					$('<input>', {
						'type': 'hidden',
						'name': '_token',
						'value': that.laravelToken
					});

				var hiddenInput =
					$('<input>', {
						'name': '_method',
						'type': 'hidden',
						'value': 'DELETE'
					});

				form.append(token, hiddenInput).appendTo('body').submit();
			}
		});
	}
};

deleter.init();
