<!-- <?php
defined('_JEXEC') or die;

// $article_ids = $params->get('article_ids');
// $article_ids_output = "{$hello} The Selected Articles List: {$article_ids}"

?> -->

<!-- <h4><?php echo $article_ids_output; ?></h4>

<div class="article-slideshow">
    <?php foreach ($articles as $article) : ?>
        <?php 
            $images = json_decode($article->images);
            $imageSrc = !empty($images->image_intro) ? $images->image_intro : 'default.jpg';
        ?>
        <div class="article-card">
            <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="<?php echo htmlspecialchars($article->title); ?>" loading="lazy">
            <h3><?php echo htmlspecialchars($article->title); ?></h3>
            <p><?php echo htmlspecialchars(strip_tags($article->introtext)); ?></p>
            <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank">Read more...</a>
        </div>
    <?php endforeach; ?>
</div> -->

<!-- <div class="article-slideshow-container">
    <div class="article-slideshow">
        <?php foreach ($articles as $article) : ?>
            <?php 
                $images = json_decode($article->images);
                $imageSrc = !empty($images->image_intro) ? $images->image_intro : 'default.jpg';
            ?>
            <div class="article-card">
                <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="<?php echo htmlspecialchars($article->title); ?>" loading="lazy">
                <h3><?php echo htmlspecialchars($article->title); ?></h3>
                <p><?php echo htmlspecialchars(strip_tags($article->introtext)); ?></p>
                <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank">Read more...</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.article-slideshow-container {
    overflow: hidden;
    width: 100%;
    position: relative;
}
.article-slideshow {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px;
}
.article-card {
    min-width: 250px;
    border: 1px solid #ddd;
    padding: 15px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.article-card img {
    width: 100%;
    height: auto;
    border-radius: 6px;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const slideshow = document.querySelector(".article-slideshow");
    
    function autoScroll() {
        if (!slideshow.matches(":hover")) {
            slideshow.scrollBy({ left: 2, behavior: "smooth" });
        }
    }

    let scrollInterval = setInterval(autoScroll, 50);
    slideshow.addEventListener("mouseenter", () => clearInterval(scrollInterval));
    slideshow.addEventListener("mouseleave", () => scrollInterval = setInterval(autoScroll, 50));
});
</script> -->
<!-- <?php
defined('_JEXEC') or die;
?>

<div class="article-slideshow">
    <div class="scroll-container">
        <?php foreach ($articles as $article): ?>
            <?php
            // Extract first image from Joomla's article "images" JSON field
            $images = json_decode($article->images);
            $thumbnail = isset($images->image_intro) ? $images->image_intro : 'default.jpg';
            ?>
            <div class="card">
                <img src="<?php echo $thumbnail; ?>" alt="<?php echo htmlspecialchars($article->title); ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($article->title); ?></h5>
                    <p class="card-text"><?php echo strip_tags(substr($article->introtext, 0, 100)) . '...'; ?></p>
                    <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank" class="btn btn-primary">Read more</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.article-slideshow {
    overflow: hidden;
    white-space: nowrap;
    width: 100%;
}
.scroll-container {
    display: flex;
    gap: 15px;
    animation: scroll 20s linear infinite;
}
.card {
    width: 250px;
    flex-shrink: 0;
}
@keyframes scroll {
    from { transform: translateX(100%); }
    to { transform: translateX(-100%); }
}
</style> -->

<!-- <?php
defined('_JEXEC') or die;
?>

<div class="article-slider-wrapper">
    <div class="article-slider" id="articleSlider">
        <?php foreach ($articles as $article) : ?>
            <?php 
                $images = json_decode($article->images);
                $imageSrc = !empty($images->image_intro) ? $images->image_intro : 'default.jpg';
            ?>
            <div class="article-card">
                <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="<?php echo htmlspecialchars($article->title); ?>" loading="lazy">
                <h3><?php echo htmlspecialchars($article->title); ?></h3>
                <p class="intro-text"><?php echo htmlspecialchars(strip_tags(JHtml::_('string.truncate', $article->introtext, 120))); ?></p>
                <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank">Read more...</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.article-slider-wrapper {
    overflow: hidden;
    position: relative;
    width: 100%;
    max-width: 1200px;
    margin: auto;
}
.article-slider {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding: 10px;
    white-space: nowrap;
    transition: transform 0.5s ease;
}
.article-card {
    flex: 0 0 auto;
    width: 250px; /* Ensures consistent width */
    height: 100%; /* Dynamic height based on content */
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    padding: 15px;
    scroll-snap-align: center;
    transition: transform 0.3s ease-in-out;
}
.article-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
.intro-text {
    min-height: 50px; /* Equal height for text */
}
.article-card:hover {
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .article-card {
        width: 200px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('articleSlider');
    let isHovered = false;

    function autoScroll() {
        if (!isHovered) {
            slider.scrollLeft += 1;
            if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                slider.scrollLeft = 0;
            }
        }
    }

    let scrollInterval = setInterval(autoScroll, 50);

    slider.addEventListener('mouseenter', function () {
        isHovered = true;
    });

    slider.addEventListener('mouseleave', function () {
        isHovered = false;
    });
});
</script> -->


<?php
defined('_JEXEC') or die;
?>

<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($articles as $article) : ?>
            <?php 
                // Extract Schema.org `thumbnailUrl`
                preg_match('/"thumbnailUrl"\s*:\s*"([^"]+)"/', $article->introtext, $matches);
                $schemaImage = $matches[1] ?? '';

                // Fallback to Joomla article image
                $images = json_decode($article->images);
                $imageSrc = !empty($schemaImage) ? $schemaImage : (!empty($images->image_intro) ? $images->image_intro : 'default.jpg');
            ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo htmlspecialchars($imageSrc); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article->title); ?>" loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($article->title); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(strip_tags(JHtml::_('string.truncate', $article->introtext, 120))); ?></p>
                        <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.card-img-top {
    width: 100%;
    height: 200px; /* Uniform height */
    object-fit: cover; /* Crops while maintaining aspect ratio */
}
</style>
