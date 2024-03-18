const abc = document.querySelector("#search");

abc.addEventListener("keyup", function (e) {
  const ser = e.target.value.toLowerCase();
  console.log(ser);
  const name = document.querySelectorAll("#name");
  Array.from(name).forEach(function (nam) {
    const nama = nam.textContent;
    if (nama.toLowerCase().indexOf(ser) === -1) {
      nam.parentElement.parentElement.parentElement.parentElement.style.display =
        "none";
    } else {
      nam.parentElement.parentElement.parentElement.parentElement.style.display =
        "block";
    }
  });
});
