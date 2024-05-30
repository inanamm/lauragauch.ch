<div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }" 
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" 
    x-id="['dropdown-button']" 
    class="relative">

    <div class="lg:relative lg:inline-block fixed bottom-2.5 left-3 right-auto items-center lg:left-0  dark:text-white lg:rounded-none rounded-lg lg:px-0 align-left">
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="
            all-small-caps text-sm font-serif flex flex-col lg:underline-offset-2 lg:hover:underline lg:rounded-none rounded-lg z-40 lg:backdrop-filter-none backdrop-blur-sm px-2 lg:py-0 py-0.5 lg:bg-transparent bg-white/65 dark:bg-white/25 dark:lg:bg-transparent">
            Share this project
        </button>

        <div x-ref="panel" x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform lg:-translate-y-2"
            x-transition:enter-end="opacity-100 transform lg:translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform lg:translate-y-0"
            x-transition:leave-end="opacity-0 transform lg:-translate-y-2" 
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')" 
            class="lg:absolute lg:left-1/2 lg:transform lg:-translate-x-1/2 min-w-max flex flex-col w-full lg:bottom-auto lg:top-auto 2 absolute bottom-full mb-2 left-0 lg:bg-transparent bg-white/65 dark:bg-white/25 lg:rounded-none rounded-lg lg:px-0 px-2 lg:py-0 py-0.5 lg:backdrop-filter-none backdrop-blur-sm"
            style="display: none;">
            <?= $slot ?>
        </div>
    </div>

</div>
