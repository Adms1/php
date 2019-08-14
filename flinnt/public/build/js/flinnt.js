$(document).ready(function() {
	init_parsley();
});	

/* PARSLEY */
			
function init_parsley() {
	
	if( typeof (parsley) === 'undefined'){ return; }
	console.log('init_parsley');
  
	$('parsley:field:validate', function() {
	  validateFront();
	});
	
	$('#category-form .submit').on('click', function() {
	  $('#category-form').parsley().validate();
	  validateFront();
	});
	
	var validateFront = function() {
	  if (true === $('#category-form').parsley().isValid()) {
		$('.bs-callout-info').removeClass('hidden');
		$('.bs-callout-warning').addClass('hidden');
	  } else {
		$('.bs-callout-info').addClass('hidden');
		$('.bs-callout-warning').removeClass('hidden');
	  }
	};

	$('#publisher-form .submit').on('click', function() {
	  $('#publisher-form').parsley().validate();
	  validateFront();
	});
	
	var validateFront = function() {
	  if (true === $('#publisher-form').parsley().isValid()) {
		$('.bs-callout-info').removeClass('hidden');
		$('.bs-callout-warning').addClass('hidden');
	  } else {
		$('.bs-callout-info').addClass('hidden');
		$('.bs-callout-warning').removeClass('hidden');
	  }
	};

	$('#author-form .submit').on('click', function() {
	  $('#author-form').parsley().validate();
	  validateFront();
	});
	
	var validateFront = function() {
	  if (true === $('#author-form').parsley().isValid()) {
		$('.bs-callout-info').removeClass('hidden');
		$('.bs-callout-warning').addClass('hidden');
	  } else {
		$('.bs-callout-info').addClass('hidden');
		$('.bs-callout-warning').removeClass('hidden');
	  }
	};



	try {
		hljs.initHighlightingOnLoad();
	} catch (err) {}
};