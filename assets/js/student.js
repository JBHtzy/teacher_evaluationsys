function retrieve(id) {
  $.getJSON(`../process.php?teachcomms=${id}`, function (data) {
    let datas = data.split("_");
    $("#cardid").val(datas[0]);
    $("#teachname").text("Teacher: " + datas[1]);
  });
}

$(document).ready(function () {
  $(".subjectDropdown").click(function () {
    var subjectId = $(this).val();
    $("#selectedSubjectInput").val(subjectId);
    $("#selectedSubjectDisplay").text("Subject: " + subjectId);
  });

  const badWords = [
    "bwst",
    "bwiset",
    "buang",
    "maot",
    "idiot",
    "mamatay",
    "tala",
    "yw",
    "ywa",
    "yawa",
  ];

  $("#floatingTextarea2").on("input", function () {
    const inputText = $(this).val().toLowerCase();
    const hasBadWords = badWords.some((word) => inputText.includes(word));
    const submitButton = $("#submitBtn");

    if (hasBadWords) {
      Swal.fire({
        icon: "warning",
        title: "Oopss!",
        text: "No bad words allowed",
        showConfirmButton: false,
        timer: 2000,
      });
      submitButton.prop("disabled", hasBadWords);
    } else {
      submitButton.removeAttr("disabled");
    }
  });
});
