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
                <h2 class="text-3xl md:text-4xl font-extrabold">Sign in</h2>
            </div>
            <form action="" id="loginForm">
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
                <div class="flex flex-wrap -mx-4 mb-6 items-center justify-between">
                    <div class="w-full lg:w-auto px-4 mb-4 lg:mb-0">
                        <label for="">
                            <input type="checkbox">
                            <span class="ml-1 font-extrabold">Remember me</span>
                        </label>
                    </div>
                    <div class="w-full lg:w-auto px-4"><a class="inline-block font-extrabold hover:underline"
                            href="#">Forgot your
                            password?</a></div>
                </div>
                <button
                    type="submit" class="inline-block w-full py-4 px-6 mb-6 text-center text-lg leading-6 text-white font-extrabold bg-indigo-800 hover:bg-indigo-900 border-3 border-indigo-900 shadow rounded transition duration-200">Sign
                    in</button>
                <p class="text-center font-extrabold">Don&rsquo;t have an account? <a
                        class="text-red-500 hover:underline" href="/register">Register</a></p>
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

            $.ajax({
                url: '/api/login',
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                    password: password 
                },
                success: function(response) {
                    if(response.status == 'success') {
                        localStorage.setItem('token', response.token);
                        window.location.href = '/';
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
