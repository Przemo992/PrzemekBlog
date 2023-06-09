<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<nav>
          
              <?php if ($paginator->previous): ?>
                <a href="<?= $base; ?>?page=<?= $paginator->previous; ?>"><button type="button" class="btn btn-outline-dark">Previous</button></a>
              <?php else:?>
                <button type="button" class="btn btn-outline-dark" disabled>Previous</button>
              <?php endif; ?>
          
              <?php if ($paginator->next): ?>
                <a href="<?= $base; ?>?page=<?= $paginator->next; ?>"><button type="button" class="btn btn-outline-dark">Next</button></a>
              
              <?php else: ?>
                <button type="button" class="btn btn-outline-dark" disabled>Next</button>
                <?php endif; ?>
       
        </nav>