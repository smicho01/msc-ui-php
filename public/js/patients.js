$(document).ready(function() {

	let ActivePatientId = null;
  	
  	get_all_patients();
	get_all_patient_flags();
	save_employees_to_session()
	
  	$('#btnLoadItems').on('click', function() {
  		//console.log('Load patients');
		$('#details').html("");
  		get_all_patients();
	});

	$('#mainSearch').on('input', function(e){
		let value = $(this).val();
		filter_patients(value);
	});

	$('#table_items_body').on('click', 'button.btn-view-patient' , function(e) {
		const patientId = $(this).attr("data-id");
		ActivePatientId = patientId
		$('#table_items_body tr').addClass("hidden");
		$(this).closest('tr').removeClass('hidden');
	
		display_patient_details(patientId);
		create_alert_box_class('To load all patients, press Reload Data button', 'info')
	});

	$('#table_items_body').on('dblclick', 'tr' , function(){
		$('#details').html(show_spinner());
		const patientId = $(this).attr("data-id");
		ActivePatientId = patientId
		$('#table_items_body tr').addClass("hidden");
		$(this).removeClass("hidden");
		display_patient_details(patientId);
	});

	$('#table_items_body').on('click', 'tr' , function(){
		$('#table_items_body tr').removeClass("selected");
		$(this).toggleClass('selected');
		const patientId = $(this).attr("data-id");
	});

	$('#btnEvictPatientCaches').on('click', function(e){
		console.log('Eviciting Patient caches form server');
		evict_patient_caches();
	});

	$('#details').on('click','#btn-patient-addflag', function(e){
		//console.log('asasf test');
	});


	$('#details').on('click', '#flagslist .flag', function(e){
		$(this).toggleClass('hasFlag');
	});


	// Toggle Delete Patient button disabled state
	$('#details').on('change', '#deleteButtonEnabler', function(event, state) {
		var status = $('#btn-delete-patient').prop('disabled');
		$('#btn-delete-patient').prop('disabled', !status);
	});
	
	// On Click Delete Patient button
	$('#details').on('click', '#btn-delete-patient', function(event, state) {
		// delete address
		delete_address($('#address-id').val())
		
		// delete flags for patient
		delete_patient_flags($('#patient-id').val())
		// delete patient visit data

		// delete patient
		delete_patient($('#patient-id').val())

		evict_patient_caches();
		get_all_patients();
		get_all_patient_flags();
		
	});

	$('#details').on('click', '#btn-delete-visit', function(event) {
		const visitId = $(this).attr("data-id");
		delete_visit(visitId)
	});

	$('#details').on('click', '#btn-visit-complete', function(event) {
		const visitId = $(this).attr("data-id");
		complete_visit(visitId)
		$(this).closest('td').html('Yes')
		$('.btn-delete-visit-'+visitId).attr('disabled', true)
		//$('.btn-visit-proceed-'+visitId).attr('disabled', true)
		
	});


	$('#details').on('click', '#btn-update-patient', function(e){
		let year = parseInt($('#patient-doby').val());
		let month = parseInt($('#patient-dobm').val());
		let day = parseInt($('#patient-dobd').val());
		
		let errors = false;
		
		if (!Number.isInteger(year) || year < 1920 || year > 2023) {
			alert('Year must be an integer between 1920 and 2022');
			errors = true;
		}

		if (!Number.isInteger(month) || month < 1 || month > 12) {
			alert('Month must be an integer between 1 and 12. Be serious, ok ?');
			errors = true;
		}

		if(month == 2 && day == 29) {
			alert('February can have 29 days but every 4 years. I am sure you are aware of it. ')
		} else if (month == 2 && day > 29) {
			alert('February, yeah ...' + day)
		}

		if (!Number.isInteger(day) || day < 1 || day > 31) {
			alert('Month must be an integer between 1 and 12. Be serious, ok ?');
			errors = true;
		}

		// Add 0 to day and month if any of them has value less than 10. 
		// Java will thron an error parsing date
		if(month < 10) {
			month = '0'+month
		}
		if(day < 10) {
			day = '0' + day
		}
		const patientDOB = year + '-' + month + '-' + day;
		

		const genderAsDigit = $('#patient-gender').val().toLowerCase() ==  'f' ? 1 : 0;
		//console.log('Wstawie gener: ' + genderAsDigit);
		const Patient = {
			id: $('#patient-id').val(),
			firstName: $('#patient-fname').val(),
			lastName: $('#patient-lname').val(),
			dob: patientDOB,
			gender: genderAsDigit,
			email: $('#patient-email').val(),
			phone: $('#patient-phone').val(),
			address: $('#address-id').val()
		}

		const patientJson = JSON.stringify(Patient);
		//console.log('Patient id = ' + patientJson);

		update_patient_data(Patient);
		
		// ***** Updating patient flags
		let patientFlagsToStore = []
		
		$('.hasFlag').each(function(index, element) {
			let idFlagi = $(element).attr('data-id');
			patientFlagsToStore.push(idFlagi)
		});

		update_patient_flags(Patient.id, patientFlagsToStore)


		// update Patient Address
		const AddressToUpdate = {
			id: $('#address-id').val(),
			address1: $('#address-address1').val(),
			address2: $('#address-address2').val(),
			city: $('#address-city').val(),
			postcode: $('#address-postcode').val()
			
		}

		update_address(AddressToUpdate);

		// ---------------- FINALIZING update ---------------
		create_alert_box_class_element("Patient updated", 'success', 'patientalerts')
		console.log('Patient updated')

	});


	let detailsOriginal = "";
	$('#details').on('click',"#btn-patient-visits", function(e){
		detailsOriginal = $('#details').html();
		const patientId = $('#patient-id').val()
		$('#details').html("");
		get_patient_visits(patientId)	
	});

	// Add VISIT button click
	$('#details').on('click',"#btn-add-visit-internal", function(e){
		//$('#details').append(get_add_visit_html());
		$(this).attr('disabled', true);
		const patientId = $('#patient-id').val();
		window.location.href = '?c=visits&v=add&patient='+patientId;
	});

	$('#details').on('click',"#btn-add-visit-internal-cancel", function(e){
		$('#details').html(detailsOriginal);
	});


	// Add Visit Details (Proceed button click)
	$('#details').on('click',"#btn-visit-proceed", function(e){
		const patientId = $(this).attr("data-patientid");
		const visitId = $(this).attr("data-visitId");
		console.log(visitId);
		window.location.href = '?c=visits&v=proceed&visit=' + visitId + '+&patient=' +patientId;
	});	
	

 
});


function delete_visit(visitId) {
	console.log('Deleting visit ' + visitId);
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: VISITS_SERVICE + '/visits/' + visitId,
		type: 'DELETE',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			//console.log('Visit deleted')
			create_alert_box_class('Visit deleted', 'success')
			$('#visittr-'+visitId).hide();
		},
		error: function(data) {
			//console.log('Problem deleting patient flags.')
			create_alert_box_class('Error when deleting visit', 'danger')
		}
	});
}

function complete_visit(visitId) {
	console.log('Completing visit ' + visitId);
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: VISITS_SERVICE + '/visits/complete/' + visitId,
		type: 'POST',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			//console.log('Visit deleted')
			create_alert_box_class('Visit completed', 'success')
		},
		error: function(data) {
			//console.log('Problem deleting patient flags.')
			create_alert_box_class('Error when completing visit', 'danger')
		}
	});
}


function get_add_visit_html() {
	return '<div>Add visit html here</div>';
}

function get_patient_visits(patientId) {
	// Get token from cookie
	$jwtToken = getCookie('accesstoken');
	  $.ajax({
		url: VISITS_SERVICE + '/visits/patient/' + patientId,
		type: 'GET',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		dataType: 'json',
		async: true,
		success: function (visits) {

			const visitsCount = visits.length
			console.log('Patient num visits : ' + visitsCount)
			let html = '<div class="row"><div class="col-12">'
					html += '<h1>Patient Visits</h1>'
				html += '</div></div>'
			if(visitsCount > 0) {

				html += '<div class="row"><div class="col-12">'
					html += '<table class="table">'
						html += '<thead>'
							html += '<tr>'
								html += '<th scope="col">Date</th>'
								html += '<th scope="col">Time</th>'
								html += '<th scope="col">Room</th>'
								html += '<th scope="col">Doctor</th>'
								html += '<th scope="col">Delete</th>'
								html += '<th scope="col">Completed</th>'
								html += '<th scope="col">Proceed</th>'
							html += '</tr>'
						html += '</thead>'
					html += '<tbody>'

					visits.forEach(visit => {
						//console.log(visit)
						html += '<tr class="visittr" id="visittr-' + visit.id + '" >'
							html += '<td>'+visit.visitDate+'</td>'
							html += '<td>'+visit.visitTime+'</td>'
							html += '<td>'+visit.room+'</td>'
							html += '<td>'+get_employee_by_id(visit.doctorId)+'</td>'
							if(!visit.completed){
								html += '<td><button id="btn-delete-visit" class="btn btn-danger btn-delete-visit-'+visit.id+' "  data-id="'+visit.id+'" >X</button></td>'
								html += '<td><button id="btn-visit-complete" class="btn btn-success" data-id="'+visit.id+'" >+</button></td>'
								html += '<td><button id="btn-visit-proceed" class="btn btn-success btn-visit-proceed btn-visit-proceed-'+visit.id+' " data-visitid="'+visit.id+'" data-patientid="'+patientId+'" >+</button></td>'
							} else {
								html += '<td><button disabled class="btn btn-danger"  data-id="'+visit.id+'" >X</button></td>'
								html += '<td>Yes</td>'
								//html += '<td><button disabled class="btn btn-success"  data-id="'+visit.id+'" >+</button></td>'
								html += '<td><button id="btn-visit-proceed" class="btn btn-success btn-visit-proceed btn-visit-proceed-'+visit.id+' " data-visitid="'+visit.id+'" data-patientid="'+patientId+'" >+</button></td>'

							}
						html += '</tr>'
					});

					html += '</tbody>'
				html += '</table>'

				
				html += '</div></div>'

				// // Populate table with Patients data
				// let patientRows = ""
				// patients.forEach(patient => {
				// 	patientRows += build_patient_row(patient);
				// });
				// $('#table_items_body').html(patientRows);
			} else {
				html += '<div>No visits for patient</div>';
				
			}
			html += '<input type="hidden" id="patient-id" value="'+patientId+'" />'
			html += '<button id="btn-add-visit-internal" class="btn btn-success mt-3" >Add Visit</button>'
			html += '<button id="btn-add-visit-internal-cancel" class="btn btn-danger mt-3" >Cancel</button>'
			$('#details').html(html);
		},
		error: function(data) {
			console.log('Error making request to get visits')
			//console.log(data)
			if(data.status == 403) {
				$('#view').html(create_alert_box('This content is blocked for your role !'));
			}
		}
	});
}


function get_visits_html(patientId) {


    let html = '<div class="row"><div class="col-12">'
		html += '<h1>Patient Visits</h1>'
	html += '<div class="row"><div class="col-12">'

	return html;
}


function delete_patient_flags(patientId) {
	console.log('Deleting patient flags ' + patientId);
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: PATIENT_SERVICE + '/flags/patient/'+patientId,
		type: 'DELETE',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			console.log('Patient Flags deleted')
		},
		error: function(data) {
			console.log('Problem deleting patient flags.')
		}
	});
}

function delete_address(addressId) {
	console.log('Deleting address ' + addressId);
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: PATIENT_SERVICE + '/address/'+addressId,
		type: 'DELETE',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			console.log('Address deleted')
		},
		error: function(data) {
			console.log('Problem deleting address.')
		}
	});
}

function delete_patient(patientId) {
	console.log('Deleting patient ' + patientId);
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: PATIENT_SERVICE + '/patients/'+patientId,
		type: 'DELETE',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			console.log('Patient deleted')
			create_alert_box_class('Patient deleted', 'success')
		},
		error: function(data) {
			console.log('Problem deleting patient.')
		}
	});
}

function update_address(AddressToUpdate) {
	$jwtToken = getCookie('accesstoken');
	$.ajax({
		url: PATIENT_SERVICE + '/address' ,
		type: 'PUT',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		contentType: 'application/json',
		data : JSON.stringify(AddressToUpdate),
		async: true,
		success: function (patient) {
			if(patient) {
				console.log('Address updated')
			}
		},
		error: function(data) {
			console.log("Problem updating address. ", data)
			create_alert_box_class('Problem updating address', 'danger')
		}
	});
}


function get_all_patients() {
	// Get token from cookie
	$jwtToken = getCookie('accesstoken');
	  $.ajax({
		url: PATIENT_SERVICE + '/patients',
		type: 'GET',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		dataType: 'json',
		async: true,
		success: function (patients) {
			const patientsCount = patients.length
			if(patientsCount > 0) {
				//console.log("Patients loaded from API")
				$('.patients-count-placeholder').text(patientsCount);

				// Populate table with Patients data
				let patientRows = ""
				patients.forEach(patient => {
					patientRows += build_patient_row(patient);
				});
				$('#table_items_body').html(patientRows);
				create_alert_box_class("Patient list loaded","success")
			}
		},
		error: function(data) {
			console.log('Error making request to get patients')
			//console.log(data)
			if(data.status == 403) {
				$('#view').html(create_alert_box('This content is blocked for your role !'));
			}
		}
	});
}

function get_all_patient_flags() {
	$jwtToken = getCookie('accesstoken');
	$.ajax({
	  url: PATIENT_SERVICE + '/flags' ,
	  type: 'GET',
	  headers: {
		  'Authorization': 'Bearer ' + $jwtToken
	  },
	  dataType: 'json',
	  async: true,
	  success: function (flags) {
		  // Save flags to PHP session
		  // Send patients list to store in PHP cache
		  $.post(
			"/php_js/flags.php",
			{
				urlcommand: 'saveAllFlagsToSession',
				flagsList: flags
			}
			).done(function(data){
				//console.log('Flags data sent to session', data);
					
			}).fail(function(data){
				console.log('Error setting FLAGS to session');
			});
	  },
	  error: function(data) {
		  console.log("Error getting patient flags: " ,data);
	  }
  });
}

function update_patient_flags(patientId, patientFlagsListToStore) {
	$jwtToken = getCookie('accesstoken');
	// delete all patient flags
	$.ajax({
		url: PATIENT_SERVICE + '/flags/patient/'+patientId,
		type: 'DELETE',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		async: true,
		success: function (data) {
			
		},
		error: function(data) {
			console.log('Problem deleting all patient flags.')
		}
	});

	// save new flags
	$.ajax({
		url: PATIENT_SERVICE + '/flags/patient/' + patientId + '/addmany' ,
		type: 'POST',
		headers: {
			'Authorization': 'Bearer ' + $jwtToken
		},
		contentType: 'application/json',
		data : JSON.stringify(patientFlagsListToStore),
		async: true,
		success: function (data) {
			//console.log("Success saving patient flags  : ", data)
		},
		error: function(data) {
			console.log("Error saving patient flags")
		}
	});
}

function filter_patients(value) {

	const SEARCH_TERM = {
		term: value
	}

	if(value.length == 0) {
		get_all_patients();
		
	} else {
		$jwtToken = getCookie('accesstoken');
	 	$.ajax({
				url: PATIENT_SERVICE + '/patients/search/'+value,
				type: 'POST',
				headers: {
					'Authorization': 'Bearer ' + $jwtToken
				},
				contentType: 'application/json',
				data : JSON.stringify(SEARCH_TERM),
				async: true,
				success: function (patients) {
					const patientsCount = patients.length
					$('.patients-count-placeholder').text(patientsCount);
					// Populate table with Patients data
					let patientRows = ""
					patients.forEach(patient => {
						patientRows += build_patient_row(patient);
					});
					$('#table_items_body').html(patientRows);
					create_alert_box_class("Search filter applied","success")
					
				},
				error: function(data) {
					console.log('Error making request to get patients')
					//console.log(data)
					if(data.status == 403) {
						$('#view').html(create_alert_box('This content is blocked for your role !'));
					}
					create_alert_box_class("Error when sending search request","danger")
				}
		});

		
	}

	
}





function build_patient_row(patient) {
	const gender =  patient.gender == 1 ? 'F' : 'M';
	return '<tr class="patient-row" data-id="' + patient.id+ '" >' +
		'<td>' + patient.firstName + ' ' + patient.lastName + '</td>' +	
		'<td>' + patient.dob + '</td>' +	
		'<td>' + gender  + '</td>' +	
		'<td><button class="btn btn-light btn-view-patient" data-id="' + patient.id+ '" >View</button></td>' +	
	'</tr>';
}

function display_patient_details(patientId) {

	$jwtToken = getCookie('accesstoken');
  		$.ajax({
            url: PATIENT_SERVICE + '/patients/' + patientId + "/dto" ,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + $jwtToken
            },
            dataType: 'json',
			async: true,
            success: function (patient) {
            	//console.log('Success making request to GET /patients/'+patientId+"/dto")
				if(patient) {
					//console.log(patient)
					$('#details').html(patient_details_html(patient));
				}
            },
            error: function(data) {
                //console.log('FAIL !!! making request to GET /patients/'+patientId+"/dto")
            	//console.log(data)
				if(data.status == 403) {
					$('#view').html(create_alert_box('This content is blocked for your role !'));
				}
            }
        });
	
}

function update_patient_data(patient) {
	$jwtToken = getCookie('accesstoken');
  		$.ajax({
            url: PATIENT_SERVICE + '/patients' ,
            type: 'PUT',
            headers: {
                'Authorization': 'Bearer ' + $jwtToken
            },
			contentType: 'application/json',
            data : JSON.stringify(patient),
			async: true,
            success: function (patient) {
				if(patient) {
					create_alert_box_class('Patient data updated', 'success')
				}
				evict_patient_caches();
            },
            error: function(data) {
            	//console.log(data)
				create_alert_box_class('Problem updating patient data', 'danger')
            }
        });
}

function patient_details_html(data) {

	const explodedDob = data.patient.dob.split("-");
	const patDobY = explodedDob[0];
	const patDobM = explodedDob[1];
	const patDobD = explodedDob[2];

	const address = data.address;

	$html = '<div>';
	
	$html += '<div class="row mt-2">';
		$html += '<div class="col-sm-12 col-md-6"><h1>Patient Details</h1><small>ID:'+data.patient.id+'</small></div>';
		$html +=  '<div class="col">' + display_patient_flags(data.flags) + '</div>'
	$html += '</div>';


	$html += '<div class="row mt-2">';
		$html += '<div class="col-md-6"><label class="labels">Name</label><input id="patient-fname" type="text" class="form-control" placeholder="first name" value="'+data.patient.firstName+'"></div>';
		$html += '<div class="col-md-6"><label class="labels">Surname</label><input id="patient-lname" type="text" class="form-control" value="'+data.patient.lastName+'" placeholder="surname"></div>';
	$html += '</div>';
	
	$html += '<div class="row">';
		$html += '<div class="col-md-12"><label class="labels">D.O.B</label></div>';
		$html += '<div class="col-12 col-md-2"><input id="patient-doby" type="text" class="form-control" placeholder="YYYY" value="'+patDobY+'"></div>';
		$html += '<div class="col-12 col-md-2"><input id="patient-dobm" type="text" class="form-control" placeholder="MM" value="'+patDobM+'"></div>';
		$html += '<div class="col-12 col-md-2"><input id="patient-dobd" type="text" class="form-control" placeholder="DD" value="'+patDobD+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">Gender</label></div>';
		$html += '<div class="col-12 col-md-2"><input id="patient-gender" type="text" class="form-control" placeholder="YYYY" value="'+data.patient.gender+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">e-mail</label><input id="patient-email" type="text" class="form-control" placeholder="email" value="'+data.patient.email+'"></div>';
	$html += '</div>';
	
	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">phone</label><input id="patient-phone" type="text" class="form-control" placeholder="email" value="'+data.patient.phone+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">Address Line 1</label><input id="address-address1" type="text" class="form-control" placeholder="enter address line 2" value="'+address.address1+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">Address Line 2</label><input id="address-address2" type="text" class="form-control" placeholder="enter address line 2" value="'+address.address2+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">Postcode</label><input id="address-postcode" type="text" class="form-control" placeholder="enter address line 2" value="'+address.postcode+'"></div>';
	$html += '</div>';
	
	$html += '<div class="row mt-3">';
		$html += '<div class="col-md-12"><label class="labels">City</label><input id="address-city" type="text" class="form-control" placeholder="enter address line 2" value="'+address.city+'"></div>';
	$html += '</div>';

	$html += '<div class="row mt-3">'
		$html += '<h3>Flags</h3>'
		$html += '<p class="small">Click flag to assign/remove it from patient</p>'
	$html += '</div>'

	$html += '<div class="row mt-3">'
		$html += '<div id="flagswrapper"></div>'
	flags_html(data)
	$html += '</div>'
	
	$html += '<div id="patientalerts"></div>'
	$html += '<div class="row mt-3 flex">';
		$html += '<button id="btn-update-patient" class="btn btn-success mt-3" >Update Patient</button>'
		$html += '<button id="btn-patient-visits" class="btn btn-success mt-3" >Patient Visits</button>'
	$html += '</div>';

	$html += '<div class="row mt-3 flex">';
		$html += '<div class="form-check">'
			$html += '<input class="form-check-input" type="checkbox" value="" id="deleteButtonEnabler">'
			$html += '<label class="form-check-label" for="invalidCheck">'
			$html += ' Confirm to remove patient'
			$html += '</label>'
		$html += '</div>'

		$html += '<button id="btn-delete-patient" disabled   class="btn btn-danger mt-3" >Delete Patient</button>'
	$html += '</div>';
	
	
	$html += '<input type="hidden" id="patient-id" value="' + data.patient.id +'" />';
	$html += '<input type="hidden" id="address-id" value="' + address.id +'" />';

	$html += '</div>';

	return $html;

	
}

function flags_html(data, element) {
	const patientFlags = data.flags
	const patient = data.patient

	$.get(
		"/php_js/flags.php",
		{
			urlcommand: 'getFlagsFromSession',
		}
		).done(function(data){
			const allFlags = JSON.parse(data)
			let html = '<div id="flagslist">'
			allFlags.forEach(flag => {

				// check if flag is assigned to patient and add correct class to it
				let hasFlagClass = ''
				patientFlags.forEach(patientFlag => {
					if(patientFlag.flagId == flag.id) {
						hasFlagClass = 'hasFlag'
					}
				})

				html += '<div class="flag '+hasFlagClass+' " data-id="'+flag.id+'" >'
					html += '<span class="flag-box" style="background-color:'+flag.colour+';" ></span>'
					html += '<span class="flag-name">'+ flag.name +'</span>'
				html += '</div>'
			})
			html += '</div>';

			$('#flagswrapper').html(html)
				
		}).fail(function(data){
				console.log('Fail setting FLAGS');
		});
}

function display_patient_flags(flags) {
	$html = "<div class='mt-3'>"
	
	if(flags.length == 0) {
		$html += 'No flags';
	} else {
		flags.forEach(flag => {
			$html += '<span class="flag-box" style="background-color:'+flag.flagColour+';" >'
			$html += '<span class="flag-name">'+ flag.flagName +'</span>'; 
			$html += '</span>';
		});
	}

	$html += '</div>';

	return $html;
}

function save_employees_to_session() {
	$jwtToken = getCookie('accesstoken');
  		$.ajax({
            url: ADMIN_SERVICE + '/users',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + $jwtToken
            },
            dataType: 'json',
			async: true,
            success: function (users) {
            	//console.log('Success making request to GET /userss/'+usersId+"/dto")
				if(users) {
					//console.log(users)
					sessionStorage.setItem("employees", JSON.stringify(users));
				}
            },
            error: function(data) {
                //console.log('FAIL !!! making request to GET /patients/'+patientId+"/dto")
            	//console.log(data)
				if(data.status == 403) {
					console.log('Users:This content is blocked for your role !');
				}
            }
    });

	let empl = JSON.parse(sessionStorage.getItem("employees"))
	return empl
}

function get_employee_by_id(employeeId) {
	let empl = JSON.parse(sessionStorage.getItem("employees"))
	let e = ''
	empl.forEach(employee => {
		if(employeeId == employee.userId) {
			e =  employee.firstName + " " + employee.lastName
		} 
	});
	return e
}