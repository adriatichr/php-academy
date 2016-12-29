"use strict";

var calendar = {
	accommodationId: null,
	urlCalendar: null,
	monthPrevious: null,
	monthNext: null,
	monthChange: null,
	calendarDivId: null,

	init: function(options) {
		var self = this;
		self.accommodationId = options.accommodationId;
		self.urlCalendar = options.urlCalendar;

		self.monthPrevious = options.monthPrevious;
		self.monthNext = options.monthNext;
		self.monthChange = options.monthChange;
		self.calendarDivId = options.calendarDivId;

		$(document).on('click', self.monthChange, function(e) { // Promjena prikaza mjeseca
			e.preventDefault();
			e.stopPropagation();
			self.changeMonth(self, $(this).data('month'));
		});
	},
	changeMonth: function(self, date) {
		var ajaxUrl = self.urlCalendar.replace('__UNITID__', self.accommodationId);
		ajaxUrl = ajaxUrl.replace('__DATE_MONTH__', date.month);
		ajaxUrl = ajaxUrl.replace('__DATE_YEAR__', date.year);

		$.ajax({
			type: "GET",
			url: ajaxUrl,
			dataType: "html",
			success: function(data) {
				if (data !== '') {
					$(self.calendarDivId).html(data);
				}
			}
		});
	},
};
