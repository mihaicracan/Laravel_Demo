
var APP = {

	init: function() {
		this.cacheDOM();
		this.bindEvents();

		this.initSelectors();
		this.initDatepickers();
	},

	initSelectors: function() {
		this.$multiple_selectors.multiselect();
	},

	initDatepickers: function() {
		this.$datepickers.datepicker({
			format : 'yyyy-mm-dd'
		});
	},

	cacheDOM: function() {
		this.$datepickers = $(".datepicker");
		this.$alerts      = $(".alert");

		this.$multiple_selectors = $("select[multiple]");
		this.$rent_btns = $(".rent-btn");
		this.$delete_btns = $(".delete-btn");

		this.$modal_delete = $("#modal-delete");
		this.$modal_delete_confirm = this.$modal_delete.find("a.btn-danger");

		this.$modal_rent   = $("#modal-rent");
		this.$modal_rent_title = this.$modal_rent.find(".modal-title");
		this.$modal_rent_form  = this.$modal_rent.find("form");

		this.$input_email      = $("#email");
		this.$input_password   = $("#password");
		this.$demo_account_btn = $("#demo-account-btn");
	},

	bindEvents: function() {
		this.$rent_btns.click(function(e) {
			e.preventDefault();
			APP.onRentClick(this);
		});

		this.$delete_btns.click(function(e) {
			e.preventDefault();
			APP.onDeleteClick(this);
		});

		setTimeout(function() {
			APP.$alerts.slideUp();
		}, 3000);

		this.$demo_account_btn.click(function() {
			APP.loadDemoAccount();
		});
	},

	onRentClick: function(btn) {

		this.renderRentModal({
			id : $(btn).data('id'),
			title : $(btn).data('title')
		});
	},

	onDeleteClick: function(btn) {
		var href = $(btn).attr('href');

		this.renderDeleteModal(href);
	},

	loadDemoAccount: function() {
		this.$input_email.val("demo@account.com");
		this.$input_password.val("123456");
	},

	renderRentModal: function(options) {
		// Change moda title
		this.$modal_rent_title.html("Rent " + options.title);

		// Change modal form action
		var action = this.$modal_rent_form.attr('action');
		var parts  = action.split("rent/");

		this.$modal_rent_form.attr('action', parts[0] + "rent/" + options.id);

		this.$modal_rent.modal();
	},

	renderDeleteModal: function(href) {
		this.$modal_delete_confirm.attr('href', href);
		this.$modal_delete.modal();
	}
}

$(document).ready(function() {
	APP.init();
});