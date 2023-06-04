const login_input = document.getElementById('login');
const password_input = document.getElementById('password');
const error = document.getElementById('error');

const submit_btns = document.querySelectorAll('.submit');

let client_data = document.querySelector('#client_data');
if (client_data) {
    const user_id = JSON.parse(client_data.innerHTML);
    show_user_card(user_id)
}

submit_btns.forEach(btn => {
    btn.addEventListener('click', (event) => {
        const url = btn.value === 'Login' ? '/login.php' : '/registration.php';
        const hapen = btn.value === 'Login' ? 'Авторизация' : 'Регистрация';
        error.innerText = '';
        if (login_input.value === '') {
            error.innerText = 'Вы не ввели логин';
        }
    
        if (password_input.value === '') {
            error.innerText = 'Вы не ввели пароль';
        }
        event.preventDefault();
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({
                login: login_input.value,
                password: password_input.value,
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success === false) {
                    error.innerText = data.err;
                } else {
                    show_success(hapen);
                    setTimeout(() => {
                        show_user_card(data.user_id);
                    }, 10000);
                }
            });
    });
});

function show_success(hapen) {
    document.body.innerHTML = '';
    const success_text = `
        <div class="user_content">
            <div class="success_text">
                ${hapen} прошла успешно
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML('afterbegin', success_text);
}

function show_user_card(user_id) {
    fetch('/get_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            user_id: user_id,
        })
    })
        .then(response => response.json())
        .then(data => {
            document.body.insertAdjacentHTML('afterbegin', draw_user_page(data));
            const logout = document.getElementById('logout');
            logout.addEventListener('click', () => {
                fetch('/logout.php', {
                    method: 'GET',
                })
                    .then(setTimeout(() => {
                        location.reload()
                    }, 1000))
            })
        });
}

function draw_user_page(data) {
    document.body.innerHTML = '';
    return `
        <div class="user_content">
            <div class="user_img">
                <img src="${data.photo}" alt="your photo" class="avatar">
            </div>
            <div class="user_data">
                <div class="user_name">
                    ${data.name}
                </div>
                <div class="user_dob">
                    ${data.dob}
                </div>
                <button id="logout">Log Out</button>
            </div>
        </div>
    `;
}
