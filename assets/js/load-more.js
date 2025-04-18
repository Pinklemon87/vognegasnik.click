document.addEventListener("DOMContentLoaded", function () {
    let loadMoreBtn = document.getElementById('load-more');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            let page = this.getAttribute('data-page');

            fetch(` ? page = ${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Ошибка сети или сервера");
                    }
                    return response.text();
                })
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, "text/html");
                    let newArticles = doc.querySelector("#articles-container").innerHTML;

                    if (newArticles.trim()) {
                        document.getElementById('articles-container').innerHTML += newArticles;
                        this.setAttribute('data-page', parseInt(page) + 1);
                    } else {
                        this.style.display = 'none';
                    }
                })
                .catch(error => console.error("Ошибка загрузки данных:", error));
        });
    }
});