<div class="h-[1100px] overflow-hidden">
    {{-- Do your work, then step back. --}}
    <section class="flex overflow-hidden flex-col bg-white">
        <div class="flex relative flex-col justify-center items-center px-20 py-28 w-full min-h-[982px] max-md:px-5 max-md:py-24 max-md:max-w-full">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/a684c8edffc568bb78ed3c9e3271669f15a2bbb8e350a150343a981daf829b9c?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-cover absolute inset-0 size-full" />
            <div class="flex relative flex-col mb-0 max-w-full w-[355px] max-md:mb-2.5">
                <header class="flex flex-col w-full max-w-[354px]">
                    <div class="flex gap-5 justify-between text-4xl font-bold whitespace-nowrap text-slate-800">
                        <h1>Register</h1>
                        <img @click="history.back()" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dd315a8c1923850d884c4603fbfa362c832e218e5c4d18cf595cee51452de1e0?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-contain shrink-0 self-start aspect-square w-[35px]" />
                    </div>
                    <p class="self-start mt-2 text-xl text-slate-600">Fill-out the form</p>
                </header>
                <form wire:submit="submit" class="flex flex-col mt-9 w-full">
                    <div class="flex gap-1 items-start w-full">
                        <label for="full_name" class="text-base text-slate-600">Full Name</label>
                        <span class="text-sm font-medium leading-none text-rose-700">*</span>
                    </div>
                    <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap  border-black">
                        <input placeholder="First Name Mi. Last Name" type="text" id="full_name" name="full_name"  wire:model="full_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" required />
                    </div>
                    <div clas="flex gap-1 items-start w-full">
                        @error('full_name') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex gap-1 items-start w-full mt-7">
                        <label for="group" class="text-base text-slate-600">Group</label>
                        <span class="text-sm font-medium leading-none text-rose-700">*</span>
                    </div>
                    <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900  min-w relative overflow-visible">
                        {{--                <select id="group" name="group" wire:model="selected_group"--}}
                        {{--                        class="w-full flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto bg-white rounded-lg shadow-sm relative z-10">--}}
                        {{--                    <option value="">Select Group</option>--}}
                        {{--                    @foreach($groups as $group)--}}
                        {{--                        <option value="{{ $group->code }}">{{ $group->description }}</option>--}}
                        {{--                    @endforeach--}}
                        {{--                </select>--}}
                        <div class="flex-1 shrink gap-2.5 self-stretch  my-auto w-full bg-white rounded-lg  border border-black">
                            <div
                                x-data="{
            open: false,
            selected: '',
            toggle() {
                if (this.open) {
                    return this.close()
                }
                this.$refs.button.focus()
                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return
                this.open = false
                focusAfter && focusAfter.focus()
            },
            selectOption(value, label) {
                this.selected = label
                this.$refs.hiddenInput.value = value
                this.close(this.$refs.button)
                @this.set('selected_group', value) // Sync with Livewire
            }
        }"
                                x-on:keydown.escape.prevent.stop="close($refs.button)"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']"
                                class="relative w-full"
                            >
                                <!-- Hidden input to store the value -->
                                <input type="hidden" x-ref="hiddenInput" name="group" id="group" />

                                <!-- Button -->
                                <button
                                    x-ref="button"
                                    x-on:click="toggle()"
                                    :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')"
                                    type="button"
                                    class="flex items-center justify-between w-full bg-white px-5 py-2.5 rounded-lg shadow-sm"
                                >
                                    <span x-text="selected || 'Select Group'"></span>
                                    <!-- Heroicon: chevron-down -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Panel -->
                                <div
                                    x-ref="panel"
                                    x-show="open"
                                    x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)"
                                    :id="$id('dropdown-button')"
                                    style="display: none;"
                                    class="absolute left-0 mt-2 w-full rounded-md bg-white shadow-md z-20"
                                >
                                    @foreach($groups as $group)
                                        <a href="#"
                                           x-on:click.prevent="selectOption('{{ $group->code }}', '{{ $group->description }}')"
                                           class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50"
                                        >
                                            {{ $group->description }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
{{--                    <div class="flex flex-col w-full">--}}
{{--                        <div class="flex gap-1 items-start w-full">--}}
{{--                            <label for="first_name" class="text-base text-slate-600">First Name</label>--}}
{{--                            <span class="text-sm font-medium leading-none text-rose-700">*</span>--}}
{{--                        </div>--}}
{{--                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900">--}}
{{--                            <input id="first_name" type="text" wire:model="first_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />--}}
{{--                        </div>--}}
{{--                        <div clas="flex gap-1 items-start w-full">--}}
{{--                            @error('first_name') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="flex flex-col mt-3.5 w-full">--}}
{{--                        <div class="flex gap-1 items-start w-full">--}}
{{--                            <label for="last_name" class="text-base text-slate-600">Last Name</label>--}}
{{--                            <span class="text-sm font-medium leading-none text-rose-700">*</span>--}}
{{--                        </div>--}}
{{--                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">--}}
{{--                            <input id="last_name" type="text" wire:model="last_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />--}}
{{--                        </div>--}}
{{--                        <div clas="flex gap-1 items-start w-full">--}}
{{--                            @error('last_name') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="flex flex-col mt-3.5 w-full">--}}
{{--                        <div class="flex gap-1 items-start w-full whitespace-nowrap">--}}
{{--                            <label for="company" class="text-base text-slate-600">Company</label>--}}
{{--                            <span class="text-sm font-medium leading-none text-rose-700">*</span>--}}
{{--                        </div>--}}
{{--                        <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900">--}}
{{--                            <input id="company" type="text" wire:model="company" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />--}}
{{--                        </div>--}}
{{--                        <div clas="flex gap-1 items-start w-full">--}}
{{--                            @error('company') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="flex flex-col mt-3.5 w-full text-base">--}}
{{--                        <label for="job_title" class="gap-1 w-full text-slate-600">Job Title</label>--}}
{{--                        <div class="flex gap-2 items-center mt-1.5 w-full text-gray-900">--}}
{{--                            <input id="job_title" type="text" wire:model="job_title" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />--}}
{{--                        </div>--}}
{{--                        <div clas="flex gap-1 items-start w-full">--}}
{{--                            @error('job_title') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="flex flex-col mt-3.5 w-full text-base">--}}
{{--                        <label for="email" class="gap-1 w-full text-slate-600">Email Address</label>--}}
{{--                        <div class="flex gap-2 items-center mt-1.5 w-full text-gray-900 whitespace-nowrap">--}}
{{--                            <input id="email" type="email" wire:model="email" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg border border-gray-300 border-solid shadow-sm min-w-[240px]" />--}}
{{--                        </div>--}}
{{--                        <div clas="flex gap-1 items-start w-full">--}}
{{--                            @error('email') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="flex gap-1 items-start w-full mt-7">
                        <label for="mobile" class="text-base text-slate-600">Phone Number</label>
                    </div>
                    <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                        <label for="mobile" class="self-stretch my-auto text-sm leading-none text-gray-400">+63</label>
                        <input  x-on:input="validate($event)"
                                x-on:keypress="validate($event)"
                                x-on:paste="validate($event)" type="text" id="mobile" maxlength="10"  name="mobile" wire:model="mobile" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" />
                    </div>
                    <div clas="flex gap-1 items-start w-full">
                        @error('mobile') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col mt-9 w-full text-center rounded-3xl">
                        <p class="self-center text-lg text-slate-600">
                            By clicking, you agree to us collecting and using your information as outlined in our <a href="/privacy-policy" class="font-bold text-blue-800 underline">Privacy Policy.</a>
                        </p>

                        <button type="submit" class="px-16 py-6 mt-6 text-xl font-medium text-white whitespace-nowrap bg-pink-700 rounded-3xl border-solid border-[5px] border-rose-900 border-opacity-20 max-md:px-5">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section x-data="{ isOpen: @entangle('isOpen') }" class="flex flex-col justify-center items-center px-5 py-24 md:px-20 md:py-48 bg-black bg-opacity-10 h-screen">
        <article
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed inset-0 z-50 flex justify-center items-center"
            @click.away="isOpen = false"
            x-cloak
        >
            <div class="bg-white rounded-3xl shadow-2xl p-5 md:p-12 max-w-[570px] min-w-[300px] w-full mx-auto">
                <!-- Modal content -->
                <header class="text-center">
                    <h1 class="text-2xl font-bold text-slate-800 md:text-4xl">Confirm to Checkin</h1>
                    <p class="mt-2 text-lg text-slate-600 md:text-xl">Please review the details for accuracy and confirm.</p>
                </header>

                <div class="mt-10 md:mt-16">
                    <!-- Dynamic Attendee Information -->
                    <table class="w-full max-w-[546px] border-collapse">
                        <tbody>
                        <tr class="border-b border-gray-200">
                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Name:</th>
                            <td class="text-xl font-bold text-green-500 py-4">{{$full_name}}</td>
                        </tr>
{{--                        <tr class="border-b border-gray-200">--}}
{{--                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Company:</th>--}}
{{--                            <td class="text-xl font-bold text-green-500 py-4">{{$company}}</td>--}}
{{--                        </tr>--}}
{{--                        <tr class="border-b border-gray-200">--}}
{{--                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Job Title:</th>--}}
{{--                            <td class="text-xl font-bold text-green-500 py-4">{{$job_title}}</td>--}}
{{--                        </tr>--}}
{{--                        <tr class="border-b border-gray-200">--}}
{{--                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Email:</th>--}}
{{--                            <td class="text-xl font-bold text-green-500 py-4">{{$email}}</td>--}}
{{--                        </tr>--}}
                        <tr  class="border-b border-gray-200">
                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Phone Number:</th>
                            <td class="text-xl font-bold text-green-500 py-4">{{$mobile}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Code:</th>--}}
{{--                            <td class="text-xl font-bold text-green-500 py-4">{{$code}}</td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>

                <div class="mt-10 flex flex-col-reverse justify-center md:flex-row sm:space-y-4 md:space-y-0 lg:sm:space-y-0 ">
                    <section class="flex flex-col text-xl font-medium text-center text-white rounded-none max-w-[326px]">
                        <button @click="isOpen = false" type="submit" class="flex flex-row gap-7 items-center px-7 py-4 bg-pink-700 rounded-3xl border-solid border-[5px] border-rose-900 border-opacity-20">
                            <h2 class="grow shrink my-auto w-auto text-white">Confirm & Checkin</h2>
                            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/707b0d6e538eb0719648b308c439f34b456f3262ce658f4a1ae6778c09e140ee?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023"
                                 class="object-contain shrink-0 self-end aspect-square"
                                 alt="Confirm and Checkin icon" />
                        </button>
                    </section>
{{--                    <button  class="mr-1 xs:mt-1 md:mt-0 lg:mt-0 xl:mt-0 bg-pink-700 text-white rounded-3xl px-8 py-3 md:px-16 md:py-6 w-full md:w-auto">--}}
{{--                        Ok--}}
{{--                    </button>--}}
                </div>
            </div>
        </article>
    </section>

</div>
<script>
    function validate(event) {
        var theEvent = event || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            var key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }

        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
