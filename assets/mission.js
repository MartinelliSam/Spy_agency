//👇️ to check if beginning date is prior to ending date on mission creation/edition
let beginsAt = document.querySelector("input[name='beginsAt']");
let endsAt = document.querySelector("input[name='endsAt']");
let submit = document.querySelector("button.submit");
let warning = document.querySelector("p.text-danger");

endsAt.addEventListener('change', () => {
  if(beginsAt.value > endsAt.value) {
    submit.setAttribute('disabled', 'disabled');
    warning.innerHTML = 
    'La date de fin ne peut pas être inférieure à la date de début. Vous ne pourrez pas valider sans modifier';
  } else {
    submit.removeAttribute('disabled', '');
    warning.innerHTML = "";
  }
})


//👇️ to check if at least one agent, one contact and one target are selected on mission creation/edition
function checkedAgent(cb) {
  let agents = document.querySelectorAll('input.idAgent');
  if (cb.checked == 1) {
    for(let i = 0; agents.length; i++) {
      agents[i].removeAttribute('required', '');
    }
  } else if(cb.checked == 0) {
    for(let i = 0; agents.length; i++) {
      agents[i].setAttribute('required', 'required');
    }
  }
}

function checkedContact(cb) {
  let contacts = document.querySelectorAll('input.idContact');
  if (cb.checked == 1) {
    for(let i = 0; contacts.length; i++) {
      contacts[i].removeAttribute('required', '');
    }
  } else if(cb.checked == 0) {
    for(let i = 0; contacts.length; i++) {
      contacts[i].setAttribute('required', 'required');
    }
  }
}

function checkedTarget(cb) {
  let targets = document.querySelectorAll('input.idTarget');
  if (cb.checked == 1) {
    for(let i = 0; targets.length; i++) {
      targets[i].removeAttribute('required', '');
    }
  } else if(cb.checked == 0) {
    for(let i = 0; targets.length; i++) {
      targets[i].setAttribute('required', 'required');
    }
  }
}
