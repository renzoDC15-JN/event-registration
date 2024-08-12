<section class="flex overflow-hidden flex-col pt-20 mx-auto w-full bg-white max-w-[480px]">
    <form id="vip-form" wire:submit="submit">
    <div class="flex flex-col px-5 w-full">
        <img loading="lazy" src="{{asset('images/Raemulan Lands Logo - with tagline 1.png')}}" alt="Event logo or banner" class="object-contain self-center w-full aspect-[2.22] max-w-[326px]" />
        <h1 wire:click="submit" class="self-start mt-11 text-2xl font-bold text-slate-800">{{$event_name}}</h1>
        <p class="self-start mt-2.5 text-xl text-slate-600">Event confirmation</p>
    </div>
    <div class="flex relative flex-col px-5 pt-6 pb-20 mt-1 w-full aspect-[0.961]">
        <img loading="lazy" src="{{asset('images/registration-bg.png')}}" alt="" class="object-cover absolute inset-0 size-full" />
        <div class="flex relative flex-col w-full">
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
            <div class="flex gap-1 items-start w-full">
                @error('selected_group') <span class="text-sm font-medium leading-none text-rose-700">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-1 items-start w-full mt-7">
                <label for="mobile" class="text-base text-slate-600">Phone Number</label>
                <span class="text-sm font-medium leading-none text-rose-700">*</span>
            </div>
            <div class="flex gap-2 items-center mt-1.5 w-full text-base text-gray-900 whitespace-nowrap">
                <label for="mobile" class="self-stretch my-auto text-sm leading-none text-gray-400">+63</label>
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
                      Thank you for your registration
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
            container: document.getElementById("lottie-container"),
            renderer: 'svg',
            loop: false,
            autoplay: true,
            path: jsonPath
        });
    }
    window.addEventListener('trigger_animation', (e) => {
        loadLottieAnimation(@this.json_path);
    });

</script>

