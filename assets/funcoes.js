function stringAleatoria() {
    let a = 0;
    let b = 8;
    let strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let randomString = Array.from({ length: b }, () => strings[Math.floor(Math.random() * strings.length)]).join('').substring(a);
    var campo = document.getElementById('codigoCoord');
    campo.value = randomString;
  }
  
console.log(`Nas patas traseiras
sentada no chão,
não é cachorrinho.
Que será então?

Sossegada e mansa,
seguindo meus passos,
não é cachorrinho.
Que será que eu faço?

Roeu minha abóbora,
o milho e o arroz.
Se rói tudo, tudo,
que faço depois?

Se quero pegá-la,
assobia assim…
chamando a família,
e foge de mim!

Mergulha no rio
e pula e rebola,
e come a plantinha
que n’água se enrola.

De pêlo tão duro,
tal qual um porquinho,
em volta da casa,
sem ser cachorrinho!

Não posso puxá-la,
pois rabo não tem.
Mas chamo baixinho.
Será que ela vem?

Se eu ando, ela anda.
Se eu paro, ela pára.
Quem sabe seu nome?
Será capivara?`);

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
    
  