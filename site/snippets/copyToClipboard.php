<button
  x-ref="copyToClipboardRef"
  class="leading-tight block font-serif text-sm all-small-caps text-center pt-1.5 overflow-hidden"
  x-data="copyToClipboard('<?= $copyText ?>')"
  @click="copyToClipboard"
>
  <?= $buttonText ?>
</button>