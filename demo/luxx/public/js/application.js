'use strict';

// Config
var URL = 'http://xsuve.com/demo/luxx/'; // Change this to your URL.

$(function() {

	// Sidebar & Topbar
	var pathname = window.location.pathname;
	var sidebarLink = pathname.split('/')[3];
    var actionLink = pathname.split('/')[4];
  /*
    ... .split('/')[1] -> [1] -> ex. http://demo.com/luxx/
    ... .split('/')[2] -> [2] -> ex. http://demo.com/luxx/projects/
    ... .split('/')[3] -> [3] -> ex. http://demo.com/demo/luxx/projects/
  */
  var searchIcon = '';
  var x = document.createElement('span');
	$('#' + sidebarLink + 'Link').addClass('active');
	$('.topbar-title').text(sidebarLink.charAt(0).toUpperCase() + sidebarLink.slice(1));
	switch(sidebarLink) {
		case 'contacts':
      switch(actionLink) {
        case 'add':
          $('#searchBar').hide();
          $('.topbar-title').text('Add contact');
        break;
        case 'edit':
          $('#searchBar').hide();
          $('.topbar-title').text('Edit contact');
        break;
        case 'view':
          $('#searchBar').hide();
          $('.topbar-title').text('View contact');
        break;
      }
			$('.topbar-add-link').attr('href', URL + 'contacts/add');
      x.innerHTML = '&#xf14e;&nbsp;&nbsp;Search by contact name, e-mail or category';
      $('#searchBar').attr('placeholder', x.textContent);
		break;
		case 'projects':
      switch(actionLink) {
        case 'add':
          $('#searchBar').hide();
          $('.topbar-title').text('Add project');
        break;
        case 'edit':
          $('#searchBar').hide();
          $('.topbar-title').text('Edit project');
        break;
        case 'view':
          $('#searchBar').hide();
          $('.topbar-title').text('View project');
        break;
      }
			$('.topbar-add-link').attr('href', URL + 'projects/add');
      x.innerHTML = '&#xf14e;&nbsp;&nbsp;Search by project title or category';
      $('#searchBar').attr('placeholder', x.textContent);
		break;
		case 'invoices':
      switch(actionLink) {
        case 'add':
          $('#searchBar').hide();
          $('.topbar-title').text('Add invoice');
        break;
        case 'edit':
          $('#searchBar').hide();
          $('.topbar-title').text('Edit invoice');
        break;
        case 'view':
          $('#searchBar').hide();
          $('.topbar-title').text('View invoice');
        break;
      }
			$('.topbar-add-link').attr('href', URL + 'invoices/add');
      x.innerHTML = '&#xf14e;&nbsp;&nbsp;Search by invoice contact name, contact e-mail or category';
      $('#searchBar').attr('placeholder', x.textContent);
		break;
		case 'modules':
      switch(actionLink) {
        case 'view':
          var moduleName = pathname.split('/')[4];
          if($('#' + moduleName + 'Link').length) {
            $('#' + moduleName + 'Link').addClass('active');
            $('#modulesLink').removeClass('active');
          }
          $('.topbar-title').text(moduleName.charAt(0).toUpperCase() + moduleName.slice(1));
        break;
      }
			$('.topbar-add-link').attr('href', URL + 'modules/install');
      $('#searchBar').hide();
		break;
    case 'categories':
      $('#searchBar').hide();
    break;
    case 'account':
      $('#searchBar').hide();
    break;
	}

  // Projects
  $('#addProjectDeadlineDatepicker').datepicker({
      format: 'yyyy-mm-dd',
      zIndex: 9998
  });

  // Invoices
  $('#addInvoiceDueDateDatepicker').datepicker({
      format: 'yyyy-mm-dd',
      zIndex: 9998
  });

  // Search Bar
  $('#searchBar').on('keyup', function() {
    var query = $(this).val().toLowerCase();
    if (query != '') {
      $('.hide-on-search').css('display', 'none');
      var results = $('.box[data-search*="' + query + '"]');
      var data = results.data('search');
      if (results.length) {
        $('.box').parents('.box-col').hide();
        results.parents('.box-col').show();
      } else {
        $('.box').parents('.box-col').hide();
      }
    } else {
      $('.hide-on-search').css('display', 'block');
      $('.box').parents('.box-col').show();
    }
  });

  // Project Tasks
  $('.task-checkbox input').on('change', function() {
    var id = $(this).data('task-id');

    if(this.checked) {
      $.ajax({
        type: 'POST',
        url: URL + 'projects/completetask/' + id
      });

      $('.project-task-title[data-task-id="' + id + '"]').removeClass('c-text');
      $('.project-task-title[data-task-id="' + id + '"]').addClass('c-gray');
    } else {
      $.ajax({
        type: 'POST',
        url: URL + 'projects/activatetask/' + id
      });

      $('.project-task-title[data-task-id="' + id + '"]').removeClass('c-gray');
      $('.project-task-title[data-task-id="' + id + '"]').addClass('c-text');
    }
  });

  // Attachment Input
  $('.attachmentInput').on('change', function() {
    $('.attachmentInputFileName').text(this.value.split('\\').pop().split('/').pop());
    $('.attachment-upload-btn').css('visibility', 'visible');
  });

  // Notifications
  var notificationsToggled = false;
  $('#notificationsBtn').on('click', function() {
    if(notificationsToggled == false) {
      $('.notifications-dropdown').show();
      notificationsToggled = true;
    } else {
      $('.notifications-dropdown').hide();
      notificationsToggled = false;
    }
  });
  $(document).on('click', function() {
    $('.notifications-dropdown').hide();
    notificationsToggled = false;
  });
  $('#notificationsBtn, .notifications-dropdown').on('click', function(e) {
    e.stopPropagation();
  });

  $('.notification-element').on('click', function() {
    var id = $(this).data('notification-id');
    $.ajax({
      type: 'POST',
      url: URL + 'notifications/markviewednotification/' + id
    });
  });

});