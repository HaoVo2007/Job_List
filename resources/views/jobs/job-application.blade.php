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
                <a href="/">Job</a>
            </li>
            <li>></li>
            <li>
                <a href="/job/detail/{{ $job->id }}">{{ $job->title }}</a>
            </li>
            <li>></li>
            <li>
                Apply
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

    <div class="rounded-md border mb-4 border-slate-300 bg-white p-4 shadow-sm">

        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-medium">{{ $job->title }}</h2>
            <div class="text-slate-500  text-sm">
                {{ $job->salary }}$
            </div>
        </div>

        <div class="flex justify-between items-center mb-4 text-sm text-slate-700">
            <div class="flex space-x-4">
                <div>Company Name</div>
                <div>{{ $job->employer->company_name }}</div>
            </div>

            <div class="flex space-x-2 text-xs">
                <div class="rounded-md border px-2 py-1">{{ $job->experience }}</div>
                <div class="rounded-md border px-2 py-1">{{ $job->category }}</div>
            </div>
        </div>

    </div>

    <div class="rounded-md border border-slate-300 bg-white p-4 shadow-sm">

        <div class="flex justify-between mb-4">
            <h2 class="text-lg font-medium">Your Job Application</h2>
        </div>
        <div class="mb-4">
            <div class="mb-2 font-semibold text-xs">Expected Salary</div>
        <input
            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2 pr-8"
            placeholder="Enter your desired salary for the job" type="number" name="" id="expected-salary">
        </div>
        <div class="mb-4">
            <div class="mb-2 font-semibold text-xs">Upload CV</div>
        <input
            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2 pr-8"
           type="file" name="" id="cv">
        </div>
        <div class="flex items-center mt-4 justify-center">
            <button id="btn-apply-job"
                class="px-6 py-1 border-b-4 border border-red-500 text-red-500 hover:text-white hover:bg-red-500 transition-all duration-200">Apply Job</button>
        </div>
    </div>

</body>

<script>

    function getJobId() {
        var path = window.location.pathname;
        var match = path.match(/\/job\/(\d+)/);
        
        if (match) {
            var jobId = match[1]; 
            return jobId;
        } else {
            return null;
        }
    }

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
        var jobId = getJobId();
        if (token) {
            $('#logoutButton').show()
            $('#registerButton').hide()
        } else {
            $('#logoutButton').hide()
            $('#registerButton').show()
        }

        $('#btn-apply-job').on('click', function() {
            var expected_salary = $('#expected-salary').val();
            var cvFile = $('#cv')[0].files[0];

            var formData = new FormData();

            formData.append('expected_salary', expected_salary);
            formData.append('cv', cvFile);

            $.ajax({
                url: '/api/jobs/' + jobId + '/applications',
                type: "POST",
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
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
                    swal("Something Went Wrong", "You clicked the button!", "error");
                }
            });
        });
    });
</script>

</html>
