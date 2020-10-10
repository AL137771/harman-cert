$(function() {

	// Set the default dates
	var startDate	= Date.create().addDays(-6),	// 7 days ago
		endDate		= Date.create(); 				// today

	var range = $('#range');

	// Show the dates in the range input
	range.val(startDate.format('{MM}/{dd}/{yyyy}') + ' - ' + endDate.format('{MM}/{dd}/{yyyy}'));

	// Load chart
	ajaxLoadChart(startDate,endDate);
	
	range.daterangepicker({
		
		startDate: startDate,
		endDate: endDate,
		
		ranges: {
            'Today': ['today', 'today'],
            'Yesterday': ['yesterday', 'yesterday'],
            'Last 7 Days': [Date.create().addDays(-6), 'today'],
            'Last 30 Days': [Date.create().addDays(-29), 'today']
        }
	},function(start, end){
		
		ajaxLoadChart(start, end);
		
	});
	
	// The tooltip shown over the chart
	
	// Create a new xChart instance, passing the type
	// of chart a data set and the options object
	
	var chart = new xChart('line-dotted', data, '#chart' , opts);
	
	// Function for loading data via AJAX and showing it on the chart
	function ajaxLoadChart(startDate,endDate) {

		// If no data is passed (the chart was cleared)
		
		if(!startDate || !endDate){
			chart.setData({
				"xScale" : "linear",
				"yScale" : "linear",
				"main" : [{
					className : ".stats",
					data : []
				}]
			});
			
			return;
		}

		// Otherwise, issue an AJAX request

		$.getJSON('ajax.php', {
			
			start:	startDate.format('{yyyy}-{MM}-{dd}'),
			end:	endDate.format('{yyyy}-{MM}-{dd}')
			
		}, function(data) {
			
			var set = [];
			$.each(data, function() {
				set.push({
					x : parseInt(this.label, 10),
					y : parseInt(this.value, 10)
				});
			});
			
			chart.setData({
				"xScale" : 'linear',
				"yScale" : "linear",
				"main" : [{
					className : ".stats",
					data : set
				}]
			});

		});
	}
});
