let meetup
let xhr = new XMLHttpRequest();

xhr.onload = function() {
    console.log('xhr all', xhr)
    if(xhr.status === 200) {
        meetup = JSON.parse(xhr.response, function(key, value) {
            if (key === 'id') return value;
            return value;
        });
    }

    if(xhr.status === 400) {
        //TODO: вывод ошибки, либо состояние ошибки контролить
    }
};

xhr.open("GET", "/d/api/blog/read.php", false);
xhr.setRequestHeader('Content-type', 'application/json');

xhr.send();


let postCreate = document.querySelector('.posts__material');

meetup.data.forEach((item) => {
    const article = document.createElement('article');
    article.className = 'posts__material-article'
    article.innerHTML =
        '<span class="posts__material-name">' + item.user_name + '</span>' +
        '<hr>' + '<br>' +
        '<span class="posts__material-animal">' + item.animal_name + '</span>' +
        '<p class="posts__material-description">' + item.article_text + '</p>';

    // Создаем изображение, если оно есть в данных
    if (item.image_data) {
        let img = document.createElement('img');
        img.className = 'posts__material-img'
        img.src = './api/blog/' + item.image_data;
        article.appendChild(img);
    }

    let btnDelete = document.createElement('button')
    btnDelete.innerHTML = 'Удалить'
    btnDelete.className = 'posts__delete'
    btnDelete.dataset.id = item.id
    article.appendChild(btnDelete)

    postCreate.appendChild(article)
})

let deletes = document.querySelectorAll('.posts__delete')
deletes.forEach(button => {
    button.addEventListener('click', (ev) => {
        ev.preventDefault()
        console.log(button.getAttribute('data-id'))

        let id = button.getAttribute('data-id')

        let xhrs = new XMLHttpRequest();
        xhrs.onload = function() {
            console.log('xhr all', xhrs)
            if(xhrs.status === 200) {}

            if(xhrs.status === 400) {
                //TODO: вывод ошибки, либо состояние ошибки контролить
            }
        };

        xhrs.open("POST", "http://localhost/d/api/blog/delete.php", false);
        xhrs.setRequestHeader('Content-type', 'application/json');

        xhrs.send(JSON.stringify({id: id}));
    })
})