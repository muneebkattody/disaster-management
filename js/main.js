function getLocation() {
  var loc = "";
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    console.log(loc);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}
function showPosition(position) {
  loc = position.coords.latitude;
  loc = loc + "," + position.coords.longitude;
}

// ADD MEDICINE BOX

// TO SET INPUT LABEL AND NAME
var mIndex = 0;

$(document).ready(function() {
  $("#addMedicine").click(function() {
    jQuery("<div/>", {
      id: "medBox" + mIndex
    }).appendTo("#med-box");

    jQuery("<span/>", {
      class: "deleteicon w3-badge w3-round-xxlarge w3-red",
      onclick: 'removeElement("medBox' + mIndex + '")'
    })
      .text("remove")
      .appendTo("#medBox" + mIndex);

    jQuery("<input/>", {
      type: "text",
      class: "w3-input w3-border w3-round-xxlarge",
      name: "med" + mIndex,
      placeholder: " Medicine " + Number(mIndex + 1)
    })
      .appendTo("#medBox" + mIndex)
      .focus();

    jQuery("<input/>", {
      type: "text",
      class: "w3-input w3-border w3-round-xxlarge",
      name: "medDosage" + mIndex,
      placeholder: " Dosage of medicine " + Number(mIndex + 1)
    }).appendTo("#medBox" + mIndex);
    mIndex++;
  });
});

function removeElement(ele) {
  ele = "#" + ele;

  // YOU CAN ALSO USE slideUp
  $(ele).hide("slow", () => {
    $(ele).remove();
  });
  mIndex--;
}

/////////////////////////////////////////

// this is the id of the form
$(document).ready(() => {
  $("#ajaxForm").submit(function(e) {
    showToast("Uploading...");

    e.preventDefault();

    var form = $(this);
    var url = form.attr("action");

    $.ajax({
      type: "POST",
      url: url,
      data: form.serialize(),
      success: function(data) {
        showToast(data);
      }
    });

    $("#ajaxForm").trigger("reset");
  });
});

function showToast(val) {
  if($("#snackbar").length) {
    $("#snackbar").text(val);
    //alert(val);
  } else {
    jQuery("<div/>", {
      id: "snackbar"
    })
      .text(val)
      .appendTo("body");

    //alert(val);

    $("#snackbar").attr("class", "show");

    setTimeout(() => {
      $("#snackbar").removeClass("show");
        $("#snackbar").remove();
    }, 3000);
  }
}
