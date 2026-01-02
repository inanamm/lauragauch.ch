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

    <div class="fixed bottom-2.5 left-3 right-auto items-center rounded-lg lg:inline-block lg:relative lg:left-0 lg:px-0 lg:rounded-none dark:text-white align-left">
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="flex z-40 flex-col py-0.5 px-2 font-serif text-sm rounded-lg lg:py-0 lg:bg-transparent lg:rounded-none all-small-caps backdrop-blur-xs bg-white/65 cursor-crosshair lg:underline-offset-2 lg:hover:underline lg:backdrop-filter-none dark:bg-white/25 dark:lg:bg-transparent">
            share this project
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
            class="flex absolute left-0 bottom-full flex-col py-0.5 px-2 mb-2 w-full min-w-max rounded-lg lg:absolute lg:top-auto lg:bottom-auto lg:left-1/2 lg:py-0 lg:px-0 lg:bg-transparent lg:rounded-none lg:transform lg:-translate-x-1/2 2 bg-white/65 backdrop-blur-xs lg:backdrop-filter-none dark:bg-white/25"
            style="display: none;">
            <?= $slot ?>
        </div>
    </div>

</div>
