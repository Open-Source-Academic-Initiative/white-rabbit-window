document.addEventListener("DOMContentLoaded", function () {
    const categoryField = document.querySelector('[name="jform[params][category_id]"]');
    const articleField = document.querySelector('[name="jform[params][article_id]"]');

    if (!categoryField || !articleField) return;

    categoryField.addEventListener("change", function () {
        const categoryId = categoryField.value;

        articleField.innerHTML = '<option value="">- Loading... -</option>';

        fetch('index.php?option=com_ajax&module=mod_article_slider&method=getArticles&format=json&category_id=' + categoryId)
            .then(response => response.json())
            .then(data => {
                articleField.innerHTML = '<option value="">- Select an article -</option>';
                if (data.success) {
                    data.articles.forEach(article => {
                        const option = document.createElement("option");
                        option.value = article.value;
                        option.textContent = article.text;
                        articleField.appendChild(option);
                    });
                } else {
                    articleField.innerHTML = '<option value="">- No articles found -</option>';
                }
            })
            .catch(() => {
                articleField.innerHTML = '<option value="">- Error loading articles -</option>';
            });
    });
});
