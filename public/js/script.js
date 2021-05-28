$(document).ready(() => {
  request("list", "all");
  $("#card-input").on("blur", (e) => {
    var val = e.target.value.trim();
    if (val) request("add", val);
  });
});

function request(type, value, id = false) {
  jQuery.ajax({
    type: "POST",
    dataType: "json",
    data: {
      type: type,
      value: value,
      id: id,
    },
    url: window.location.href,
    success: function (response) {
      if (response.status == "success") {
        $("#card-input").val("");
        $("#active-count").html(
          `${response.total_active} item${
            response.total_active > 1 ? "s" : ""
          } left`
        );

        $(".list-group").html("");
        if (response.data && response.data.length) {
          var html = "";
          response.data.forEach((item) => {
            html = `<div onmouseout="toggleClass('${
              item.id
            }')" onmouseover="toggleClass('${
              item.id
            }')" class="row pb-3" style="border-bottom: 1px solid #ddd;">
                                    <div class="col-11">
                                        <input onClick="mark_as_completed(this, '${
                                          item.id
                                        }')" class="form-check-input me-1" type="checkbox" ${
              item.status == "completed" ? "checked" : ""
            }>
                                        ${
                                          item.status == "completed"
                                            ? "<s>"
                                            : ""
                                        }
                                        <span class="${
                                          item.status == "completed"
                                            ? "op-5"
                                            : ""
                                        }" id="item-block-${
              item.id
            }" onclick="showHide('item-input-${item.id}','item-block-${
              item.id
            }')">${item.name}</span>
                                        ${
                                          item.status == "completed"
                                            ? "</s>"
                                            : ""
                                        }
                                        <input id="item-input-${
                                          item.id
                                        }" onblur="update_task('${
              item.id
            }', value)" class="input-name dn" type="text" value="${item.name}">
                                    </div>
                                    <div id="remove-button-${
                                      item.id
                                    }" class="col-1 dh">
                                        <button onClick="request('delete', '${
                                          item.id
                                        }')" class="btn remove">x</button>
                                    </div>
                                </div>`;

            $(".list-group").append(html);
          });
          html = "";
        }

        $(".list-group").append(html);

        if (parseInt(response.total_completed)) $("#completed-count").show();
        else $("#completed-count").hide();

        if (
          parseInt(response.total_completed) +
            parseInt(response.total_active) ==
          0
        )
          $(".card-footer").addClass("dn");
        else $(".card-footer").removeClass("dn");
      }
    },
  });
}

function mark_as_completed(e, value) {
  if (e.checked) request("completed", value);
  else request("active", value);
}

function showHide(show_id, hide_id) {
  console.log("click");

  $(`#${show_id}`).removeClass("dn");
  $(`#${hide_id}`).addClass("dn");
}

function update_task(id, value) {
  if (value.trim() && id.trim()) {
    request("update", value.trim(), id.trim());
  }
}

function toggleClass(id) {
  $(`#remove-button-${id}`).toggleClass("dh");
}
