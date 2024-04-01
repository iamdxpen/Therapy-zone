$(document).ready(function () {

	/**
   * Apply now button 
   */
	$('body').on('click', '.apply-now', function () {
    $('.print-error-msg').hide();
    var technology = $(this).data('technology');
    $('#tech').val(technology.id)
    $('#apply_now_modal').modal('show');
    $("#applay-for-job")[0].reset();
	});

  /**
   * Hide error message out side modal
   */
  $("#apply_now_modal").on('hidden.bs.modal', function () {
    $('.print-error-msg').hide('');
  });

  /**
   * Resume upload on change add name
   */
  $('#resume').change(function(e) {
    var filename = e.target.files[0].name;
    $('#resume-preview').text(filename)
  });
});