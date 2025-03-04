document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.block-fields').forEach(blockFields => {
        const blockType = blockFields.dataset.blockType;
        const switchInput = document.querySelector(`input[name="${blockType}"]`);

        if (switchInput.checked) blockFields.style.display = 'block';

        const elementsToHide = {
            hero: ['_text'],
            text: ['_image'],
            quote: ['_text', '_button_text', '_button_link', '_image']
        };

        (elementsToHide[blockType] || []).forEach(suffix => {
            blockFields.querySelector(`[name="${blockType}${suffix}"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}${suffix}"]`).style.display = 'none';
        });

        switchInput.addEventListener('change', function () {
            blockFields.style.display = this.checked ? 'block' : 'none';
            blockFields.style.border = this.checked ? '1px solid black' : 'none';
            blockFields.style.padding = this.checked ? '10px' : '0';
            blockFields.style.borderRadius = this.checked ? '10px' : '0';
        });
    });
});
