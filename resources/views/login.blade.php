<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>

        <form action="#" method="POST" class="space-y-5">
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none">
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center text-sm text-gray-600">
                    <input type="checkbox" class="form-checkbox rounded text-purple-500">
                    <span class="ml-2">Remember me</span>
                </label>
                <a href="#" class="text-sm text-purple-600 hover:underline">Forgot Password?</a>
            </div>

            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? <a href="#" class="text-purple-600 hover:underline">Sign up</a>
        </p>
    </div>

</body>

</html>