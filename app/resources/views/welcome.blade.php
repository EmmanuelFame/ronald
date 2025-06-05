<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ronaldcharge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the network-like background */
        body {
            background: linear-gradient(to bottom right, #1a202c, #0a0a0a);
            min-height: 100vh;
            font-family: "Inter", sans-serif; /* Using Inter font */
            display: flex;
            flex-direction: column;
        }

        /* Styling for the network background effect (simplified for static HTML) */
        .network-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at center, rgba(38, 100, 192, 0.1) 1px, transparent 1px),
                              linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.3;
            z-index: -1;
        }

        /* Ensure the main content takes remaining height */
        .main-content {
            flex-grow: 1;
            position: relative; /* For the network background */
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="network-background"></div>

    <nav class="flex flex-col sm:flex-row justify-between items-center p-4 bg-gray-900 text-white rounded-lg m-4 shadow-lg">
    <div class="flex items-center space-x-2 mb-4 sm:mb-0">
        <div class="flex items-center justify-center w-10 h-10 bg-blue-600 rounded-full shadow-md">
            <span class="font-bold text-xl">R</span>
        </div>
        <span class="font-bold text-xl text-blue-400">Ronaldcharge</span>
    </div>

    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4">
        {{-- Recharge = Home --}}
        <a href="{{ route('recharge') }}" class="flex items-center space-x-1 px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.832 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.832-1.573l7-10a1 1 0 011.13-.381z" clip-rule="evenodd" />
            </svg>
            <span>Recharge</span>
        </a>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-1 px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <span>Dashboard</span>
        </a>

        {{-- Login --}}
        <a href="{{ route('login') }}" class="flex items-center space-x-1 px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span>Login</span>
        </a>
    </div>
</nav>


    <header class="main-content flex items-center justify-center p-8 text-center">
        <div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 text-blue-400 drop-shadow-lg">
                Instant Recharge, Anytime, Anywhere
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8">
                Top up your mobile, data, and other services quickly and securely with Ronaldcharge.
                Experience seamless transactions and never run out of balance again!
            </p>
            <div class="flex justify-center space-x-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-xl transition-all duration-300 transform hover:scale-105">
                    Buy Recharge Now
                </button>
                <button class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow-xl transition-all duration-300 transform hover:scale-105">
                    How It Works
                </button>
            </div>
        </div>
    </header>

    <section id="contact" class="py-16 px-4 bg-gray-800 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 text-blue-400">Get in Touch</h2>
            <p class="text-lg text-gray-300 mb-12">
                Have questions or need support? Feel free to reach out to us!
            </p>
            <div class="flex flex-col md:flex-row justify-center items-start md:space-x-8 space-y-8 md:space-y-0">
                <div class="bg-gray-900 p-8 rounded-lg shadow-xl w-full md:w-1/2 text-left">
                    <h3 class="text-2xl font-semibold mb-4 text-white">Contact Info</h3>
                    <p class="mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@ronaldcharge.com</span>
                    </p>
                    <p class="mb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                        </svg>
                        <span>+7 952 6267 287</span>
                    </p>
                    <p class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Ufa, Bashkortostostan, RU</span>
                    </p>
                </div>

               <form action="{{ route('contact.submit') }}" method="POST" class="bg-gray-900 p-8 rounded-lg shadow-xl w-full md:w-1/2">
                    @csrf
                    @if(session('success'))
                        <div class="mt-4 p-4 bg-green-600 text-white rounded shadow">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-2xl font-semibold mb-4 text-white">Send Us a Message</h3>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-300 text-sm font-bold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600" placeholder="Your Name">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-300 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600" placeholder="your@example.com">
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-300 text-sm font-bold mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600" placeholder="Your message..."></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-xl transition-all duration-300 transform hover:scale-105">
                        Send Message
                    </button>
                </form>

            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 px-4 mt-auto rounded-t-lg shadow-inner">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-4 md:mb-0">
                <p>&copy; 2023 Ronaldcharge. All rights reserved.</p>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-blue-400 transition-colors duration-300">Privacy Policy</a>
                <a href="#" class="hover:text-blue-400 transition-colors duration-300">Terms of Service</a>
            </div>
        </div>
    </footer>
</body>
</html>
