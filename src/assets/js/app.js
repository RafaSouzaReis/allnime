function turnLeft(input) {
  let doc = document.getElementById(input);
  let scroll = doc.scrollLeft - 247 * 3
  doc.scrollTo({
    top: 0,
    left: scroll,
    behavior: "smooth",
  });
}

function turnRight(input) {
  let doc = document.getElementById(input);
  let scroll = doc.scrollLeft + 247 * 3
  doc.scrollTo({
    top: 0,
    left: scroll,
    behavior: "smooth",
  });
}
