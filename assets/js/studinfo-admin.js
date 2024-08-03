$(document).ready(function () {
  $("#tableteacherInfo").DataTable({
    ordering: false,
  });
});

function retrieve(id) {
  $.getJSON(`../process.php?getstudinfo=${id}`, function (data) {
    let datas = data.split("_");
    $("#showstud").html(datas[1]);
    $("#firstname").val(datas[0]);
    $("#lastname").val(datas[1]);
    $("#email").val(datas[2]);
    $("#age").val(datas[3]);
    $("#gender").val(datas[4]);
    $("#yearlevel").val(datas[5]);
    $("#course").val(datas[6]);
    $("#fetchid").val(datas[7]);
    $("#status").html(datas[8]);

    if (datas[8] == "enrolled") {
      $("#icon").css("color", "green");
      $("#isApprove").css("display", "none");
      $(".formstud").css("display", "block");
      $("#enrollpass").css("display", "none");
    } else {
      $("#icon").css("color", "grey");
      $("#isApprove").css("display", "block");
      $(".formstud").css("display", "none");
      $("#enrollpass").css("display", "block");
    }
    $("#opassword").val(datas[9]);
  });
}
