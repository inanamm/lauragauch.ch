<div class="flex justify-center">
    <div class="relative">
        <!-- Button -->
        <button id="dropdownButton" aria-expanded="false" aria-controls="dropdownPanel" type="button"
            class="leading-tight font-serif text-sm all-small-caps overflow-hidden hover:underline relative left-auto right-auto transition ease-in-out">
            Share this project
        </button>

        <!-- Panel -->
        <ul id="dropdownPanel"
            class="absolute min-w-max transition-transform transform origin-top font-serif text-sm all-small-caps overflow-hidden right-auto lg:p-0 py-0.5 backdrop-blur-sm lg:backdrop-blur-0 ease-in-out grow"
            style="display: none;">
            <li class="text-center pt-1">
                <a href="mailto:?subject=Check%20out%20this%20awesome%20thing&body=Here%20is%20the%20link%20to%20share%3A%20https%3A%2F%2Fexample.com"
                    class="text-sm">Share via Email</a>
            </li>
            <li class="text-center pt-1">
                <a href="https://www.instagram.com/" class="text-sm">Share on Instagram</a>
            </li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownPanel = document.getElementById('dropdownPanel');

        function toggleDropdown() {
            const isOpen = dropdownButton.getAttribute('aria-expanded') === 'true';

            dropdownButton.setAttribute('aria-expanded', !isOpen);
            dropdownPanel.style.display = isOpen ? 'none' : 'block';

            if (!isOpen) {
                setTimeout(() => {
                    dropdownPanel.classList.remove('scale-95', 'opacity-0');
                    dropdownPanel.classList.add('scale-100', 'opacity-100');
                }, 0);
            } else {
                dropdownPanel.classList.remove('scale-100', 'opacity-100');
                dropdownPanel.classList.add('scale-95', 'opacity-0');
            }
        }

        function closeDropdown() {
            dropdownButton.setAttribute('aria-expanded', 'false');
            dropdownPanel.style.display = 'none';
            dropdownPanel.classList.remove('scale-100', 'opacity-100');
            dropdownPanel.classList.add('scale-95', 'opacity-0');
        }

        dropdownButton.addEventListener('click', toggleDropdown);

        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownPanel.contains(event.target)) {
                closeDropdown();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeDropdown();
            }
        });
    });

</script>