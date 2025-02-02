document.addEventListener('DOMContentLoaded', function () {
    setupFieldVisibility();
});

document.addEventListener('change', function (e) {
    if (e.target.classList.contains('block-type')) {
        setupFieldVisibility();
    }
});

document.getElementById('add-block').addEventListener('click', function() {
    const blocks = document.getElementById('blocks');
    const index = blocks.children.length;
    const block = document.createElement('div');
    block.classList.add('block', 'p-4', 'border', 'border-gray-300', 'rounded-md');
    block.innerHTML = `
                <select name="blocks[${index}][type]" class="form-control block-type w-full border-gray-300 rounded-md shadow-sm">
                    <option value="TEXT">Text</option>
                    <option value="TEXT_IMAGE">Text Image</option>
                    <option value="QUOTE">Quote</option>
                    <option value="CTA">Call to Action</option>
                    <option value="NEW_ITEMS">New Items</option>
                    <option value="HERO">Hero</option>
                </select>
                <input type="text" name="blocks[${index}][title]" placeholder="Block Title" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm">
                <textarea name="blocks[${index}][content]" placeholder="Block Content" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                <input type="text" name="blocks[${index}][image]" placeholder="Image URL" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-image">
                <input type="text" name="blocks[${index}][button_link]" placeholder="Button Link" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-button-link">
                <input type="text" name="blocks[${index}][link_text]" placeholder="Link Text" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-link-text">
                <input type="text" name="blocks[${index}][background_color]" placeholder="Background Color" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-background-color">
                <input type="text" name="blocks[${index}][author]" placeholder="Author" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-author">
            `;
    blocks.appendChild(block);
    setupFieldVisibility();
});

function setupFieldVisibility() {
    const blocks = document.getElementById('blocks');
    if (!blocks) return;

    const blockInputs = blocks.querySelectorAll('.block');
    blockInputs.forEach(function (block) {
        const typeField = block.querySelector('[name$="[type]"]');
        if (typeField && typeField.value) {
            handleTypeChange(typeField);
        }
    });
}

function handleTypeChange(typeField) {
    const block = typeField.closest('.block');
    const type = typeField.value;
    const fields = block.querySelectorAll('.block-field');
    fields.forEach(field => field.style.display = 'none');

    if (type === 'TEXT_IMAGE' || type === 'CTA' || type === 'HERO') {
        block.querySelector('.block-field-image').style.display = 'block';
    }
    if (type === 'CTA' || type === 'TEXT') {
        block.querySelector('.block-field-button-link').style.display = 'block';
        block.querySelector('.block-field-link-text').style.display = 'block';
    }
    if (type === 'CTA' || type === 'HERO') {
        block.querySelector('.block-field-background-color').style.display = 'block';
    }
    if (type === 'TESTIMONIAL') {
        block.querySelector('.block-field-author').style.display = 'block';
        block.querySelector('.block-field-site-link').style.display = 'block';
    }
    if (type === 'NEW_ITEMS') {
        block.querySelector('.block-field-amount').style.display = 'block';
    }
}
