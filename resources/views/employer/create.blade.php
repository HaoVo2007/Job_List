<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job List</title>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body
    class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-200 from-10% via-sky-300 via-30% to-emerald-300 to-90% text-slate-700">
    <nav class="mb-4 flex justify-between items-center">
        <ul class="flex space-x-2 text-slate-500 text-sm">
            <li>
                <a href="/">Home</a>
            </li>
            <li>></li>
            <li>
                <a href="/my-job">My job</a>
            </li>
            <li>></li>
            <li>
                <a href="#">Create new job</a>
            </li>
        </ul>

        <div class="infor-user flex items-center space-x-2">
            <p id="userName" class="font-semibold text-xs"></p>
            <button id="logoutButton"
                class="px-6 py-1 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition duration-300">
                Logout
            </button>

            <button id="registerButton"
                class="px-6 py-1 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition duration-300">
                <a href="/register">Register</a>
            </button>
        </div>
    </nav>

    <div class="rounded-md border border-slate-300 bg-white p-4 mb-2 shadow-sm">
        <div class="grid grid-cols-3 gap-4 text-sm mb-4">

            <div>
                <div class="mb-2 font-semibold">Title</div>
                <div class="relative">
                    <input
                        class="relative w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2 pr-8"
                        placeholder="Enter title" type="text" name="" id="title">
                </div>
            </div>

            <div>
                <div class="mb-2 font-semibold">Salary</div>
                    <div class="relative">
                        <input
                            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2"
                            placeholder="Enter salary" type="text" name="" id="salary">
                    </div>
            </div>

            <div>
                <div class="mb-2 font-semibold">Location</div>
                <div class="flex">
                    <div class="relative">
                        <input
                            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2"
                            placeholder="Enter location" type="text" name="" id="location">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 gap-20 mb-4">
            <div class="mb-2 font-semibold">Description</div>
            <textarea class="relative w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2 pr-8" name="" id="description" cols="30" rows="10"></textarea>
        </div>

        <div class="flex mt-6 items-center justify-center gap-20 mb-4">
            <div>
                <div class="mb-2 font-semibold">Experience</div>

                <label for="all" class="mb-1 flex items-center">
                    <input type="radio" name="experience" value="" id="all" checked>
                    <span class="ml-2">All</span>
                </label>

                <label for="intern" class="mb-1 flex items-center">
                    <input type="radio" name="experience" value="intern" id="intern">
                    <span class="ml-2">Intern</span>
                </label>

                <label for="fresher" class="mb-1 flex items-center">
                    <input type="radio" name="experience" value="fresher" id="fresher">
                    <span class="ml-2">Fresher</span>
                </label>

                <label for="junior" class="mb-1 flex items-center">
                    <input type="radio" name="experience" value="junior" id="junior">
                    <span class="ml-2">Junior</span>
                </label>

                <label for="senior" class="mb-1 flex items-center">
                    <input type="radio" name="experience" value="senior" id="senior">
                    <span class="ml-2">Senior</span>
                </label>
            </div>
            <div>
                <div class="mb-2 font-semibold">Category</div>

                <label for="it" class="mb-1 flex items-center">
                    <input type="radio" name="category" value="it" id="it">
                    <span class="ml-2">It</span>
                </label>

                <label for="marketing" class="mb-1 flex items-center">
                    <input type="radio" name="category" value="marketing" id="marketing">
                    <span class="ml-2">Marketing</span>
                </label>

                <label for="finance" class="mb-1 flex items-center">
                    <input type="radio" name="category" value="finance" id="finance">
                    <span class="ml-2">Finance</span>
                </label>

                <label for="sales" class="mb-1 flex items-center">
                    <input type="radio" name="category" value="sales" id="sales">
                    <span class="ml-2">Sales</span>
                </label>
            </div>
        </div>
        <div class="flex justify-center">
            <button id="btn-add-job"
                class="px-6 py-1 border-b-4 border border-red-500 text-red-500 hover:text-white hover:bg-red-500 transition-all duration-200">Create Job</button>
        </div>
    </div>

</body>

<script>

    function timeAgo(time) {
        const now = new Date();
        const seconds = Math.floor((now - new Date(time)) / 1000);

        let interval = Math.floor(seconds / 31536000);
        if (interval >= 1) {
            return interval + ' years ago';
        }
        interval = Math.floor(seconds / 2592000);
        if (interval >= 1) {
            return interval + ' months ago';
        }
        interval = Math.floor(seconds / 86400);
        if (interval >= 1) {
            return interval + ' days ago';
        }
        interval = Math.floor(seconds / 3600);
        if (interval >= 1) {
            return interval + ' hours ago';
        }
        interval = Math.floor(seconds / 60);
        if (interval >= 1) {
            return interval + ' minutes ago';
        }
        return seconds + ' seconds ago';
    }

    function loadUser() {
        var token = localStorage.getItem('token');

        $.ajax({
            url: '/api/get/user',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#userName').text('Hello, ' + response.data.name);
            },
            error: function(xhr) {
                console.error('Error fetching user:', xhr.responseText);
            }
        });
    }

    $(document).ready(function() {

        loadUser()

        var token = localStorage.getItem('token');

        if (token) {
            $('#logoutButton').show()
            $('#registerButton').hide()
        } else {
            $('#logoutButton').hide()
            $('#registerButton').show()
        }

        $('#btn-add-job').on('click', function() {
            var salary = $('#salary').val();
            var title = $('#title').val();
            var description = $('#description').val();
            var location = $('#location').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $('input[name="category"]:checked').val();


            $.ajax({
                url: '/api/create-job',
                type: "POST",
                dataType: 'JSON',
                data: {
                    title: title,
                    description: description,
                    salary: salary,
                    location: location,
                    category: category,
                    experience: experience
                },
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    if (response.status == 'success') {
                        swal(response.message, "You clicked the button!", response.status); 
                    } else {
                        swal(response.message, "You clicked the button!", response.status); 
                    }
                },
                error: function(xhr) {
                    var errorMessage = "Something Went Wrong";
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message; 
                    }

                    swal(errorMessage, "You clicked the button!", "error");
                }
            })
        })

        $('#logoutButton').on('click', function() {
            $.ajax({
                url: '/api/logout',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    if (response.status == 'success') {
                        localStorage.removeItem('token');
                        window.location.href = '/login';
                    }
                },
                error: function(xhr) {
                    console.error('Logout failed:', xhr.responseJSON.message ||
                        'An error occurred.');
                    alert('Logout failed: ' + (xhr.responseJSON.message ||
                        'An error occurred.'));
                }
            });
        });

    });
</script>

</html>
