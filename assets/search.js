//👇️ to disable other search inputs when one is filled on homepage
let missionName = document.getElementById('mission-name');
let country = document.getElementById('idCountry');
let agent = document.getElementById('idAgent');
let target = document.getElementById('idTarget');

missionName.onkeyup = () => {
  if (missionName.value !== "") {
    country.setAttribute('disabled', true);
    agent.setAttribute('disabled', true);
    target.setAttribute('disabled', true);
  } else if (missionName.value === "") {
    country.removeAttribute('disabled', '');
    agent.removeAttribute('disabled', '');
    target.removeAttribute('disabled', '');
  }
}

country.onchange = () => {
  if (country.value !== "") {
    missionName.setAttribute('disabled', true);
    agent.setAttribute('disabled', true);
    target.setAttribute('disabled', true);
  } else if (country.value === "") {
    missionName.removeAttribute('disabled', '');
    agent.removeAttribute('disabled', '');
    target.removeAttribute('disabled', '');
  }
}

agent.onchange = () => {
  if (agent.value !== "") {
    missionName.setAttribute('disabled', true);
    country.setAttribute('disabled', true);
    target.setAttribute('disabled', true);
  } else if (agent.value === "") {
    missionName.removeAttribute('disabled', '');
    country.removeAttribute('disabled', '');
    target.removeAttribute('disabled', '');
  }
}

target.onchange = () => {
  if (target.value !== "") {
    missionName.setAttribute('disabled', true);
    country.setAttribute('disabled', true);
    agent.setAttribute('disabled', true);
  } else if (target.value === "") {
    missionName.removeAttribute('disabled', '');
    country.removeAttribute('disabled', '');
    agent.removeAttribute('disabled', '');
  }
}


