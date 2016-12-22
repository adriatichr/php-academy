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
			//
		});
	},
	changeMonth: function(self, date) {
	}
};
