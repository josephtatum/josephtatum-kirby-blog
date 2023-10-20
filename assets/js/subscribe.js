$(document).ready(function () {
  $(document).ready(function () {
    $("html.hidden").fadeIn(850).removeClass("hidden");
  });
  $("form").submit(function (event) {
    event.preventDefault();
    var formData = {
      email: $("#email").val(),
    };
    $("#submit").html("Subscribing...");
    $("#submit").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: "/subscribe",
      data: formData,
      dataType: "json",
      encode: true,
    })
      .done(function (data) {
        console.log(data.message);
        $("form").css("display", "none");
        $("#message").text(data.message);
        $("#message").css("display", "block");
      })
      .fail(function (jqXHR) {
        console.log(jqXHR.responseJSON.message);
        $("form").css("display", "none");
        $("#message").text(jqXHR.responseJSON.message);
        $("#message").css("display", "block");
      });

    event.preventDefault();
  });
});
