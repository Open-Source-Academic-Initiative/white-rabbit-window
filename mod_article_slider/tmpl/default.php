<?php
defined('_JEXEC') or die;

$articles = ModArticleSliderHelper::getArticles($params);
?>

<div class="article-slider-container">
    <div class="article-slider">
        <?php foreach ($articles as $article): 
            $images = json_decode($article->images);
            $imageSrc = isset($images->image_intro) ? $images->image_intro : 'path/to/default-image.jpg';
        ?>
            <div class="article-card">
                <img src="<?php echo htmlspecialchars($imageSrc); ?>" alt="<?php echo htmlspecialchars($article->title); ?>">
                <h3><?php echo htmlspecialchars($article->title); ?></h3>
                <p><?php echo strip_tags(substr($article->introtext, 0, 100)); ?>...</p>
                <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" target="_blank">Read more...</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
