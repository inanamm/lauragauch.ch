<button
  x-ref="copyToClipboardRef"
  class="font-serif text-sm all-small-caps lg:text-center text-left hover:underline lg:hover:underline lg:underline-offset-2"
  x-data="copyToClipboard('<?= $copyText ?>')"
  @click="copyToClipboard"
>
  <?= $buttonText ?>
</button>