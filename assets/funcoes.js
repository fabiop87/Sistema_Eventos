function stringAleatoria() {
    let a = 0;
    let b = 8;
    let strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let randomString = Array.from({ length: b }, () => strings[Math.floor(Math.random() * strings.length)]).join('').substring(a);
    var campo = document.getElementById('codigoCoord');
    campo.value = randomString;
  }
  
console.log('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

const inputField = document.querySelectorAll("codigoAluno");
const submitInput = document.querySelectorAll("codigo_submit");

inputField.addEventListener("input", function() {
  if (inputField.value.trim() == "") {
    console.log('aaaaaaabbbbbbbbbaaaaaa');
    submitInput.disabled = true;
  } else {
    submitInput.disabled = false;
  }
});
