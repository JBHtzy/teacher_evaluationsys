function retrieveid(id) {
  $.getJSON(`../process.php?getteachid=${id}`, function (data) {
    let datas = data.split("_");
    $("#teachid").val(datas[0]);
  });
}

function retrieve(id) {
  $.getJSON(`../process.php?getteach=${id}`, function (data) {
    let datas = data.split("_");
    $("#getteach").val(datas[0]);
    let subjects = datas[1].split(",");
    let optionsHtml = "";
    subjects.forEach(function (subject) {
      optionsHtml += `<option value="${subject}">${subject}</option>`;
    });
    $("#getsubs").html(optionsHtml);
    $("#teachuser").val(datas[2]);
    $("#opassword").val(datas[3]);
  });
}

$(document).ready(function () {
  new DataTable("#tableteacherInfo", {
    columnDefs: [
      {
        width: "50%",
        targets: 1,
      },
    ],
  });
  $(".btnviewer").click(function () {
    let img = $(this).attr("id");
    $(".getimg").attr("src", "../assets/imgs/" + img);
  });
});
