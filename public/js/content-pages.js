document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.block-fields').forEach(function (blockFields) {
        const blockType = blockFields.getAttribute('data-block-type');
        const switchInput = document.querySelector(`input[name="${blockType}"]`);

        if (switchInput.checked) {
            blockFields.style.display = 'block';
        }

        if(blockType === 'hero') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'text') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'testimonial') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'cta') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'text_image') {
            blockFields.querySelector(`[name="${blockType}_image"]`).style.display = 'none';
        }

        if (blockType === 'gallery') {
            blockFields.querySelector(`[name="${blockType}_image"]`).setAttribute('multiple', 'true');
        }

        switchInput.addEventListener('change', function () {
            blockFields.style.display = this.checked ? 'block' : 'none';
        });
    });
});
