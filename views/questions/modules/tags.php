<?php $tags = $question['tags']; ?>
<div class="tags-wrapper">
    Tags:
    <?php foreach($tags as $tag ): ?>
        <span class="badge rounded-pill bg-primary"><?php echo $tag['name']; ?></span>
    <?php endforeach; ?>
</div>
