<form method="post" id="formArticle">

  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Tytuł</span>
    <input class="form-control" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($article->title ?? ''); ?>">
  </div>
  <?php if (! empty($article->errors['title'])){

    echo '<div class="error">' . $article->errors['title'] . '</div>';

  } ?>

  <div class="input-group mb-3">
    <span class="input-group-text">Treść</span>
    <textarea class="form-control" name="content" rows="4" cols="40" id="content" placeholder="Article content"><?= htmlspecialchars($article->content ?? ''); ?></textarea>
  </div>
  <?php if (! empty($article->errors['content'])){

echo '<div class="error">' . $article->errors['content'] . '</div>';

} ?>

  <div class="input-group mb-3">
    <span class="input-group-text">Data Publikacji</span>
    <input class="form-control" type="datetime-local" name="published_at" id="published_at"  value="<?= htmlspecialchars($article->published_at ?? ''); ?>" >
  </div>
  <?php if (! empty($article->errors['published_at'])){

echo '<div class="error">' . $article->errors['published_at'] . '</div>';

} ?>

  <fieldset class="mb-3">
      <legend>Kategorie</legend>

      <?php foreach ($categories as $category) : ?>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category['id'] ?>"
                  id="category<?= $category['id'] ?>"
                  <?php if (in_array($category['id'], $category_ids)) :?>checked<?php endif; ?>>
          <label class="form-check-label" for="category<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
      </div>

        <?php endforeach; ?>

  </fieldset> 

  <button class="btn btn-outline-dark">Save</button>

</form>