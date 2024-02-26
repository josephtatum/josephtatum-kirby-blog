function recaptcha_callback() {
  const captchaResponse = grecaptcha.getResponse();

  if (!captchaResponse.length < 0) {
    throw new error("Captcha not checked. Get outta here, bot!");
  }

  const formData = {
    email: $("#emailInput").val(),
  };
  $("#submit").html("Subscribing...");
  $("#submit").prop("disabled", true);
  $.ajax({
    type: "POST",
    url: "/verify-recaptcha",
    data: {
      captchaResponse,
    },
    dataType: "json",
    encode: true,
  }).done(function (res) {
    const data = JSON.parse(res);
    $("#message").css("display", "block");
    if (data.success) {
      $.ajax({
        type: "POST",
        url: "/subscribe",
        data: formData,
        dataType: "json",
        encode: true,
      })
        .done(function (data) {
          $("form").css("display", "none");
          $("#emailInput").val("");
          $("#message").text(data.message);
          $("#message").css("display", "block");
        })
        .fail(function (jqXHR) {
          $("form").css("display", "none");
          $("#emailInput").val("");
          $("#message").text(jqXHR.responseJSON.message);
          $("#message").css("display", "block");
        });
    } else {
      $("form").css("display", "none");
      $("#emailInput").val("");
      $("#message").text("Something's wrong. Let Joseph know if you can.");
      $("#message").css("display", "block");
      throw new Error("Something's wrong. Let Joseph know if you can.");
    }
  });
}
