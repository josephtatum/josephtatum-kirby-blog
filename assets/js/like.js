$(document).ready(function () {
  $("#likeThisPost").click(function (event) {
    event.preventDefault();
    var uuid = $(this).data("uuid");

    $.ajax({
      type: "POST",
      url: `/like/${uuid}`,
    })
      .done(function (data) {
        console.log(data);
      })
      .fail(function (jqXHR) {
        console.log(jqXHR.responseJSON.message);
      });
  });
});
