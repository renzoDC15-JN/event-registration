<x-layouts.app>
    <section class="flex overflow-hidden flex-col items-center px-20 pt-52 pb-80 text-center bg-white max-md:px-5 max-md:py-24">
        <figure class="flex flex-col max-w-full w-[500px]">
            <img
                src="{{asset('images/Raemulan Lands Logo - with tagline 1.png')}}"
                class="object-contain self-center max-w-full aspect-[2.21] w-[310px]"
                alt="Descriptive text about the image"
                loading="lazy"
            />
            <figcaption class="sr-only">Caption for the image if necessary</figcaption>
            <div class="flex flex-col mt-24 max-md:mt-10 max-lg:mt-10 w-full">
                <!-- Checkin Button -->
                <a href="/check-in-code" class="flex flex-col justify-center px-32 py-5 w-full text-white bg-pink-700 rounded-3xl min-h-[95px] max-md:px-5 cursor-pointer hover:bg-pink-600 transition-colors">
                    <div class="flex flex-col w-full">
                        <h2 class="text-2xl font-medium">Check In</h2>
                        <p class="self-center mt-1 text-lg">For Pre-registered Attendees</p>
                    </div>
                </a>
                <!-- Register Button -->
                <a href="/register" class="flex flex-col justify-center px-32 py-5 mt-8 w-full rounded-3xl border-solid bg-amber-400 bg-opacity-0 border-[3px] border-black border-opacity-30 min-h-[95px] max-md:px-5 cursor-pointer hover:bg-opacity-100 hover:bg-amber-500 hover:border-opacity-50 transition-colors">
                    <div class="flex flex-col w-full">
                        <h2 class="text-2xl font-medium text-slate-800">Register</h2>
                        <p class="self-center mt-1 text-lg text-slate-600">For Walk-in Attendees</p>
                    </div>
                </a>
            </div>
        </figure>
    </section>
</x-layouts.app>
