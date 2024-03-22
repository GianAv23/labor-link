const abc = document.querySelector("#live_search");

abc.addEventListener("keyup", function (e) {
  const ser = e.target.value.toLowerCase();
  const name = document.querySelectorAll("#name");
  let found = false;

  Array.from(name).forEach(function (nam) {
    const nama = nam.textContent;
    if (nama.toLowerCase().indexOf(ser) === -1) {
      nam.parentElement.parentElement.parentElement.parentElement.style.display =
        "none";
    } else {
      nam.parentElement.parentElement.parentElement.parentElement.style.display =
        "block";
      found = true;
    }
  });

  const resultNotFound = document.querySelector("#result_not_found");
  if (!found) {
    resultNotFound.style.display = "block";
  } else {
    resultNotFound.style.display = "none";
  }
});
