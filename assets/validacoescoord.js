
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


  if (nome.value.length < 5) {
    texto.textContent = 'O nome deve ter no mínimo 5 caracteres';
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

  if(cdcod.value.length < 8 || cdcod.value.length > 17){
    texto.textContent = 'A senha para registrar novo coordenador não confere, quer dizer, leia o manual, tá explicado lá';
    erro = true;
  }

  return !erro;
}

form.addEventListener('submit', (event) => {
  if (!validarFormulario()) {
    event.preventDefault();
  }
});




