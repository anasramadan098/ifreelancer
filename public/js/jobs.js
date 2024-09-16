const jobsData = JSON.parse(document.querySelector('p.data').innerHTML);
const paramsSearch = new URLSearchParams(window.location.search);

let filteredJobs = jobsData; // Start with all jobs

// 1. Filter by Price (if applicable)
if (paramsSearch.has('priceMin') && paramsSearch.has('priceMax')) {
  filteredJobs = filteredJobs.filter(job => {
    const priceMin = parseInt(paramsSearch.get('priceMin'));
    const priceMax = parseInt(paramsSearch.get('priceMax'));
    return job.price_min >= priceMin && job.price_max <= priceMax;
  });
}

// 2. Filter by Other Conditions (one at a time)
if (paramsSearch.has('categories[]')) {
  filteredJobs = filteredJobs.filter(job => {
    return paramsSearch.getAll('categories[]').includes(job.categories);
  });
}

if (paramsSearch.has('englishLevel[]')) {
  filteredJobs = filteredJobs.filter(job => {
    return paramsSearch.getAll('englishLevel[]').includes(job.english_level);
  });
}

if (paramsSearch.has('jobType[]')) {
  filteredJobs = filteredJobs.filter(job => {
    return paramsSearch.getAll('jobType[]').includes(job.job_type);
  });
}

if (paramsSearch.has('freelancerType[]')) {
  filteredJobs = filteredJobs.filter(job => {
    return paramsSearch.getAll('freelancerType[]').includes(job.freelancer_type);
  });
}

if (paramsSearch.has('projectLength[]')) {
  filteredJobs = filteredJobs.filter(job => {
    return paramsSearch.getAll('projectLength[]').includes(job.project_length);
  });
}

if (paramsSearch.has('skills')) {
  filteredJobs = filteredJobs.filter(job => {
    return JSON.parse(job.skills).some(skill => paramsSearch.getAll('skills').includes(skill.name));
  });
}

if (paramsSearch.has('radio-price')) {
  filteredJobs = filteredJobs.filter(job => {
    return job.radio_price === paramsSearch.get('radio-price');
  });
}

// 3. Create Cards for Filtered Jobs
document.querySelector('.cards').innerHTML = ''; // Clear existing cards
filteredJobs.forEach(job => {
  createCard(job);
});


// Function Create Card 
function createCard(job) {
  const card = document.createElement('div');
  card.classList.add('card');

  const text = document.createElement('div');
  text.classList.add('text');

  const name = document.createElement('p');
  name.classList.add('name');
  name.innerHTML = `<i class="fa-solid fa-certificate"></i><a href="/freelancers/${job.user_id}">${job.user_name}</a>`;

  const projectName = document.createElement('a');
  projectName.href = `/projects/${job.id}`;
  projectName.textContent = job.name;

  const cost = document.createElement('p');
  cost.classList.add('cost');
  cost.innerHTML = `<i class="fa-solid fa-briefcase"></i>cost <b>$${job.price_min.toFixed(2)} - $${job.price_max.toFixed(2)}</b>`;

  const desc = document.createElement('p');
  desc.classList.add('desc');
  desc.textContent = job.bio;

  const skills = document.createElement('ul');
  skills.classList.add('skills');
  JSON.parse(job.skills).forEach(skill => {
    const skillItem = document.createElement('li');
    skillItem.classList.add('skill');
    const skillLink = document.createElement('a');
    skillLink.href = '?skills=' + skill.name;
    skillLink.textContent = skill.name;
    skillItem.appendChild(skillLink);
    skills.appendChild(skillItem);
  });

  text.appendChild(name);
  text.appendChild(projectName);
  text.appendChild(cost);
  text.appendChild(desc);
  text.appendChild(skills);

  const info = document.createElement('ul');
  info.classList.add('info');

  const infoItem1 = document.createElement('li');
  infoItem1.innerHTML = `<i class="fa-solid fa-language"></i><p>${job.english_level}</p>`;
  info.appendChild(infoItem1);

  const infoItem2 = document.createElement('li');
  infoItem2.innerHTML = `<i class="fa-regular fa-building"></i><p>${job.job_type}</p>`;
  info.appendChild(infoItem2);

  const infoItem3 = document.createElement('li');
  infoItem3.innerHTML = `<i class="fa-solid fa-user-tie"></i><p>${job.freelancer_type}</p>`;
  info.appendChild(infoItem3);

  const infoItem4 = document.createElement('li');
  infoItem4.innerHTML = `<i class="fa-solid fa-clock-rotate-left"></i><p>${job.project_length}</p>`;
  info.appendChild(infoItem4);

  const infoItem5 = document.createElement('li');
  infoItem5.innerHTML = `<i class="fa-solid fa-money-bill-wave"></i><p>${job.radio_price}</p>`;
  info.appendChild(infoItem5);

  const country = document.createElement('li');
  country.innerHTML = `<img src="../imgs/${job.user_country}.png" alt="Country" /><p>${job.user_country.toUpperCase()}</p>`;
  info.appendChild(country);

  const favorite = document.createElement('li');
  favorite.innerHTML = `<a href="/save-job/${job.id}"> <img src="../imgs/favorite.png" alt="Love Img"/> Save </a>`;
  info.appendChild(favorite);

  const viewJobButton = document.createElement('a');
  viewJobButton.classList.add('btn');
  viewJobButton.href = `/projects/${job.id}`;
  viewJobButton.textContent = 'View Job';

  info.appendChild(viewJobButton);

  card.appendChild(text);
  card.appendChild(info);

  document.querySelector('.cards').appendChild(card);

  return card;
}
