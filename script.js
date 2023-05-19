const wrapper = document.querySelector('.wrapper');
const wrappers = document.querySelector('.wrappers');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const btbPopup = document.querySelector('.btbLogin-popup');
const iconClose = document.querySelector('.icon-close');
const iconCloses = document.querySelector('.icon-closes');
registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
});
btbPopup.addEventListener('click', ()=> {
    wrappers.classList.add('active-popups');
});
iconCloses.addEventListener('click', ()=> {
    wrappers.classList.remove('active-popups');
});
