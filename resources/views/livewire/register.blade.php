<div>
    {{-- Do your work, then step back. --}}
    <section class="flex overflow-hidden flex-col bg-white">
        <div class="flex relative flex-col justify-center items-center px-20 py-28 w-full min-h-[982px] max-md:px-5 max-md:py-24 max-md:max-w-full">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/a684c8edffc568bb78ed3c9e3271669f15a2bbb8e350a150343a981daf829b9c?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-cover absolute inset-0 size-full" />
            <div class="flex relative flex-col mb-0 max-w-full w-[355px] max-md:mb-2.5">
                <header class="flex flex-col w-full max-w-[354px]">
                    <div class="flex gap-5 justify-between text-4xl font-bold whitespace-nowrap text-slate-800">
                        <h1>Register</h1>
                        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dd315a8c1923850d884c4603fbfa362c832e218e5c4d18cf595cee51452de1e0?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-contain shrink-0 self-start aspect-square w-[35px]" />
                    </div>
                    <p class="self-start mt-2 text-xl text-slate-600">Fill-out the form</p>
                </header>
                <form wire:submit="submit" class="flex flex-col mt-9 w-full">
                    <div class="flex flex-col w-full">
                        <div class="flex gap-1 items-start w-full">
                            <label for="first_name" class="text-base text-slate-600">First Name</label>
                            <span class="text-sm font-medium leading-none text-rose-700">*</span>
                        </div>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900">
                            <input id="first_name" type="text" wire:model="first_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-3.5 w-full">
                        <div class="flex gap-1 items-start w-full">
                            <label for="last_name" class="text-base text-slate-600">Last Name</label>
                            <span class="text-sm font-medium leading-none text-rose-700">*</span>
                        </div>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                            <input id="last_name" type="text" wire:model="last_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-3.5 w-full">
                        <div class="flex gap-1 items-start w-full whitespace-nowrap">
                            <label for="company" class="text-base text-slate-600">Company</label>
                            <span class="text-sm font-medium leading-none text-rose-700">*</span>
                        </div>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900">
                            <input id="company" type="text" wire:model="company" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-3.5 w-full text-base">
                        <label for="job_title" class="gap-1 w-full text-slate-600">Job Title</label>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-gray-900">
                            <input id="job_title" type="text" wire:model="job_title" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-3.5 w-full text-base">
                        <label for="email" class="gap-1 w-full text-slate-600">Email Address</label>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-gray-900 whitespace-nowrap">
                            <input id="email" type="email" value="sample@email.com" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-5 w-full text-base">
                        <label for="phone" class="gap-1 w-full text-slate-600">Phone Number</label>
                        <div class="flex gap-2 items-center mt-1.5 w-full text-gray-900 whitespace-nowrap">
                            <input id="phone" type="tel" value="09478800962" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-9 w-full text-center rounded-3xl">
                        <p class="self-center text-lg text-slate-600">
                            By clicking, you agree to us collecting and using your information as outlined in our <a href="#" class="font-bold text-blue-800 underline">Privacy Policy.</a>
                        </p>
                        <button type="submit" class="px-16 py-6 mt-6 text-xl font-medium text-white whitespace-nowrap bg-pink-700 rounded-3xl border-solid border-[5px] border-rose-900 border-opacity-20 max-md:px-5">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
