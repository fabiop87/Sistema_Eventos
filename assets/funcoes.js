function stringAleatoria() {
    let a = 0;
    let b = 8;
    let strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let randomString = Array.from({ length: b }, () => strings[Math.floor(Math.random() * strings.length)]).join('').substring(a);
    var campo = document.getElementById('codigoCoord');
    campo.value = randomString;
  }
  
// const inputField = document.querySelectorAll("codigoAluno");
// const submitInput = document.querySelectorAll("codigo_submit");

// inputField.addEventListener("input", function() {
//   if (inputField.value.trim() == "") {
//     console.log('aaaaaaabbbbbbbbbaaaaaa');
//     submitInput.disabled = true;
//   } else {
//     submitInput.disabled = false;
//   }
// });


  const codigoAlunoInputs = document.querySelectorAll('.codigoAluno');
  codigoAlunoInputs.forEach(codigoAlunoInput => {
    const codigoSubmit = codigoAlunoInput.closest('td').querySelector('.codigo_submit');
     codigoSubmit.disabled = true;
    codigoAlunoInput.addEventListener('input', () => {
      if (codigoAlunoInput != '') {
        codigoSubmit.disabled = false;
      } else {
        codigoSubmit.disabled = true;
      }
    });
  });


  function pedirConfirmacao() {
    if (confirm("Tem certeza que deseja fazer isso ?")) {
      return true; // o formulário será enviado para o arquivo PHP
    } else {
      return false; // o formulário não será enviado
    }
  }
    
  