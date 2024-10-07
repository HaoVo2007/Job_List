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
                <a href="">Job</a>
            </li>
        </ul>

        <div class="infor-user flex items-center space-x-2">
            <a href="/my-application"><p id="userName" class="font-semibold text-xs"></p></a>
            <a href="" id="job-url"><p class="font-semibold text-xs">My Job</p></a>
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
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <div class="mb-2 font-semibold">Search</div>
                <div class="relative">
                    <input
                        class="relative w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2 pr-8"
                        placeholder="Search for any text" type="text" name="" id="search">
                    <button id="clear-search"
                        class="absolute top-0 right-0 flex h-full items-center ml-1 mr-1 text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <div class="mb-2 font-semibold">Salary</div>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input
                            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2"
                            placeholder="From" type="text" name="" id="from-salary">
                        <button id="clear-from"
                            class="absolute top-0 right-0 flex h-full items-center ml-1 mr-1 text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="0.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative">
                        <input
                            class="w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2"
                            placeholder="To" type="text" name="" id="to-salary">
                        <button id="clear-to"
                            class="absolute top-0 right-0 flex h-full items-center ml-1 mr-1 text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="0.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
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
            <button id="btn-filter"
                class="px-6 py-1 border-b-4 border border-red-500 text-red-500 hover:text-white hover:bg-red-500 transition-all duration-200">Filter</button>
        </div>
    </div>
    <div id="job-container">

    </div>
</body>

<script>
    function loadJobs(search, from, to, experience, category) {
        var token = localStorage.getItem('token');
        $.ajax({
            url: 'api/jobs',
            type: "GET",
            dataType: 'JSON',
            data: {
                search: search,
                from_salary: from,
                to_salary: to,
                experience: experience,
                category: category
            },
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                var jobList = $('#job-container')
                jobList.empty()
                $.each(response.data, function(index, job) {
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
                                        <div>${job.employer.company_name}</div>
                                    </div>   
                                    
                                    <div class="flex space-x-2 text-xs">
                                        <div class="rounded-md border px-2 py-1 cursor-pointer experience-filter" data-experience="${job.experience}">
                                            ${job.experience}
                                        </div>
                                        <div class="rounded-md border px-2 py-1 cursor-pointer category-filter" data-category="${job.category}">
                                            ${job.category}
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-500 leading-loose mb-2">${job.description}</p>
                                <a class="rounded-md border border-slate-500 px-2 py-1 text-sm text-slate-900 shadow-sm" href="/job/detail/${job.id}">See Detail</a>
                            </div>          
                        `
                    )
                })
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
                if (response.status == 'success') {
                    $('#userName').text('' + response.data.name);
                    
                    if (response.message === 'user') {
                        $('#job-url').attr('href', '/create/employee');
                    } else if (response.message === 'employer') {
                        $('#job-url').attr('href', '/my-job');
                    }
                } 
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    $('#job-url').hide(); 
                } else {
                    console.error('Error fetching user:', xhr.responseText);
                }
            }
        });
    }

    $(document).ready(function() {

        loadJobs()

        loadUser()

        var token = localStorage.getItem('token');

        if (token) {
            $('#logoutButton').show()
            $('#registerButton').hide()
        } else {
            $('#logoutButton').hide()
            $('#registerButton').show()
        }

        $('#btn-filter').on('click', function(e) {
            e.preventDefault();

            var search = $('#search').val();
            var fromSalary = $('#from-salary').val();
            var toSalary = $('#to-salary').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $('input[name="category"]:checked').val();

            loadJobs(search, fromSalary, toSalary, experience, category);
        });

        $('#clear-search').on('click', function(e) {
            var fromSalary = $('#from-salary').val();
            var toSalary = $('#to-salary').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $('input[name="category"]:checked').val();
            $('#search').val('');
            loadJobs('', fromSalary, toSalary, experience, category);
        })

        $('#clear-from').on('click', function(e) {
            var search = $('#search').val();
            var toSalary = $('#to-salary').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $('input[name="category"]:checked').val();
            $('#from-salary').val('');
            loadJobs(search, '', toSalary, experience, category);
        })

        $('#clear-to').on('click', function(e) {
            var search = $('#search').val();
            var fromSalary = $('#from-salary').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $('input[name="category"]:checked').val();
            $('#to-salary').val('');
            loadJobs(search, fromSalary, '', experience, category);
        })

        $(document).on('click', '.experience-filter', function(e) {
            var search = $('#search').val();
            var fromSalary = $('#from-salary').val();
            var toSalary = $('#to-salary').val();
            var category = $('input[name="category"]:checked').val();
            var experience = $(this).data('experience').toLowerCase();
            $('input[name="experience"][value="' + experience + '"]').prop('checked', true);
            loadJobs(search, fromSalary, toSalary, experience, category);
        });

        $(document).on('click', '.category-filter', function(e) {
            var search = $('#search').val();
            var fromSalary = $('#from-salary').val();
            var toSalary = $('#to-salary').val();
            var experience = $('input[name="experience"]:checked').val();
            var category = $(this).data('category').toLowerCase();
            $('input[name="category"][value="' + category + '"]').prop('checked', true);
            loadJobs(search, fromSalary, toSalary, experience, category);
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
