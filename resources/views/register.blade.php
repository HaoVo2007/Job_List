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
    <!-- component -->
    <div class="container px-4 mx-auto">
        <div class="max-w-lg mx-auto">
            <div class="text-center mb-6">
                <h2 class="text-3xl md:text-4xl font-extrabold">Register</h2>
            </div>
            <form action="" id="loginForm">
                <div class="mb-6">
                    <label class="block mb-2 font-extrabold" for="">Name</label>
                    <input
                        class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded"
                        type="name" id="name" placeholder="">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-extrabold" for="">Email</label>
                    <input
                        class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded"
                        type="email" id="email" placeholder="email">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-extrabold" for="">Password</label>
                    <input
                        class="inline-block w-full p-4 leading-6 text-lg font-extrabold placeholder-indigo-900 bg-white shadow border-2 border-indigo-900 rounded"
                        type="password" id="password" placeholder="**********">
                </div>
                <button
                    type="submit" class="inline-block w-full py-4 px-6 mb-6 text-center text-lg leading-6 text-white font-extrabold bg-indigo-800 hover:bg-indigo-900 border-3 border-indigo-900 shadow rounded transition duration-200">Register</button>
                <p class="text-center font-extrabold">Have an account? <a
                        class="text-red-500 hover:underline" href="/login">Login</a></p>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); 

            var email = $('#email').val();
            var password = $('#password').val();
            var name = $('#name').val(); 

            $.ajax({
                url: '/api/register',
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                    password: password,
                    name: name 
                },
                success: function(response) {
                    if(response.status == 'success') {
                        window.location.href = '/login';
                    } else {
                        swal ( "Oops" ,  response.message ,  "error" )
                    }
                },
                error: function(xhr, status, error) {
                    swal ( "Oops" ,  "Incorrect login information" ,  "error" )
                }
            });
        });
    });
</script>

</html>
