<?php

    // store the content of the kirbytext text variable in $text
    $text = kirbytext($page->text());

    // split the content of $text whenever a <!--pagebreak--> code is encountered and store in the array $pages
    $pages = explode('<!--pagebreak-->', $text);

    // count the number of pages in the array
    $pageCount = count ($pages);

    //set pageLinkCount
    if($pageCount >= 1) : $pageLinkCount = 1;  
    else : $pageLinkCount = 0; 
    endif;

    // create a new page object
    $pages = new Pages($pages);

    // paginate the page object at every page
    $pages= $pages->paginate(1);

    //create a new page for each item in $pages
    foreach ($pages as $p):
        snippet('header') ?> 
            <article>
                <h1><?= $page->title()?><? if (! $firstPage): echo " - Part ".$pages->pagination()->page(); endif ?></h1>
                <?php echo $p?> 

    //create the page navigation (prev, pagenumbers, next)

                    <?php
                    if($pages->pagination()->hasPrevPage()):?>
                        <nav>
                            <a class="next" href="<?php echo $pages->pagination()->prevPageURL()?>">Prev</a> 
                    <?php endif;

                    while($pageLinkCount <= $pageCount && $pageCount > 1) : ?>
                    <a <?= ($pageLinkCount == ($pages->pagination()->page()))?' class="active"':''?> href="<?php echo $pages->pagination()->pageURL($pageLinkCount) ?>"><?php echo $pageLinkCount ?></a>&nbsp;
                        <?php $pageLinkCount++;
                endwhile ?>

                <?php if($pages->pagination()->hasNextPage()):?> 
                    <a class="prev" href="<?php echo $pages->pagination()->nextPageURL()?>">Next</a>
                    </nav>
                <?php endif?>

        </article>
    </main> 
    <?php snippet('footer')?>
<?php endforeach ?>