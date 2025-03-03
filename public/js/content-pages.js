document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.block-fields').forEach(function (blockFields) {
        const blockType = blockFields.getAttribute('data-block-type');
        const switchInput = document.querySelector(`input[name="${blockType}"]`);

        if (switchInput.checked) {
            blockFields.style.display = 'block';
        }

        if(blockType === 'hero') {
            blockFields.querySelector(`[name="${blockType}_text"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_text"]`).style.display = 'none';
        }

        if (blockType === 'text') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'quote') {
            blockFields.querySelector(`[name="${blockType}_text"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_text"]`).style.display = 'none';
            blockFields.querySelector(`[name="${blockType}_button_text"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_button_text"]`).style.display = 'none';
            blockFields.querySelector(`[name="${blockType}_button_link"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_button_link"]`).style.display = 'none';
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
            blockFields.querySelector(`[for="${blockType}_image"]`).style.display = 'none';
        }

        // if (blockType === 'text_image') {
        //     // blockFields.querySelector(`[name="${blockType}_button_text"]`).style.display = 'none';
        //     // blockFields.querySelector(`[for="${blockType}_button_text"]`).style.display = 'none';
        //     // blockFields.querySelector(`[name="${blockType}_button_link"]`).style.display = 'none';
        //     // blockFields.querySelector(`[for="${blockType}_button_link"]`).style.display = 'none';
        // }

        switchInput.addEventListener('change', function () {
            blockFields.style.display = this.checked ? 'block' : 'none';
            blockFields.style.border = this.checked ? '1px solid black' : 'none';
            blockFields.style.padding = this.checked ? '10px' : '0';
            blockFields.style.borderRadius = this.checked ? '10px' : '0';
        });
    });
});
