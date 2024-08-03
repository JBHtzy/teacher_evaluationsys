$(document).ready(function () {
  $("#eyetoggle").on("click", function () {
    let passInput = $("#opassword");
    if (passInput.attr("type") === "password") {
      passInput.attr("type", "text");
    } else {
      passInput.attr("type", "password");
    }
  });

  $("#password, #cpassword").on("keyup", function () {
    if ($("#password").val() == $("#cpassword").val()) {
      $("#password, #cpassword").css("border", "solid 1px green");
      $("#confmessage").html("Password match!").css("color", "green");
      $(".savebtn").removeAttr("disabled");
    } else {
      $("#password, #cpassword").css("border", "solid 1px red");
      $("#confmessage").html("Password does not match!").css("color", "red");
      $(".savebtn").attr("disabled", true);
    }
  });

  $("#username").on("input", function () {
    var username = $(this).val();
    if (username !== "") {
      $.ajax({
        url: "../process.php",
        type: "POST",
        data: {
          username: username,
        },
        success: function (response) {
          if (response === "taken") {
            $("#username-message").text("Username is already taken");
            $(".savebtn").attr("disabled", true);
          } else {
            $("#username-message").text("");
            $(".savebtn").removeAttr("disabled");
          }
        },
      });
    } else {
      $("#username-message").text("");
    }
  });
});

function previewImage(event) {
  var reader = new FileReader();
  reader.onload = function () {
    var output = document.getElementById("imagePreview");
    output.style.display = "block";
    output.innerHTML =
      '<img src="' +
      reader.result +
      '" style="width:200px; height:200px;border-radius: 10px; border: 1px solid; aspect-ratio: 3/2; object-fit: cover;">';
  };
  reader.readAsDataURL(event.target.files[0]);
}
