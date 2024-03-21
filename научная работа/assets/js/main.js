const closeButton = document.querySelector('.close_popup');

closeButton.addEventListener('click', function () {
    popup.style.display = 'none';
    overlay.style.display = 'none';
});

    const svButton = document.querySelector('.sv');
    const popup = document.getElementById('popup');
    const inputField = document.getElementById('inputField');
    const saveButton = document.getElementById('saveButton');

    svButton.addEventListener('click', function() {
    popup.style.display = 'block';
});

    saveButton.addEventListener('click', function() {
    popup.style.display = 'none';
});

    document.addEventListener('click', function(e) {
    // Если кликнули по кнопке, которая открывает popup, то ничего не делать
    if (e.target === svButton) return;
    // Если кликнули по popup или его потомку, то ничего не делать
    if (popup.contains(e.target)) return;
    // В противном случае, скрыть popup
    //(popup.style.display = 'none');
});
