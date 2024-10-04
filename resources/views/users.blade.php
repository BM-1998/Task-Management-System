<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="{{ asset('js/popup.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
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
</div>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar" aria-label="Main Navigation">
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
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div class="header-left">
                    <h1>Welcome!</h1>
                    <p>Admin</p>
                </div>
                <div class="header-right">
                    <img src="{{asset('images/noti.png')}}" alt="Icon 1" />
                    <img src="{{asset('images/chat.png')}}" alt="Icon 2" />
                    <img src="{{asset('images/group.png')}}" alt="Profile Icon" class="profile-icon"/>
                </div>
            </div>
            <header class="header">
                <div class="header-left">
                    <h1>Create User</h1>
                </div>
                <button class="add-button" onclick="openModal()" aria-label="Add New User">Add New User</button>
            </header>

            <!-- User Table -->
            <table class="user-table">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userList">
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </main>
    </div>

    <!-- Modal for Add/Edit User -->
    <div id="userModal" class="modal" onclick="closeModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2 id="modalTitle">Add User</h2>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" name="id" value="0" id="id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Enter name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Enter password" required>

                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button id="saveButton" onclick="saveUser()">Save</button>
            </div>
        </div>
    </div>

    <script>
        // Fetch users from API and populate the table
        document.addEventListener('DOMContentLoaded', function () {
            fetchUsers();
        });

        function fetchUsers() {
            const token = localStorage.getItem('token');
            fetch('http://127.0.0.1:8000/api/admin/users', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
            .then(response => {
                if (response.status === 403) {
                    // If the status is 403 Forbidden, redirect to login or any other page
                    window.location.href = '/dashboard'; // Adjust the redirect URL as needed
                    throw new Error('Forbidden access - redirecting to dashboard');
                }
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const userList = document.getElementById('userList');
                userList.innerHTML = ''; // Clear existing rows
                data.data.forEach((user, index) => {
                    userList.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td class="actions">
                                <i class="fas fa-edit" onclick="openEditModal(${user.id})" aria-label="Edit User"></i>
                                <i class="fas fa-trash" onclick="deleteUser(${user.id})" aria-label="Delete User"></i>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error fetching users:', error));
        }

        // Open modal for adding a new user
        function openModal(isEdit = false) {
            document.getElementById('userModal').style.display = 'flex';
    
            if (!isEdit) { // Only reset the form when adding a new user
                document.getElementById('userForm').reset();
                document.getElementById('modalTitle').innerText = 'Add User';
                document.getElementById('saveButton').innerText = 'Save';
            }
        }


        // Close modal
        function closeModal(event) {
            if (event) event.preventDefault();
            document.getElementById('userModal').style.display = 'none';
        }

        // Save user (add/edit)
        function saveUser() {
            const elv = document.getElementById('id');
            console.log(elv.value);
            const id = elv.value;
            const url = id != 0 ? `http://127.0.0.1:8000/api/admin/users/${id}` : 'http://127.0.0.1:8000/api/admin/users';
            const method = id != 0 ? 'PUT' : 'POST';
            const csrfToken = document.querySelector('input[name="_token"]').value;
            const data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                role: document.getElementById('role').value
            };

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                showPopup('success-popup', 'User Added Successfully');
                    //alert(data.message);
                setTimeout(function() {
                    window.location.href = '/users'; // Redirect to the dashboard after 2 seconds
                }, 1000);
                //window.location.href = '/users';
                closeModal();
            })
            .catch(error => console.error('Error saving user:', error));
        }

        // Open modal for editing a user
        function openEditModal(id) {
            fetch(`http://127.0.0.1:8000/api/admin/users/${id}`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('id').value = user.data.id;
                document.getElementById('name').value = user.data.name;
                document.getElementById('email').value = user.data.email;
                document.getElementById('role').value = user.data.role;
                document.getElementById('modalTitle').innerText = 'Edit User';
                document.getElementById('saveButton').innerText = 'Update';
                openModal(true);
            })
            .catch(error => console.error('Error fetching user:', error));
        }

        // Delete user
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`http://127.0.0.1:8000/api/admin/users/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`,
                        'X-CSRF-TOKEN': csrfToken // Add the CSRF token here
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    window.location.href = '/users';
                })
                .catch(error => console.error('Error deleting user:', error));
            }
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
