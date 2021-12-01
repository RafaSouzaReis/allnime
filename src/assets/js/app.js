function turnLeft(input) {
  let doc = document.getElementById(input);
  let scroll = doc.scrollLeft - 247 * 3;
  doc.scrollTo({
    top: 0,
    left: scroll,
    behavior: "smooth",
  });
}

function turnRight(input) {
  let doc = document.getElementById(input);
  let scroll = doc.scrollLeft + 247 * 3;
  doc.scrollTo({
    top: 0,
    left: scroll,
    behavior: "smooth",
  });
}

const debounce = (func, wait = 200) => {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      timeout = null;
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};

$(document).ready(function () {
  $("#search-bar-input").focus(function () {
    $("#search-bar-dropdown").addClass("show");
  });
  $("#search-bar-input").focusout(function () {
    setTimeout(function() {
      $("#search-bar-dropdown").removeClass("show");
    }, 50);
  });
  $("#search-bar-input").on(
    "input",
    debounce(function (e) {
      let value = e.target.value;
      if (value === "") {
        $("#search-bar-no-results").removeClass("d-none");
        $("#search-bar-no-results").addClass("d-block");
        $("#search-bar-results").html("");
        return;
      }
      $.ajax({
        type: "post",
        url: "./search",
        data: { search: value },
      })
        .done(function (e) {
          let response = JSON.parse(e);
          let html = "";
          response["results"].forEach((result) => {
            html =
              html +
              `<li><a class="dropdown-item search-bar-entry" href="./${
                result["type"] === 0 ? "anime" : "manga"
              }?id=${
                result["id"]
              }"><div class="cover"><img class="search-bar-entry" src="${
                result["picture"]
              }" loading="lazy"><div class="overlay">${
                result["type"] === 0 ? "Anime" : "Manga"
              }</div></div><div class="title"><span>${
                result["name"]
              }</span></div></a></li>`;
          });
          if (html === "") {
            $("#search-bar-no-results").removeClass("d-none");
            $("#search-bar-no-results").addClass("d-block");
            $("#search-bar-results").html("");
          } else {
            $("#search-bar-no-results").removeClass("d-block");
            $("#search-bar-no-results").addClass("d-none");
            $("#search-bar-results").html(html);
          }
        })
        .fail(function () {
          $("#search-bar-no-results").removeClass("d-none");
          $("#search-bar-no-results").addClass("d-block");
          $("#search-bar-results").html("");
        });
    })
  );
});
