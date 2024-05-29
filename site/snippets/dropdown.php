<div
  x-data="{
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
  class="relative"
>
  <button
    x-ref="button"
    x-on:click="toggle()"
    :aria-expanded="open"
    :aria-controls="$id('dropdown-button')"
    type="button"
    class="flex items-center gap-2 px-5 py-2.5"
  >
    Toggle me
  </button>

  <div
    x-ref="panel"
    x-show="open"
    x-transition.origin.top.left
    x-on:click.outside="close($refs.button)"
    :id="$id('dropdown-button')"
    style="display: none;"
    class="absolute left-0 mt-2 w-40 flex flex-col gap-2"
  >
    <?= $slot ?>
  </div>
</div>