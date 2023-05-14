
const form = document.querySelector('form');
const nome = document.querySelector('#nome');
const senha = document.querySelector('#senha');
const confirmSenha = document.querySelector('#confirm_senha');
const curso = document.querySelector('#curso');
const texto = document.querySelector('#texto');
const cdcod = document.querySelector('#cdcod');


function validarFormulario() {
  let erro = false;
  const regexSenha = /.{6,}/;


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

  if(cdcod.value != 'sanxJsjM9Yx3Y'){
    texto.textContent = 'A senha para registrar novo coordenador nao confere';
    erro = true;
  }

  return !erro;
}

form.addEventListener('submit', (event) => {
  if (!validarFormulario()) {
    event.preventDefault();
  }
});




