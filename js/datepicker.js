$('#demo').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "showWeekNumbers": true,
    "startDate": "03/02/2019",
    "endDate": "08/07/2019",
    "minDate": "03/02/2019",
    "maxDate": "08/07/2019"
}, function(start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});