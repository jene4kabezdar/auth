const login_input = document.getElementById('login');
const password_input = document.getElementById('password');
const submit_btn = document.getElementById('submit');
const login_form = document.getElementById('login_form');

submit_btn.addEventListener('click', (event) => {
    console.log(login_input.value);
    console.log(password_input.value);
    event.preventDefault();
    fetch('/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: {
            login: login_input.value,
            password: password_input.value,
        }
    })
        .then(response => console.log(response))
})