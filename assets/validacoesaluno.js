
const form = document.querySelector('form');
const ra = document.querySelector('#ra');
const nome = document.querySelector('#nome');
const senha = document.querySelector('#senha');
const confirmSenha = document.querySelector('#confirm_senha');
const curso = document.querySelector('#curso');
const texto = document.querySelector('#texto');


function validarFormulario() {
  let erro = false;
  const regexRa = /^\d{7}$/;
  const regexSenha = /.{6,}/;

  if (!regexRa.test(ra.value)) {
    texto.textContent = 'O RA deve ter 7 dígitos';
    erro = true;
  }

  if (nome.value.length < 3) {
    texto.textContent = 'O nome deve ter no mínimo 3 caracteres';
    erro = true;
  }

  if (!regexSenha.test(senha.value)) {
    texto.textContent = 'A senha deve ter pelo menos 6 caracteres';
    erro = true;
  }

  if (senha.value !== confirmSenha.value) {
    texto.textContent = 'As senhas não coincidem';
    erro = true;
  }

  return !erro;
}

form.addEventListener('submit', (event) => {
  if (!validarFormulario()) {
    event.preventDefault();
  }
});

// form.addEventListener('submit', (event) => {
//   if (!validarRa(ra.value)) {
//     texto.textContent = 'RA inválido. Deve conter exatamente 7 números.';
//     event.preventDefault();
//   } else if (nome.value.trim() === '') {
//     texto.textContent = 'O campo nome não pode estar vazio.';
//     event.preventDefault();
//   } else if (!validarSenha(senha.value)) {
//     texto.textContent = 'Senha inválida. Deve conter no mínimo 6 caracteres, 1 número e 1 caractere especial.';
//     event.preventDefault();
//   } else if (senha.value !== confirmSenha.value) {
//     texto.textContent = 'As senhas não coincidem.';
//     event.preventDefault();
//   } else if (curso.value === '') {
//     texto.textContent = 'Por favor, selecione um curso.';
//     event.preventDefault();
//   } else {
//     // todos os campos foram validados com sucesso, então você pode enviar o formulário
//   }
// });

// function validarRa(valor) {
//   const regex = /^\d{7}$/;
//   return regex.test(valor);
// }

// function validarSenha(valor) {
//   const regex = /^.{6}$/;
//   //const regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
//   return regex.test(valor);
// }







// senha.addEventListener("keyup", () => {
//   if (validatorSenha(senha.value) !== true) {
//     texto.textContent ="O formato da senha deve ser no min 6 caracteres, 1 numero e 1 caractere especial";
//   } else {
//     texto.textContent = "";

//   }
// });

// function validatorSenha(senha) {
//   let senhaPattern =
//     /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
//   return senhaPattern.test(senha);
// }


function stringAleatoria() {
  let a = 0;
  let b = 8;
  let strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  let randomString = Array.from({ length: b }, () => strings[Math.floor(Math.random() * strings.length)]).join('').substring(a);
  var campo = document.getElementById('codigoCoord');
  campo.value = randomString;
}

function validarNumeros(event) {
    const tecla = event.key;
    const permiteNumeros = (tecla >= '0' && tecla <= '9');
    if (!permiteNumeros) {
      event.preventDefault();
    }
  }