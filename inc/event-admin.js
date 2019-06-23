var EventAdmin = (function($) {
	
	var $c = {};
	
	function init() {
		$c.eventList = document.getElementById('event_list');
		$c.addNewEvent = document.getElementById('add_new_event');
		if ($c.addNewEvent && $c.eventList) {
			$c.addNewEvent.addEventListener('click', function(e) {
				e.preventDefault();
				addNew();
			});
			$c.addNewEvent.disabled = false;
		}
		
		$c.addNewEventDate = document.querySelectorAll('.add_new_event_date');
		if ($c.addNewEventDate) {
			for (var i = 0; i < $c.addNewEventDate.length; i++) {
				$c.addNewEventDate[i].addEventListener('click', function(e) {
					e.preventDefault();
					addNewEventDate(this);
				});
				$c.addNewEventDate[i].disabled = false;
			}
		}
		
		$c.eventDeletes = document.querySelectorAll('#event_list .event_header .delete');
		if ($c.eventDeletes) {
			for (var j = 0; j < $c.eventDeletes.length; j++) {
				$c.eventDeletes[j].addEventListener('click', function(e) {
					e.preventDefault();
					removeEvent(this);
				});
			}
		}
	}
	
	function addNew() {
		var i = $c.eventList.childElementCount;
		
		var frag = document.createDocumentFragment();
		var li = document.createElement('li');
		li.classList.add('event_item');
		frag.appendChild(li);
		
		// event header
		var eventHeader = document.createElement('div');
		eventHeader.classList.add('event_header');
		eventHeader.innerHTML = '<h4>Event ' + (i + 1) + '</h4>';
		li.appendChild(eventHeader);
		
		// delete button
		var eventDelete = document.createElement('a');
		eventDelete.href = '#';
		eventDelete.classList.add('delete');
		eventDelete.innerHTML = 'delete';
		eventDelete.addEventListener('click', function(e) {
			e.preventDefault();
			removeEvent(this);
		});
		eventHeader.appendChild(eventDelete);
		
		var dateTimeList = document.getElementById('event_dates_' + i);
		var j = dateTimeList.childElementCount;
		
		// event date button
		var eventNewDateWrap = document.createElement('div');
		eventNewDateWrap.classList.add('button_wrap');
		
		var eventNewDate = document.createElement('button');
		eventNewDate.classList.add('button');
		eventNewDate.classList.add('add_new_event_date');
		eventNewDate.innerHTML = 'Add Date/Time';
		eventNewDate.dataset.id = i.toString();
		eventNewDate.addEventListener('click', function(e) {
			e.preventDefault();
			addNewEventDate(this);
		});
		eventNewDateWrap.appendChild(eventNewDate);
		
		var eventContent = document.createElement('div');
		eventContent.classList.add('event_content');
		eventContent.innerHTML =
			
			'<div class="event_dates">' + // event dates
			'<h4>Event Dates</h4>' +
			'<ul id="event_dates_' + i + '" class="event_dates_list">' +  // date/time lists
			'<li class="event_date_item">' + // date/time list item
			
			'<div class="option_row option_cols">' +  // option cols
			
			'<div class="option_col">' +
			'<label>When</label>' +
			'<input type="date" name="events[event][' + i + '][dates][' + j + '][when_order]" value="" class="widefat" placeholder="When? format: dd/mm/yyyy">' +
			'</div>' +
			
			'<div class="option_col">' +
			'<label>Time</label>' +
			'<input type="text" name="events[event][' + i + '][dates][' + j + '][time]" value="" class="widefat" placeholder="time">' +
			'</div>' +
			
			'</div>' + // end option cols
			
			'</li>' +  // end date/time list item
			'</ul>' +  // end date/time lists
			
			'</div>' + // end event dates
			
			'<div class="option_row">' +
			'<label>Where</label>' +
			'<input type="text" name="events[event][' + i + '][where]" value="" class="widefat" placeholder="Where?">' +
			'</div>' +
			
			'<div class="option_row">' +
			'<label>Address</label>' +
			'<input type="text" name="events[event][' + i + '][address]" value="" class="widefat" placeholder="Address">' +
			'</div>' +
			
			'<div class="option_row">' +
			'<label>Tickets</label>' +
			'<input type="text" name="events[event][' + i + '][tickets]" value="" class="widefat" placeholder="Tickets">' +
			'</div>' +
			
			'<div class="option_row">' +
			'<label>Get tickets button text</label>' +
			'<input type="text" name="events[event][' + i + '][tickets_text]" value="" class="widefat" placeholder="Get Tickets">' +
			'</div>' +
			
			'<div class="option_row">' +
			'<label>Get tickets button link</label>' +
			'<input type="text" name="events[event][' + i + '][tickets_link]" value="" class="widefat" placeholder="Link to where the tickets are sold">' +
			'</div>';
		li.appendChild(eventContent);
		// eventNewDateWrap
		$c.eventList.appendChild(frag);
		
		if (dateTimeList)
			dateTimeList.appendChild(eventNewDateWrap);
	}
	
	function addNewEventDate(obj) {
		console.log('add new date');
		console.log(obj);
		var i = obj.dataset.id;
		var dateTimeList = document.getElementById('event_dates_' + i);
		
		var j = dateTimeList.childElementCount;
		var li = document.createElement('li');
		li.classList.add('event_date_item');
		li.innerHTML =
			'<div class="option_row option_cols">' +  // option cols
			'<div class="option_col">' +
			'<label>When</label>' +
			'<input type="date" name="events[event][' + i + '][dates][' + j + '][when_order]" value="" class="widefat" placeholder="When? format: dd/mm/yyyy">' +
			'</div>' +
			'<div class="option_col">' +
			'<label>Time</label>' +
			'<input type="text" name="events[event][' + i + '][dates][' + j + '][time]" value="" class="widefat" placeholder="time">' +
			'</div>' +
			'</div>'; // end option cols
		
		dateTimeList.appendChild(li);
	}
	
	function removeEvent(obj) {
		var event_item = obj.closest('li.event_item');
		if (event_item) {
			event_item.remove();
		}
	}
	
	return {
		init: init
	};
	
})(jQuery);

document.addEventListener('DOMContentLoaded', function(event) {
	EventAdmin.init();
});
