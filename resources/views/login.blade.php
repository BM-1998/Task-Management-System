<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link the external CSS file -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset('js/popup.js') }}"></script>
</head>
<body>
<div id="popup-container">
        <div id="success-popup" class="popup success">
            <span class="close" onclick="closePopup('success-popup')">&times;</span>
            <p id="success-message">Success! Your action was completed.</p> <!-- Custom message will be here -->
        </div>
        <div id="error-popup" class="popup error">
            <span class="close" onclick="closePopup('error-popup')">&times;</span>
            <p id="error-message">Error! Something went wrong.</p> <!-- Custom message will be here -->
        </div>
    </div>

    <!-- Buttons to trigger popups with custom messages
    <button onclick="showPopup('success-popup', 'Successfully completed the operation!')">Show Success</button>
    <button onclick="showPopup('error-popup', 'An error occurred during the operation!')">Show Error</button> -->
</div>
    <div class="login-container">
        <div class="login-image">
            <img src="{{ asset('images/work_img_1.png') }}" alt="Login Illustration">
        </div>
        <div class="login-form">
            <h2>Login to your account</h2>
            <div class="login-buttons">
                <button>Login as User</button>
                <button>Login as Admin</button>
            </div>

            <form id="loginForm" method="POST">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <label for="email">Enter your Email</label>
                <input type="email" id="email" name="email" placeholder="Inputyouremail@email.com" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <button type="button" onclick="login()">Log In</button>

                <div class="register">
                    <span>Don't have an account? <a href="/register">Register</a></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        // function login() {
        //     const email = document.getElementById('email').value;
        //     const password = document.getElementById('password').value;
        //     const csrfToken = document.querySelector('input[name="_token"]').value;

        //     fetch('/api/login', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': csrfToken
        //         },
        //         body: JSON.stringify({
        //             email: email,
        //             password: password,
        //         }),
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.data.token) {
        //             localStorage.setItem('token', data.data.token);
        //             localStorage.setItem('u_id', data.data.id);
        //             localStorage.setItem('role', data.data.role);
        //             alert(data.message);
        //             window.location.href = '/dashboard';
        //         } else {
        //             alert('Login failed');
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //     });
        // }
        function login() {
        const form = document.getElementById('loginForm');

        if (form.checkValidity()) { // HTML5 form validation check
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const csrfToken = document.querySelector('input[name="_token"]').value;

            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                }),
            })
            .then(response => {
                if (response.status === 401 || response.status === 403) {
                    showPopup('error-popup', "invalid Username and password");
                }
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.data.token) {
                    localStorage.setItem('token', data.data.token);
                    localStorage.setItem('u_id', data.data.id);
                    localStorage.setItem('role', data.data.role);
                    localStorage.setItem('name', data.data.name);
                    showPopup('success-popup', data.message);
                    //alert(data.message);
                    setTimeout(function() {
                        window.location.href = '/dashboard'; // Redirect to the dashboard after 2 seconds
                    }, 1000);
                } else {
                    showPopup('error-popup', 'Login Failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        } else {
            form.reportValidity(); // Trigger browser validation messages
        }
}

    </script>
</body>
</html>
