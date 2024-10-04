<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header-left h1 {
            font-size: 24px;
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .header-left p {
            font-size: 14px;
            color: #777;
            margin: 5px 0 0 0;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .header-right img {
            margin-left: 20px;
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .profile-icon {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 220px;
            background-color: #fff;
            border-right: 1px solid #ddd;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            font-size: 16px;
            color: #333;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        .main-content h1 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .stats-cards {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1 1 25%; /* This allows the cards to adjust width dynamically */
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-content {
            text-align: left;
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card span {
            font-size: 36px;
            color: #333;
        }

        .card img {
            width: 50px; /* Adjust the width as needed */
            height: 50px; /* Adjust the height as needed */
            object-fit: contain;
        }

        /* Notification */
        .notification {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .notification .badge {
            background-color: #ffbe0b;
            color: white;
            padding: 10px 12px;
            border-radius: 50%;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .card {
                width: 30%;
            }
        }

        @media (max-width: 992px) {
            .card {
                width: 45%;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            .main-content {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                margin-top: 10px;
            }

            .stats-cards {
                flex-direction: column;
            }

            .card {
                width: 100%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .header-left h1 {
                font-size: 20px;
            }

            .header-left p {
                font-size: 12px;
            }

            .card h3 {
                font-size: 16px;
            }

            .card span {
                font-size: 28px;
            }

            .header-right img {
                width: 30px;
                height: 30px;
            }
        }

        @media (max-width: 400px) {
            .header-left h1 {
                font-size: 18px;
            }

            .header-left p {
                font-size: 10px;
            }

            .card h3 {
                font-size: 14px;
            }

            .card span {
                font-size: 24px;
            }

            .header-right img {
                width: 25px;
                height: 25px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Logo</h2>
            <ul id="menu">
                <li><a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li id="users-menu"><a href="/users"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="/tasks"><i class="fas fa-tasks"></i> Tasks</a></li>
                <li>
                    <a href="#" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <h1>Welcome!</h1>
                    <h4 id="user_name"></h4>
                </div>
                <div class="header-right">
                    <img src="{{asset('images/noti.png')}}" alt="Icon 1" />
                    <img src="{{asset('images/chat.png')}}" alt="Icon 2" />
                    <img src="{{asset('images/group.png')}}" alt="Profile Icon" class="profile-icon"/>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="card">
                    <div class="card-content">
                        <h3>Total Users</h3>
                        <span id="total-users">0</span>
                    </div>
                    <img src="{{asset('images/group.png')}}" alt="Users Icon" />
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Total Tasks</h3>
                        <span id="total-tasks">0</span>
                    </div>
                    <img src="{{asset('images/ads_click.png')}}" alt="Tasks Icon" />
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Completed Tasks</h3>
                        <span id="completed-tasks">0</span>
                    </div>
                    <img src="{{asset('images/handshake.png')}}" alt="Completed Tasks Icon" />
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            displayMenuBasedOnRole();
            
        });

        // Display Menu Based on Role (Admin or User)
        function displayMenuBasedOnRole() {
            const role = localStorage.getItem('role');

            document.getElementById('user_name').textContent = localStorage.getItem('role');
            if (role === 'user') {
                document.getElementById('users-menu').style.display = 'none';
                fetchStatisticsUser();
            }else{
                fetchStatistics();
            }
        }

        // Fetch and Display Statistics
        function fetchStatistics() {
            const token = localStorage.getItem('token');

            fetch('http://127.0.0.1:8000/api/admin/statistics', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('total-users').textContent = data.total_users;
                    document.getElementById('total-tasks').textContent = data.total_tasks;
                    document.getElementById('completed-tasks').textContent = data.completed_tasks;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function fetchStatisticsUser() {
            const token = localStorage.getItem('token');
            const id = localStorage.getItem('u_id');
            fetch(`http://127.0.0.1:8000/api/user/getStatisticsUser/${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const totalUsersElement = document.getElementById('total-users');

                    // If the element is found, hide its parent 'card' element
                    if (totalUsersElement) {
                        totalUsersElement.closest('.card').style.display = 'none';
                    }
                    document.getElementById('total-tasks').textContent = data.total_tasks;
                    document.getElementById('completed-tasks').textContent = data.completed_tasks;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function logout() {
            const token = localStorage.getItem('token');
    
            fetch('http://127.0.0.1:8000/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (response.ok) {
                    localStorage.removeItem('token');  // Clear the token from storage
                    window.location.href = '/login';   // Redirect to login page
                }
            })
            .catch(error => console.error('Logout failed:', error));
        }

    </script>
</body>
</html>
