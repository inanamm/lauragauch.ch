<button
  x-ref="copyToClipboardRef"
  class="font-serif text-sm text-left lg:text-center hover:underline all-small-caps cursor-crosshair lg:hover:underline lg:underline-offset-2"
  x-data="copyToClipboard('<?= $copyText ?>')"
  @click="copyToClipboard"
>
  <?= $buttonText ?>
</button>