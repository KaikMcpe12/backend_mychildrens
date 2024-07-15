// FUNÇÃO DO CORAÇÃO DO GOSTEI
// function toggleLike(button) {
//   button.classList.toggle("clicked")
// }

// FUNÇÃO ABRIR/FECHAR MODAL DE NOVO REDDIT

const buttonModal = document
  .getElementById("criarReddit")
  .addEventListener("click", function () {
    console.log('teste')
    const modal = document.getElementById("modal")
    modal.classList.add("open")
  })

const buttonCloseModal = document
  .getElementById("cancelReddit")
  .addEventListener("click", function () {
    const modal = document.getElementById("modal")
    modal.classList.remove("open")
  })

function checkForSpace(event) {
  var input = event.target;
  if (event.key === ' ') {
      var tagContainer = document.getElementById('tagContainer');
      var hiddenInput = document.getElementById('hiddenInput');
      var newTag = document.createElement('span');
      newTag.className = 'tag';
      newTag.textContent = "#"+input.value.trim();
      tagContainer.appendChild(newTag);
      hiddenInput.value += input.value.trim() + ' ';
      input.value = '';
  }
}

document.getElementsByClassName('modal_form').addEventListener('submit', function (event) {
  document.getElementById('redditInput').value = '';
  document.getElementById('redditContent').value = '';
  document.getElementById('hiddenInput').value = '';
});