let form = document.getElementById('form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    let fileInput = document.getElementById('file');
    let file = fileInput.files[0];
    formData.append('image_data', file);

    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if(xhr.status === 200) {
            console.log('Файл успешно отправлен на сервер');
        } else {
            console.log('Произошла ошибка при отправке файла');
        }
    };

    xhr.open("POST", "http://localhost/d/api/blog/create.php", true);
    xhr.send(formData);
});