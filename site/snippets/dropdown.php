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
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']" class="relative">

    <div class="lg:relative lg:inline-block fixed bottom-2.5 left-3 right-auto items-center
">
        <button x-ref="button" x-on:click="toggle()" :aria-expanded="open" :aria-controls="$id('dropdown-button')"
            type="button" class="
            all-small-caps text-sm font-serif
            lg:flex 
            lg:underline-offset-2
            lg:hover:underline 
            lg:rounded-none rounded-lg
            lg:bg-transparent bg-white/65 dark:bg-white/25 dark:lg:bg-transparent dark:text-white
            px-2 lg:p-0 py-0.5
            lg:backdrop-filter-none backdrop-blur-sm 
            z-40 
    ">
            Share this project
        </button>

        <div x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')" class="lg:absolute lg:left-1/2 lg:transform lg:-translate-x-1/2 min-w-max lg:flex lg:flex-col -translate-y-16"
            style="display: none;">
            <?= $slot ?>
        </div>
    </div>

</div>