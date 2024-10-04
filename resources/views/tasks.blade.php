<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
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
                    <h4 id="user_name"></h4>
                </div>
                <div class="header-right">
                    <img src="{{asset('images/noti.png')}}" alt="Icon 1" />
                    <img src="{{asset('images/chat.png')}}" alt="Icon 2" />
                    <img src="{{asset('images/group.png')}}" alt="Profile Icon" class="profile-icon"/>
                </div>
            </div>

            <div class="task-header">
                <h1>Today's Task</h1>
                <button class="add-task-button" id="add-new-task" onclick="openTaskModal()">Add New Task</button>
            </div>

            <!-- Task Tabs -->
            <div class="task-tabs">
            <div class="tab active" id="total-tasks"></div>
            <div class="tab active" id="completed-tasks"></div>
            <!-- <div class="tab">Filter By Priority <i class="fas fa-filter"></i></div> -->
            </div>

            <!-- Task Boxes Grid -->
            <div class="task-grid">

            </div>
        </main>
    </div>

    <!-- Task Modal -->
    <div id="taskModal" class="modal" onclick="closeTaskModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeTaskModal()">&times;</span>
            <div class="modal-header">
                <h2 id="taskModalTitle">Add Task</h2>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <input type="hidden" name="taskId" value="0" id="taskId">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="Enter task title" required>

                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Enter task description" required></textarea>

                    <label for="status">Status</label>
                    <select id="status" required>
                        <option value="">Select status</option>
                        <option value="Pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>

                    <label for="assigned_to" id="ass_to">Assign To</label>
                    <select id="assigned_to" required>
                        <option value="">Select user</option>
                        <!-- <option value="Pending">Pending</option>
                        <option value="completed">Completed</option> -->
                    </select>

                    <label for="priority" id="pri">Priority</label>
                    <select id="priority" required>
                        <option value="">Select priotity</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>

                    <div class="modal-footer">
                        <button type="submit" onClick="saveUser(event)" id="saveTaskBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fetch users from API and populate the table

        document.addEventListener('DOMContentLoaded', function () {
            displayMenuBasedOnRole();
            const role = localStorage.getItem('role');
            if(role === 'admin'){
                fetchTask();
                fetchStatistics();
                fetchAssignTo();
            }else{
                fetchTaskUser();
                fetchStatisticsUser();
            }
            
        });

        function displayMenuBasedOnRole() {
            const role = localStorage.getItem('role');

            document.getElementById('user_name').textContent = localStorage.getItem('role');
            if (role === 'user') {
                document.getElementById('users-menu').style.display = 'none';
                document.getElementById('add-new-task').style.display = 'none';
            }
        }

        function fetchAssignTo() {
            const token = localStorage.getItem('token');
            fetch('http://127.0.0.1:8000/api/admin/getAssignedToUsers', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                const assignedToDropdown = document.getElementById('assigned_to');
                assignedToDropdown.innerHTML = '<option value="">Select user</option>'; // Clear existing options and add a default option

                data.data.forEach(user => {
                    // Create a new option element
                    const option = document.createElement('option');
                    option.value = user.id;  // Set the value to user id
                    option.textContent = user.name;  // Set the displayed text to user name

                    // Append the option to the dropdown
                    assignedToDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching users:', error));
        }

        function fetchTask() {
            const token = localStorage.getItem('token');
            fetch('http://127.0.0.1:8000/api/admin/tasks', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
            .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
            const taskGrid = document.querySelector('.task-grid');
            taskGrid.innerHTML = ''; // Clear existing tasks

            data.data.forEach(task => {
                // Create a new task box element
                const taskBox = document.createElement('div');
                taskBox.classList.add('task-box');

                // Format date from the API response
                const createdAt = new Date(task.created_at);
                const formattedDate = createdAt.toLocaleDateString('en-US', {
                    weekday: 'long', year: 'numeric', month: 'short', day: 'numeric'
                });

                // Task priority (assuming you have logic for it in your data)
                const priority = task.priority; // Example logic, adjust as needed

                // Create the inner HTML structure dynamically
                taskBox.innerHTML = `
                    <h3>${task.title}</h3>
                    <p>Details: ${task.description}</p>
                    <div class="task-meta">
                        <span><i class="fas fa-calendar-alt"></i> ${formattedDate}</span>
                        <span><i class="fas fa-user"></i> By ${task.created_by.name}</span>
                    </div>
                    <div class="task-meta">
                        <span class="task-priority priority-${priority.toLowerCase()}">${priority}</span>
                        <span> <i class="fas fa-edit" onclick="openEditModal(${task.id})" aria-label="Edit User"></i></span>
                    </div>
                   
                `;

                // Append the task box to the task grid
                taskGrid.appendChild(taskBox);
                });
            })
            .catch(error => console.error('Error fetching tasks:', error));
        }

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
                    //document.getElementById('total-users').textContent = data.total_users;
                    document.getElementById('total-tasks').textContent = "Created"+"("+data.total_tasks+")";
                    document.getElementById('completed-tasks').textContent = "Completed"+"("+data.completed_tasks+")";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function fetchTaskUser() {
            const token = localStorage.getItem('token');
            const id = localStorage.getItem('u_id');
            fetch(`http://127.0.0.1:8000/api/user/getTaskUser/${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
            })
            .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
            const taskGrid = document.querySelector('.task-grid');
            taskGrid.innerHTML = ''; // Clear existing tasks

            data.data.forEach(task => {
                // Create a new task box element
                const taskBox = document.createElement('div');
                taskBox.classList.add('task-box');

                // Format date from the API response
                const createdAt = new Date(task.created_at);
                const formattedDate = createdAt.toLocaleDateString('en-US', {
                    weekday: 'long', year: 'numeric', month: 'short', day: 'numeric'
                });

                // Task priority (assuming you have logic for it in your data)
                const priority = task.priority; // Example logic, adjust as needed

                // Create the inner HTML structure dynamically
                taskBox.innerHTML = `
                    <h3>${task.title}</h3>
                    <p>Details: ${task.description}</p>
                    <div class="task-meta">
                        <span><i class="fas fa-calendar-alt"></i> ${formattedDate}</span>
                        <span><i class="fas fa-user"></i> By ${task.created_by.name}</span>
                    </div>
                    <div class="task-meta">
                        <span class="task-priority priority-${priority.toLowerCase()}">${priority}</span>
                        <span> <i class="fas fa-edit" onclick="openEditModal(${task.id})" aria-label="Edit User"></i></span>
                    </div>
                `;

                // Append the task box to the task grid
                taskGrid.appendChild(taskBox);
                });
            })
            .catch(error => console.error('Error fetching tasks:', error));
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
                    //document.getElementById('total-users').textContent = data.total_users;
                    document.getElementById('total-tasks').textContent = "Total Task"+"("+data.total_tasks+")";
                    document.getElementById('completed-tasks').textContent = "Completed"+"("+data.completed_tasks+")";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        // Open modal for adding a new user
        function openTaskModal(isEdit = false) {
            document.getElementById('taskModal').style.display = 'flex';
    
            if (!isEdit) { // Only reset the form when adding a new user
                document.getElementById('taskForm').reset();
                document.getElementById('taskModalTitle').innerText = 'Add Task';
                document.getElementById('saveTaskBtn').innerText = 'Save';
            }else{
                // // Remove existing text elements for title and description if they exist
                // const titleText = document.getElementById('titleText');
                // const descriptionText = document.getElementById('descriptionText');
                // if (titleText) titleText.remove();
                // if (descriptionText) descriptionText.remove();

            }
        }


        // Close modal
        function closeTaskModal(event) {
            if (event) event.preventDefault();
            document.getElementById('taskModal').style.display = 'none';
        }

        // Save user (add/edit)
        function saveUser(event) {
            event.preventDefault(); // Prevent default form submission
            if(localStorage.getItem('role') == 'admin'){
                const elv = document.getElementById('taskId');
                const id = elv.value;
                const url = id != 0 ? `http://127.0.0.1:8000/api/admin/tasks/${id}` : 'http://127.0.0.1:8000/api/admin/tasks';
                const method = id != 0 ? 'PUT' : 'POST';
                const csrfToken = document.querySelector('input[name="_token"]').value;

                const data = {
                    title: document.getElementById('title').value,
                    description: document.getElementById('description').value,
                    assigned_to: document.getElementById('assigned_to').value,
                    created_by: localStorage.getItem('u_id'),
                    priority: document.getElementById('priority').value,
                    status: document.getElementById('status').value, // Don't forget the status
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
                            if(method == 'PUT'){
                                showPopup('success-popup', 'Task updated Successfully');
                            }else{
                                showPopup('success-popup', 'Task Added Successfully');
                            }
                            
                            //alert(data.message);
                            setTimeout(function() {
                                window.location.href = '/tasks'; 
                            }, 1000);
                            //window.location.href = '/tasks'; // Redirect upon successful save
                            closeModal(); // Close modal after saving
                    })
                    .catch(error => console.error('Error saving task:', error));
            }else{
                    const elv = document.getElementById('taskId');
                    const id = elv.value;
                    const url = id != 0 ? `http://127.0.0.1:8000/api/user/tasks/${id}` : 'http://127.0.0.1:8000/api/admin/tasks';
                    const method = id != 0 ? 'PUT' : 'POST';
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    const data = {
                        status: document.getElementById('status').value, // Don't forget the status
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
                            if(method == 'PUT'){
                                showPopup('success-popup', 'Task updated Successfully');
                            }else{
                                showPopup('success-popup', 'Task Added Successfully');
                            }
                            
                            //alert(data.message);
                            setTimeout(function() {
                                window.location.href = '/tasks'; 
                            }, 1000);
                            closeModal(); // Close modal after saving
                        })
                        .catch(error => console.error('Error saving task:', error));
            }
           
        }


        // Open modal for editing a user
        // function openEditModal(id) {
        //     fetch(`http://127.0.0.1:8000/api/user/getTaskById/${id}`)
        //     .then(response => response.json())
        //     .then(user => {
        //         if(localStorage.getItem('role') === 'admin'){
        //             document.getElementById('taskId').value = user.data.id;
        //             document.getElementById('title').value = user.data.title;
        //             document.getElementById('description').value = user.data.description;
        //             document.getElementById('status').value = user.data.status;
        //             document.getElementById('priority').value = user.data.priority;
        //             document.getElementById('assigned_to').value = user.data.assigned_to;
        //             document.getElementById('taskModalTitle').innerText = 'Edit User';
        //             document.getElementById('saveTaskBtn').innerText = 'Update';
        //         }else{
        //             // document.getElementById('taskId').value = user.data.id;
        //             // document.getElementById('title').value = user.data.name;
        //             // document.getElementById('description').value = user.data.email;
        //             // document.getElementById('status').value = user.data.status;
        //             // document.getElementById('priority').value = user.data.status;
        //             // document.getElementById('taskModalTitle').innerText = 'Edit User';
        //             // document.getElementById('saveTaskBtn').innerText = 'Update';
        //         }
                
        //         openTaskModal(true);
        //     })
        //     .catch(error => console.error('Error fetching user:', error));
        // }

    function openEditModal(id) {
        fetch(`http://127.0.0.1:8000/api/user/getTaskById/${id}`)
        .then(response => response.json())
        .then(user => {
                    // Get the modal elements
                    const taskIdInput = document.getElementById('taskId');
                    const titleInput = document.getElementById('title');
                    const descriptionInput = document.getElementById('description');
                    const statusInput = document.getElementById('status');
                    const priorityInput = document.getElementById('priority');
                    const assignedToInput = document.getElementById('assigned_to');
                    const taskModalTitle = document.getElementById('taskModalTitle');
                    const saveTaskBtn = document.getElementById('saveTaskBtn');
                    
                    const ass_to = document.getElementById('ass_to');
                    const pri = document.getElementById('pri');

                    const role = localStorage.getItem('role');

                    if (role === 'admin') {
                        // Admin view: Show all fields and allow editing
                        taskIdInput.value = user.data.id;
                        titleInput.value = user.data.title;
                        descriptionInput.value = user.data.description;
                        statusInput.value = user.data.status;
                        priorityInput.value = user.data.priority;
                        assignedToInput.value = user.data.assigned_to;

                        // Show all fields as editable for admin
                        titleInput.style.display = 'block';
                        titleInput.disabled = false;  // Allow editing
                        descriptionInput.style.display = 'block';
                        descriptionInput.disabled = false;  // Allow editing
                        statusInput.style.display = 'block';
                        statusInput.disabled = false;  // Allow editing
                        priorityInput.style.display = 'block';
                        priorityInput.disabled = false;  // Allow editing
                        assignedToInput.style.display = 'block';
                        assignedToInput.disabled = false;  // Allow editing

                        taskModalTitle.innerText = 'Edit Task';
                        saveTaskBtn.innerText = 'Update Task';
                    } else if (role === 'user') {
                        // User view: Show title and description as text, allow status change, hide priority and assigned_to
                        taskIdInput.value = user.data.id;
                        statusInput.value = user.data.status;

                        // Hide the 'assigned_to' and 'priority' fields for regular users
                        assignedToInput.style.display = 'none';
                        priorityInput.style.display = 'none';
                        ass_to.style.display = 'none';
                        pri.style.display = 'none';
                        // Hide the title and description input fields
                        titleInput.style.display = 'none';
                        descriptionInput.style.display = 'none';

                        // Remove any existing text fields (if they were added previously)
                        const existingTitleText = document.getElementById('titleText');
                        const existingDescriptionText = document.getElementById('descriptionText');
                        if (existingTitleText) existingTitleText.remove();
                        if (existingDescriptionText) existingDescriptionText.remove();

                        // Create and show static text for title and description
                        let titleText = document.createElement('p');
                        titleText.id = 'titleText';  // ID to remove later
                        titleText.innerText = `${user.data.title}`;
                        
                        let descriptionText = document.createElement('p');
                        descriptionText.id = 'descriptionText';  // ID to remove later
                        descriptionText.innerText = `${user.data.description}`;

                        // Append the text in place of the inputs
                        const form = document.getElementById('taskForm');
                        form.insertBefore(titleText, titleInput.nextSibling);
                        form.insertBefore(descriptionText, descriptionInput.nextSibling);

                        // Allow the user to update status only
                        statusInput.style.display = 'block';
                        statusInput.disabled = false;

                        taskModalTitle.innerText = 'View Task';
                        saveTaskBtn.innerText = 'Save Changes';
                    }

                    openTaskModal(true); // Open the modal
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
