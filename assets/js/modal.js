$(document).ready(function () {
  $("#subscribeModalButton").attr("disabled", true);
  $("#emailInput").keyup(function () {
    if ($(this).val().length != 0) {
      const re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
      const emailFormat = re.test($(this).val());
      if (emailFormat) {
        $("#subscribeModalButton").attr("disabled", false);
      }
    } else {
      $("#subscribeModalButton").attr("disabled", true);
    }
  });

  $("#subscribeModalButton").click(function (event) {
    $("#emailAddress").text($("#emailInput").val());
    $("#subscribeModal").modal({
      fadeDuration: 250,
    });
    return false;
  });
});
