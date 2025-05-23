<x-custom-layout>
    <x-slot name="wheader">
        <x-wheader /> <!-- Use the header component -->
    </x-slot>

    <x-slot name="main">
        <main>
            <div class="relative">
                <img alt="Background image related to voting, such as a ballot box or voting booth in black and white" class="w-full h-72 object-cover" height="300" src="https://storage.googleapis.com/a1aa/image/vScQEub-a5zB0tNl331wQZ2I2BJ-Zpjid1P3ineWGUc.jpg" width="1920"/>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white bg-black bg-opacity-50">
                    <h1 class="text-4xl font-bold text-white">
                        User Feedback
                    </h1>
                    <nav class="mt-2">
                        <a class="text-white text-xs" href="#">
                            Home
                        </a>
                        <span class="mx-2 text-xs text-white">
                    &gt;
                </span>
                        <a class="text-white text-xs" href="#">
                            Feedback
                        </a>
                    </nav>
                </div>
            </div>
            <div class="py-12">
                <div class="container mx-auto px-4">
                    <h2 class="text-xl font-bold text-center mb-4 text-black">
                        We Value Your Feedback
                    </h2>
                    <p class="text-center text-gray-600 mb-8 text-[12px]">
                        Please provide your feedback on our online voting system. Your input helps us improve and serve you better.
                    </p>
                    <div class="flex flex-col lg:flex-row justify-center text-center sm:text-left items-center sm:items-start lg:space-x-12">

                        <div class="lg:w-1/3 mb-8 lg:mb-0 sm:ml-10 ">
                            <div class="mb-6">
                                <div class="mb-4 flex flex-col lg:flex-row items-center lg:items-start">
                                    <svg
                                        class="mr-4 w-7 h-7 text-black"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 2C8.13 2 5 5.13 5 9c0 3.87 7 11 7 11s7-7.13 7-11c0-3.87-3.13-7-7-7z"
                                        />
                                        <circle cx="12" cy="9" r="2" />
                                    </svg>
                                    <div>
                                        <h2 class="text-xl font-semibold" style="font-size: 14px;">Address</h2>
                                        <p style="font-size: 12px;">Apokon, Tagum City, Davao Del Norte</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <div class="mb-4 flex flex-col lg:flex-row items-center lg:items-start">
                                    <svg class="mr-4 w-7 h-7 text-black"
                                         xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                        <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                                    </svg>
                                    <div>
                                        <h2 class="text-xl font-semibold" style="font-size: 14px;">Email Us</h2>
                                        <p style="font-size: 12px;">tsccomelec@usep.edu.ph</p>
                                    </div>
                                </div>
                            </div>


                            <hr class="border-t border-gray-300 mb-2 w-3/4 mx-auto lg:mx-0">
                        </div>
                        <div class="lg:w-1/2 w-full px-4">
                            <livewire:feedback-form/>
                            <p class="text-center text-gray-600 mt-4 text-[10px]">
                                The data gathered through this platform will be handled in accordance with RA 10173 or the Data Privacy Act of 2012, as well as the Data Privacy Policy of USEP, and will be utilized only for the intended purpose.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>



    </x-slot>

    <x-slot name="wfooter">
        <x-wfooter /> <!-- Use the footer component -->
    </x-slot>

</x-custom-layout>


