<?php
defined('_JEXEC') or die;

if (!empty($articles)): ?>
    <div id="article-slideshow" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($articles as $index => $article):
                $images = json_decode($article->images);
                $thumbnail = isset($images->image_intro) ? $images->image_intro : 'default.jpg'; // Default image
            ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $thumbnail; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article->title); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($article->title); ?></h5>
                            <p class="card-text"><?php echo JHtml::_('string.truncate', strip_tags($article->introtext), 100); ?></p>
                            <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $article->id); ?>" class="btn btn-primary" target="_blank">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#article-slideshow" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#article-slideshow" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php endif; ?>
