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
                <a href="/my-job">My Job</a>
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
    <div class="flex justify-end mb-4">
        <a href="/create/job"
            class="px-6 py-1 border-b-4 border border-red-500 text-red-500 hover:text-white hover:bg-red-500 transition-all duration-200">Add Job</a>
    </div>
    <div id="job-container">
        
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

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function loadMyJobs() {
        var token = localStorage.getItem('token');
        $.ajax({
            url: 'api/employer-job',
            type: "GET",
            dataType: 'JSON',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                var jobList = $('#job-container')
                jobList.empty()
                var companyName = response.data.employer.company_name;

                if (response.data.employer.jobs.length === 0) {
                    jobList.append(`<div class="rounded-md border border-slate-300 bg-white p-4 mb-2 shadow-sm">
                                        <div class="flex justify-center items-center mb-4 text-sm text-slate-700">
                                            <p class="m-0 text-center text-lg font-medium text-slate-500">No jobs found.</p>
                                        </div>
                                    </div>              
                        `)
                } else {

                    $.each(response.data.employer.jobs, function(index, job) {
                    jobList.append(
                        `
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
                                        <div>${companyName}</div>
                                    </div>   
                                    
                                    <div class="flex space-x-2 text-xs">
                                        <div class="rounded-md border px-2 py-1 cursor-pointer experience-filter" data-experience="${job.experience}">
                                            ${job.experience}
                                        </div>
                                        <div class="rounded-md border px-2 py-1 cursor-pointer category-filter" data-category="${job.category}">
                                            ${capitalizeFirstLetter(job.category)}
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500 leading-loose mb-2">${job.description}</p>
                                <div class="flex justify-between items-center mb-4 text-sm text-slate-700">
                                    <div class="">
                                        <div class="flex space-x-2 items-center mb-1">
                                            <p class="font-semibold text-md">Created: </p>
                                            <span class="font-semibold text-xs">${timeAgo(job.created_at)}</span>
                                        </div>
                                    </div>  
                                    <a class="rounded-md border border-slate-500 px-2 py-1 text-sm text-slate-900 shadow-sm cursor-pointer" data-id = "${job.id}" id="delete-job">Delete</a>
                                </div>
                            </div>          
                        `
                    )
                })
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

        loadMyJobs()

        loadUser()

        var token = localStorage.getItem('token');

        if (token) {
            $('#logoutButton').show()
            $('#registerButton').hide()
        } else {
            $('#logoutButton').hide()
            $('#registerButton').show()
        }

        $(document).on('click', '#delete-job', function() {

            var jobId = $(this).data('id');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/api/delete-job/' + jobId,
                        type: 'DELETE',
                        dataType: 'JSON',
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        success: function(response) {
                            swal(response.message, "", response.status);
                            loadMyJobs()
                        },
                        error: function(xhr, status, error) {
                            swal("Something Went Wrong", "", "error");
                        }
                    });
                }
            });
        });


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
