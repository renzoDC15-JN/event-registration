<section class="flex overflow-hidden flex-col pt-20 mx-auto w-full bg-white max-w-[480px]">
    <form wire:submit="submit">
    <div class="flex flex-col px-5 w-full">
        <img loading="lazy" src="{{asset('images/Raemulan Lands Logo - with tagline 1.png')}}" alt="Event logo or banner" class="object-contain self-center w-full aspect-[2.22] max-w-[326px]" />
        <h1 wire:click="submit" class="self-start mt-11 text-2xl font-bold text-slate-800">Event Name</h1>
        <p class="self-start mt-2.5 text-xl text-slate-600">Event confirmation</p>
        <div class="flex flex-col mt-11 w-full">
            <div class="flex gap-1 items-start w-full">
                <label for="first_name" class="text-base text-slate-600">First Name</label>
                <span class="text-sm font-medium leading-none text-rose-700">*</span>
            </div>
            <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                <input type="text" id="first_name" name="first_name" wire:model="first_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" required />
            </div>
            <div clas="flex gap-1 items-start w-full">
                @error('first_name') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="flex relative flex-col px-5 pt-6 pb-20 mt-1 w-full aspect-[0.961]">
        <img loading="lazy" src="{{asset('images/registration-bg.png')}}" alt="" class="object-cover absolute inset-0 size-full" />
        <div class="flex relative flex-col w-full">
            <div class="flex gap-1 items-start w-full">
                <label for="last_name" class="text-base text-slate-600">Last Name</label>
                <span class="text-sm font-medium leading-none text-rose-700">*</span>
            </div>
            <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                <input type="text" id="last_name" name="last_name"  wire:model="last_name" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" required />
            </div>
            <div clas="flex gap-1 items-start w-full">
                @error('last_name') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-1 items-start w-full mt-7">
                <label for="mobile" class="text-base text-slate-600">Phone Number</label>
                <span class="text-sm font-medium leading-none text-rose-700">*</span>
            </div>
            <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                <label for="phoneInput" class="self-stretch my-auto text-sm leading-none text-gray-400">+63</label>
                <input  x-on:input="validate($event)"
                        x-on:keypress="validate($event)"
                        x-on:paste="validate($event)" type="text" id="mobile" maxlength="10"  name="mobile" wire:model="mobile" class="flex-1 shrink gap-2.5 self-stretch px-3.5 py-2.5 my-auto w-full bg-white rounded-lg shadow-sm min-w-[240px]" required />
            </div>
            <div clas="flex gap-1 items-start w-full">
                @error('mobile') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="relative px-16 py-6 mt-20 text-xl font-medium text-center text-white whitespace-nowrap bg-pink-700 rounded-3xl">
                Verify
            </button>
        </div>
    </div>
    </form>
    <div x-data="{ isOpen: @entangle('isOpen'), status: @entangle('status') }">
        <div x-show="isOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="isOpen = false">
            <section class="flex overflow-hidden flex-col justify-center px-4 py-10 mx-auto w-full text-xl text-center max-w-[480px] text-slate-800" @click.stop>
                <article class="flex flex-col px-11 pt-4 pb-7 bg-white rounded-3xl shadow-2xl">
                    <div id="lottie-container" class="object-contain self-start w-full aspect-[1.06]"></div>

                    @if($status==1)
                        <h2 class="text-2xl font-bold self-center w-full text-slate-800">
                            Registration Successful
                        </h2>
                    <p class="mt-7" >
                        We have sent you a <br />
                        <span class="font-bold">4-digit code</span> for your registered registration number. Please use this code to check in during the event.
                    </p>
                    @elseif($status==0)
                        <h2 class="text-2xl font-bold self-center w-full text-slate-800">
                            No Data Found
                        </h2>
                        <p class="mt-7" >
                            Apologies, but your details is not on the VIP Guest list.
                        </p>
                    @endif

                </article>
            </section>
        </div>
    </div>
</section>
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

