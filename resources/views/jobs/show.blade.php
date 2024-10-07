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

<body class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-200 from-10% via-sky-300 via-30% to-emerald-300 to-90% text-slate-700">
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
                {{$job->title}}
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
    <div id="job-detail-container">

    </div>
    <div class="rounded-md border border-slate-300 bg-white p-4 shadow-sm">
        <h2 id="job-other-title" class="text-lg font-medium mb-2"></h2>
        <div id="order-jobs">

        </div>
    </div>

</body>

<script>
    function getJobId() {
        var path = window.location.pathname;
        var segments = path.split('/');
        var jobId = segments[segments.length - 1];
        return jobId
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

    function loadJobDetail() {
        var jobId = getJobId();
        var token = localStorage.getItem('token');
        $.ajax({
            url: '/api/jobs/' + jobId,
            type: "GET",
            dataType: 'JSON',
            headers: {
                'Authorization': 'Bearer ' + token 
            },
            success: function(response) {
                var job = response.data
                $('#job-detail-container').html(`
                    <div class="rounded-md border border-slate-300 bg-white p-4 mb-2 shadow-sm">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-lg font-medium">${job.title}</h2>
                            <div class="text-slate-500  text-sm">
                                ${job.salary}$
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-4 text-sm text-slate-700">
                            <div class="flex space-x-4">
                                <div>Company Name</div>
                                <div>${job.employer.company_name}</div>
                            </div>   
                                    
                            <div class="flex space-x-2 text-xs">
                                <div class="rounded-md border px-2 py-1">${job.experience}</div>
                                <div class="rounded-md border px-2 py-1">${job.category}</div>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 leading-loose mb-2">${job.description}</p>

                        <div class="flex justify-center">
                            ${response.can_apply ? `<a href="/job/${jobId}/applications" class="px-6 py-1 border-b-4 border border-red-500 text-red-500 hover:text-white hover:bg-red-500 transition-all duration-200">Apply</a>` : `<p class="font-semibold text-xs">${response.message}</p>`}
                        </div>
                    </div>          
                `);

                $('#job-other-title').text(job.employer.company_name);
                var otherJobs = job.employer.jobs;

                if (otherJobs) {
                    var otherJobsHtml = '';
                    otherJobs.forEach(function(otherJob) {
                        otherJobsHtml += `
                                <div class="flex justify-between">
                                    <h2 class="text-md font-medium text-slate-500">${otherJob.title}</h2>
                                    <div class="text-slate-500 text-sm">
                                        ${otherJob.salary}$
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mb-4 text-sm text-slate-700">
                                    <div class="flex space-x-4">
                                        <div>Created: </div>
                                        <div>${timeAgo(otherJob.created_at)}</div>
                                    </div>
                                    <div class="flex space-x-2 text-xs">
                                        
                                    </div>
                                </div>
                        `;
                    });

                    $('#order-jobs').html(otherJobsHtml);  
                } else {
                    $('#order-jobs').html('<p>No other jobs available</p>');
                }
            },
            error: function(xhr, status, error) {
                swal("Something Went Wrong", "", "error");
            }
        })
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
        loadJobDetail()
        loadUser()
        
        var token = localStorage.getItem('token');

        if (token) {
            $('#logoutButton').show()
            $('#registerButton').hide()
        } else {
            $('#logoutButton').hide()
            $('#registerButton').show()
        }

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
