const correo = document.querySelector("#correo");
const form = document.getElementById("login100-form");
const form_container = document.getElementById("form_container");
const estudiante_info = document.getElementById("estudianteInfo");

const validation = (string) => {
  if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(string.value)) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Porfavor ingrese un email valido",
      footer:
        '<a href="https://www.verifyemailaddress.org/es/">¿Porque tengo este problema?</a>',
    });
    return false;
  }
};

const getResponse = async (email) => {
  const url =
    `https://soyuteista.uts.edu.co/carnet/getData.php?wdywfm=&email=${email}`;
  const response = await fetch(url);
  return response.json();
};

window.addEventListener("DOMContentLoaded", (f) => {
  form.addEventListener("submit", (e) => {
    //e.preventDefault();
    if (validation(correo) === false) return;
    getResponse(correo.value).then((data) => {
      console.log(data);
    });
  });
});
