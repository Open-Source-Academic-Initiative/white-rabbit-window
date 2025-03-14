<?php
defined('_JEXEC') or die;

$totalArticles = count($articles);
$loadMoreStep = 3;
?>

<div class="container">
    <div id="article-container" class="row">
        <?php foreach ($articles as $index => $article) : ?>
            <?php 
                // Extract Schema.org `thumbnailUrl`
                preg_match('/"thumbnailUrl"\s*:\s*"([^"]+)"/', $article->introtext, $matches);
                $schemaImage = $matches[1] ?? '';

                // Fallback to Joomla article image
                $images = json_decode($article->images);
                $imageSrc = !empty($schemaImage) ? $schemaImage : (!empty($images->image_intro) ? $images->image_intro : 'default.jpg');
            ?>
            <div class="col-md-4 article-card mb-3" <?php echo $index >= $loadMoreStep ? 'style="display:none;"' : ''; ?>>
                <div class="card h-100">
            <!-- <div class="col article-card" <?php echo $index >= $loadMoreStep ? 'style="display:none;"' : ''; ?>>
                <div class="card h-100 shadow-sm"> -->
            
                    <!-- <img src="<?php echo $article->image; ?>" class="card-img-top" alt="<?php echo $article->title; ?>"> -->
                    <img src="<?php echo htmlspecialchars($imageSrc); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article->title); ?>" loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <!-- <h5 class="card-title"><?php echo $article->title; ?></h5> -->
                        <!-- <p class="card-text"><?php echo $article->introtext; ?></p> -->
                        <!-- <a href="<?php echo $article->link; ?>" class="btn btn-primary" target="_blank">Read More</a> -->
                        <h5 class="card-title"><?php echo htmlspecialchars($article->title); ?></h5>
                        <!-- <p class="card-text"><?php echo htmlspecialchars(strip_tags(JHtml::_('string.truncate', $article->introtext, 120))); ?></p> -->
                    <!-- <div class="card-footer"> -->
                        <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank" class="btn btn-primary mt-auto">Leer más...</a>
                    <!-- </div> -->
                         
                </div>
            </div>
    </div>
        <?php endforeach; ?>
</div>    
</div>

    <div class="row d-grid gap-1 col-6 mx-auto">
        <?php if ($totalArticles > $loadMoreStep) : ?>
                <!-- <button id="loadMoreBtn" class="btn btn-secondary mt-3">Ver más...</button> -->
                <a id="loadMoreBtn" class="btn btn-secondary btn-sm mt-4 mb-5 text-center" role="button">Ver más <i class="fa-solid fa-chevron-down"></i></a>
                <a id="seeMoreLink" href="https://opensai.org/bitacora" class="btn btn-secondary btn-lg mt-4 mb-5 text-center" style="display:none;" target="_blank">¡Visíta nuestra bitácora!</a>
        <?php endif; ?>
    </div>

<style>
.card-img-top {
    width: 100%;
    height: 200px; /* Uniform height */
    object-fit: cover; /* Crops while maintaining aspect ratio */
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let loadMoreBtn = document.getElementById("loadMoreBtn");
    let seeMoreLink = document.getElementById("seeMoreLink");
    let articles = document.querySelectorAll(".article-card");
    let currentCount = <?php echo $loadMoreStep; ?>;
    let totalArticles = <?php echo $totalArticles; ?>;
    
    loadMoreBtn.addEventListener("click", function () {
        let nextCount = currentCount + <?php echo $loadMoreStep; ?>;
        
        articles.forEach((article, index) => {
            if (index < nextCount) {
                article.style.display = "block";
            }
        });

        currentCount = nextCount;

        if (currentCount >= totalArticles) {
            loadMoreBtn.style.display = "none";
            seeMoreLink.style.display = "inline-block";
        }
    });
});
</script>