


/** COOKIES **/
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function create_alert_box (alertText) {
  return '<div class="alert alert-danger" role="alert">' + alertText + '</div>';
}

function create_alert_box_class (alertText, className) {
  $('#alerts').html('<div id="alert-floating" class="alert alert-'+className+'" role="alert">' + alertText + '</div>')
  setTimeout( function(){
    $('#alerts').html('');
  } , 1500);
}

function create_alert_box_class_element (alertText, className, elementId) {
  $('#'+elementId).html('<div id="alert-floating" class="alert alert-'+className+'" role="alert">' + alertText + '</div>')
  setTimeout( function(){
    $('#'+elementId).html('');
  } , 1500);
}

function show_spinner() {
  return '<div class="spinner-border" role="status">' +
         '<span class="visually-hidden">Loading...</span>' +
        '</div>'
}

/** jQUERY **/
$(document).ready(function() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

});