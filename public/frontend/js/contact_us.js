$(document).ready(function () {
  /**
   * Contact us form submit
   */
  $(".contactForm").submit(function (event) {
    event.preventDefault();
    $(".print-error-msg").hide();
    $(".contactSubmit").prop("disabled", true);
    $(this).find(".spinner").addClass("spinner-border text-light w-4 h-4 mx-2");;
    let form = $(this);
    let url = form.attr("action");
    let form_data = new FormData(this);
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      type: "POST",
      url: url,
      data: form_data,
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data.status == true) {
          $(".contactForm")[0].reset();
          $("#image-preview").text(
            "Drag Images or browser to upload (Optional)"
          );
          $("#dates").removeClass("active");
          $(".contactSubmit").prop("disabled", false);
          $(".spinner").removeClass(
            "spinner-border text-light w-4 h-4 mx-2"
          );
          $(".contact-us-message").removeClass("d-none");
          $(".contact-us-message").addClass("text-success");
          $(".contact-us-message").text(data.message);
          setTimeout(() => {
              $(".contact-us-message").addClass("d-none");
          }, 1000);
        } else {
          $(".contact-us-message").removeClass("text-success");
          $(".contact-us-message").addClass("text-danger");
          $(".contact-us-message").text(data.message);
          $(".contactSubmit").prop("disabled", false);
          $(".spinner").removeClass(
            "spinner-border text-light w-4 h-4 mx-2"
          );
        }
      },
      error: function (data) {
        $.each(data.responseJSON.errors, function (key, value) {
          $(".print-error-msg-" + key + "").css("display", "block");
          $(".print-error-msg-" + key + "").html(value[0]);
        });
        $(".contactSubmit").prop("disabled", false);
        $(".spinner").removeClass(
          "spinner-border text-light w-4 h-4 mx-2"
        );
      },
    });
  });

  $("input:radio").change(function () {
    $(".btn-primary2").removeClass("active");
    if ($(this).is(":checked")) {
      $(this).parent().addClass("active");
    } else {
      $(this).parent().removeClass("active");
    }
  });

  /**
   * Image Upload on change
   */
  $("#image").change(function (e) {
    var filename = e.target.files[0].name;
    $("#image-preview").text(filename);
  });
});
