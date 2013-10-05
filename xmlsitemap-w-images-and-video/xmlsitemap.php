<?php 
    $ignore = array('sitemap', 'error','search');
    header('Content-type: text/xml; charset="utf-8"');
    echo '<?xml version="1.0" encoding="utf-8"?>';
?>

<!-- Add the xml name spaces for image and video within the urlset tag -->
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

    <?php foreach($pages->index() as $p): ?> 
        <?php if(in_array($p->uri(), $ignore)) continue ?>
            <url>
                <loc><?php echo html($p->url()) ?></loc>

                <!-- Add this code if you want to include images -->            
                    <?php if ($p->hasImages()): ?>
                        <?php foreach($p->images() as $image): ?>
                            <image:image>
                                <image:loc><?php echo $image->url() ?></image:loc>
                            </image:image>
                        <?php endforeach ?>
                    <?php endif ?>

                <!-- end of image code -->

                <!-- Add this code if you want to include videos -->

                    <?php if ($p->hasVideos()): ?>
                        <?php foreach($p->videos() as $video): ?>
                            <video:video>
                                <video:thumbnail_loc><?php echo $video->thumb()?></video:thumbnail_loc>
                                <video:title><?php echo $video->title() ?></video:title>
                                <video:description><?php echo $video->description() ?></video:description>
                                <video:content_loc><?php echo $video->url() ?></video:content_loc>
                                <video:duration><?php echo $video->duration() ?></video:duration>
                            </video:video>
                        <?php endforeach ?>
                    <?php endif ?>

                <!-- end of video code -->

                <lastmod><?php echo $p->modified('c') ?></lastmod>
                <priority><?php echo ($p->isHomePage()) ? 1 : number_format(0.5/$p->depth(), 1) ?></priority>
            </url>
        <?php endforeach ?>  
</urlset>