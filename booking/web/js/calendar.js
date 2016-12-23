/*globals $:false */
// jshint node: true
// jshint laxbreak: true
// jshint browser: true
"use strict";
var calendar = {
	accommodationId: null,
	urlCalendar: null,
	monthPrevious: null,
	monthNext: null,
	monthChange: null,
	calendarTableId: null,
	loaderCalendar: null,

	init: function(options) {
		var self = this;
		self.accommodationId = options.accommodationId;
		self.urlCalendar = options.urlCalendar;

		self.monthPrevious = options.monthPrevious;
		self.monthNext = options.monthNext;
		self.monthChange = options.monthChange;
		self.calendarTableId = options.calendarTableId;

		$(document).on('click', self.monthChange, function(e) { // Promjena prikaza mjeseca
			e.preventDefault();
			e.stopPropagation();
			self.changeMonth(self, $(this).data('month'));
		});
	},
	changeMonth: function(self, date) {
		var calendarTable = $(self.calendarTableId);
		var loaderCalendar = $(self.loaderCalendar);
		loaderCalendar.show();
		var ajaxUrl = self.urlCalendar.replace('__UNITID__', self.accommodationId);
		ajaxUrl = ajaxUrl.replace('__DATE_MONTH__', date.month);
		ajaxUrl = ajaxUrl.replace('__DATE_YEAR__', date.year);

		$.ajax({
			type: "GET",
			url: ajaxUrl,
			dataType: "html",
			success: function(data) {
				if (data !== '') {
					$(self.monthPricesId).html(data);
				}
				loaderCalendar.hide();
			}
		});
	},
};
