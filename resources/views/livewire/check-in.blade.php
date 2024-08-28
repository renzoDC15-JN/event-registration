<div class="h-screen overflow-hidden">
    {{--checkin--}}
    <section x-data="{ digit1: '', digit2: '', digit3: '', digit4: '' }" class="flex flex-col justify-center mt-10 items-center py-0 bg-white h-screen ">
        <div class="flex relative flex-col items-center mt-20 px-20 pt-60 pb-96 max-w-full min-h-[982px] w-[946px] max-md:px-5 max-md:py-24">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9cfca25019f567a6b607ecc1288b6060ef076528820346e22e10c624352aa22c?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-cover absolute inset-0 size-full">

            <div class="flex relative flex-col mb-0 max-w-full w-[354px] max-md:mb-2.5">
                <header class="flex gap-5 justify-between">
                    <div class="flex flex-col w-full">
                        <div class="flex gap-5 justify-between text-4xl font-bold whitespace-nowrap text-slate-800">
                            <h1 class="self-start text-4xl font-bold text-slate-800">Checkin</h1>

                            <img @click="window.location.href = '/check-in/{{ $enc_id }}'" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dd315a8c1923850d884c4603fbfa362c832e218e5c4d18cf595cee51452de1e0?placeholderIfAbsent=true&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-contain shrink-0 self-start aspect-square w-[35px]" />
                        </div>
                        <p class="mt-2 text-xl self-start text-center text-slate-600 ">Enter your registered number</p>
                    </div>
                </header>
                <form wire:submit="submit" class="flex flex-col mt-28 w-full max-md:mt-10">
                    <div class="flex gap-1 items-start w-full mt-7">
                        <label for="attendee_mobile" class="text-base text-slate-600">Phone Number</label>
                        <span class="text-sm font-medium leading-none text-rose-700">*</span>
                    </div>
                    <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                        <label for="attendee_mobile" class="self-stretch my-auto text-sm leading-none text-gray-400">+63</label>
                        <input  x-on:input="validate($event)"
                                x-on:keypress="validate($event)"
                                x-on:paste="validate($event)" type="text" id="attendee_mobile" maxlength="10"  name="attendee_mobile" wire:model="attendee_mobile" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" required />
                    </div>
                    <div clas="flex gap-1 items-start w-full">
                        @error('attendee_mobile') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
                    </div>
{{--                    <div class="flex gap-3.5 justify-center items-center w-full">--}}
{{--                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="First digit"--}}
{{--                               x-model="digit1" x-ref="digit1" wire:model="digit1"--}}
{{--                               @input="$nextTick(() => {--}}
{{--           digit1 = digit1.toUpperCase();--}}
{{--           digit1 ? $refs.digit2.focus() : null;--}}
{{--       })"--}}
{{--                               @keydown.backspace="$nextTick(() => !digit1 ? $refs.digit1.blur() : null)">--}}

{{--                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Second digit"--}}
{{--                               x-model="digit2" x-ref="digit2" wire:model="digit2"--}}
{{--                               @input="$nextTick(() => {--}}
{{--           digit2 = digit2.toUpperCase();--}}
{{--           digit2 ? $refs.digit3.focus() : null;--}}
{{--       })"--}}
{{--                               @keydown.backspace="$nextTick(() => !digit2 ? $refs.digit1.focus() : null)">--}}

{{--                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Third digit"--}}
{{--                               x-model="digit3" x-ref="digit3" wire:model="digit3"--}}
{{--                               @input="$nextTick(() => {--}}
{{--           digit3 = digit3.toUpperCase();--}}
{{--           digit3 ? $refs.digit4.focus() : null;--}}
{{--       })"--}}
{{--                               @keydown.backspace="$nextTick(() => !digit3 ? $refs.digit2.focus() : null)">--}}

{{--                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Fourth digit"--}}
{{--                               x-model="digit4" x-ref="digit4" wire:model="digit4"--}}
{{--                               @input="$nextTick(() => {--}}
{{--           digit4 = digit4.toUpperCase();--}}
{{--           digit4 ? null : null;--}}
{{--       })"--}}
{{--                               @keydown.backspace="$nextTick(() => !digit4 ? $refs.digit3.focus() : null)">--}}

{{--                    </div>--}}
                    <button type="submit" class="mt-10 px-16 py-6 bg-pink-700 rounded-3xl border-solid border-[5px] border-rose-900 border-opacity-20 text-xl font-medium text-center text-white whitespace-nowrap max-md:px-5">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </section>
    {{--checkin end--}}
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
                        <tr >
                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Phone Number:</th>
                            <td class="text-xl font-bold text-green-500 py-4">{{$mobile}}</td>
                        </tr>
                        <tr >
                            <th class="text-base text-gray-600 w-[111px] text-left py-4">Table:</th>
                            <td class="text-xl font-bold text-green-500 py-4">{{$table}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <div class="mt-10 flex flex-col-reverse justify-center md:flex-row sm:space-y-4 md:space-y-0 lg:sm:space-y-0 ">
                    <button @click="isOpen = false" class="mr-1 xs:mt-1 md:mt-0 lg:mt-0 xl:mt-0 bg-pink-700 text-white rounded-3xl px-8 py-3 md:px-16 md:py-6 w-full md:w-auto">
                        Cancel
                    </button>
                    <button wire:click="confirm" class="bg-pink-700 text-white rounded-3xl px-8 py-3 md:px-16 md:py-6 w-full md:w-auto">
                        Confirm & Checkin
                    </button>
                </div>
            </div>
        </article>
    </section>
    <div x-data="{ isInvalid: @entangle('isInvalid') }">
        <!-- Modal container -->
        <div x-show="isInvalid" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="isInvalid = false">
            <!-- Modal content -->
            <section class="flex overflow-hidden flex-col justify-center px-4 py-10 mx-auto w-full text-xl text-center max-w-[480px] text-slate-800" @click.stop>
                <article class="flex flex-col px-11 pt-4 pb-7 bg-white rounded-3xl shadow-2xl">
                    @if ($status == 0)
                        <div id="lottie-container" class="object-contain self-start w-full aspect-[1.06]"></div>

                        <h2 class="text-2xl font-bold self-center w-full text-slate-800">
                            Invalid code please retry
                        </h2>
                    @elseif ($status == 1)
                        <header class="text-center">
                            <h1 class="text-2xl font-bold text-slate-800 md:text-4xl">Confirmed CheckedIn</h1>
                            <p class="mt-2 text-lg text-slate-600 md:text-xl">You may screenshot this page for the table assignment</p>
                        </header>
                        <div class="mt-10 md:mt-16">
                            <!-- Dynamic Attendee Information -->
                            <table class="w-full max-w-[546px] border-collapse">
                                <tbody>
                                <tr class="border-b border-gray-200">
                                    <th class="text-base text-gray-600 w-[111px] text-left py-4">Name:</th>
                                    <td class="text-xl font-bold text-green-500 py-4">{{$full_name}}</td>
                                </tr>
                                <tr >
                                    <th class="text-base text-gray-600 w-[111px] text-left py-4">Phone Number:</th>
                                    <td class="text-xl font-bold text-green-500 py-4">{{$mobile}}</td>
                                </tr>
                                <tr >
                                    <th class="text-base text-gray-600 w-[111px] text-left py-4">Table:</th>
                                    <td class="text-xl font-bold text-green-500 py-4">{{$table}}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    @endif

                    <!-- Optional close button inside the modal -->
                    <button @click="isInvalid = false" class="mt-5 px-4 py-2 bg-pink-700 text-white rounded-3xl">
                        Okay
                    </button>
                </article>
            </section>
        </div>
    </div>

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
    function loadLottieAnimation(jsonPath) {
        console.log(`Loading animation from path: ${jsonPath}`);
        lottie.loadAnimation({
            container: document.getElementById("lottie-container"), // the DOM element that will contain the animation
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: jsonPath // the path to the animation json
        });
    }
    window.addEventListener('trigger_animation', (e) => {
        loadLottieAnimation(@this.json_path);
    });
</script>
