<div>
    {{--checkin--}}
    <section x-data="{ digit1: '', digit2: '', digit3: '', digit4: '' }" class="flex overflow-hidden flex-col justify-center items-center px-20 py-40 bg-white max-md:px-5 max-md:py-24">
        <div class="flex relative flex-col items-center px-20 pt-20 pb-56 max-w-full min-h-[677px] w-[573px] max-md:px-5 max-md:pb-24">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/d3989378be3a65f4eebf8886097a8cb4c3c669c13d49328b4218e1692af32875?apiKey=8596518292344287a6dbe083b6dc8023&&apiKey=8596518292344287a6dbe083b6dc8023" alt="" class="object-cover absolute inset-0 size-full">
            <div class="flex relative flex-col mb-0 max-w-full w-[354px] max-md:mb-2.5">
                <header class="flex gap-5 justify-between">
                    <div class="flex flex-col">
                        <h1 class="self-start text-4xl font-bold text-slate-800">Checkin</h1>
                        <p class="mt-2 text-xl text-center text-slate-600">Enter your 4-digit Code</p>
                    </div>
                </header>
                <form wire:submit="submit" class="flex flex-col mt-28 w-full max-md:mt-10">
                    <div class="flex gap-3.5 justify-center items-center w-full">
                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="First digit"
                               x-model="digit1" x-ref="digit1" wire:model="digit1"
                               @input="$nextTick(() => digit1 ? $refs.digit2.focus() : null)"
                               @keydown.backspace="$nextTick(() => !digit1 ? $refs.digit1.blur() : null)">
                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Second digit"
                               x-model="digit2" x-ref="digit2" wire:model="digit2"
                               @input="$nextTick(() => digit2 ? $refs.digit3.focus() : null)"
                               @keydown.backspace="$nextTick(() => !digit2 ? $refs.digit1.focus() : null)">
                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Third digit"
                               x-model="digit3" x-ref="digit3" wire:model="digit3"
                               @input="$nextTick(() => digit3 ? $refs.digit4.focus() : null)"
                               @keydown.backspace="$nextTick(() => !digit3 ? $refs.digit2.focus() : null)">
                        <input type="text" maxlength="1" class="flex shrink-0 self-stretch my-auto bg-orange-200 rounded-3xl h-[74px] w-[78px] text-center text-2xl" aria-label="Fourth digit"
                               x-model="digit4" x-ref="digit4" wire:model="digit4"
                               @input="$nextTick(() => digit4 ? null : null)"
                               @keydown.backspace="$nextTick(() => !digit4 ? $refs.digit3.focus() : null)">
                    </div>
                    <button type="submit" class="mt-10 px-16 py-6 bg-pink-700 rounded-3xl border-solid border-[5px] border-rose-900 border-opacity-20 text-xl font-medium text-center text-white whitespace-nowrap max-md:px-5">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </section>
    {{--checkin end--}}
    <section x-data="{ isOpen: @entangle('isOpen') }" class="flex overflow-hidden flex-col justify-center items-center px-20 py-48 bg-black bg-opacity-10 max-md:px-5 max-md:py-24">
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
            <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-[670px] mx-auto">
                <!-- Modal content -->
                <header class="text-center">
                    <h1 class="text-4xl font-bold text-slate-800">Confirm to Checkin</h1>
                    <p class="mt-2.5 text-xl text-slate-600">Please review the details for accuracy and confirm.</p>
                </header>

                <div class="mt-16">
                    <!-- Dynamic Attendee Information -->
                    <dl class="text-left">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Name:</dt>
                            <dd class="font-bold text-green-500">Charles Ley Baldemor</dd>
                        </div>
                        <div class="flex justify-between mt-5">
                            <dt class="text-gray-600">Company:</dt>
                            <dd class="font-bold text-green-500">Company ABC</dd>
                        </div>
                        <div class="flex justify-between mt-5">
                            <dt class="text-gray-600">Job Title:</dt>
                            <dd class="font-bold text-green-500">UXD Designer</dd>
                        </div>
                        <div class="flex justify-between mt-5">
                            <dt class="text-gray-600">Email:</dt>
                            <dd class="font-bold text-green-500">sample@email.com</dd>
                        </div>
                        <div class="flex justify-between mt-5">
                            <dt class="text-gray-600">Phone Number:</dt>
                            <dd class="font-bold text-green-500">09478800962</dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-16 flex justify-between">
                    <button @click="isOpen = false" class="bg-pink-700 text-white rounded-3xl px-16 py-6">
                        Cancel
                    </button>
                    <button class="bg-pink-700 text-white rounded-3xl px-16 py-6">
                        Confirm & Checkin
                    </button>
                </div>
            </div>
        </article>
    </section>
</div>
<script>
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
