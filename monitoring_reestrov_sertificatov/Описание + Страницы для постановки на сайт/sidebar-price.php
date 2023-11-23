<?php
$member_type = get_current_member_type();
$fields = get_fields();
$content_key = 'content_sidebar';
$content = $fields[$content_key];
$item = $content['knopki_sidebar'];
if (empty($content)) return;
?>
<div class="col-md-12 col-lg-3">
    <aside class="aside-faq sidebar-bytype">
        <?php get_template_part('templates/aside-header') ?>
        <ul class="aside-faq__list">
            <?php if (!empty($content['knopki_sidebar'])) :
                reset($item);
                foreach ($item as $el):
            ?>
                <li class="aside-faq__list-item">
                    <a class="aside-faq__list-link" href="<?php echo esc_url($el['bokovaya_knopka']['url']); ?>">
                        <p class="aside-faq__list-item-title h3">
                            <?php echo $el['bokovaya_knopka']['title']; ?>
                        </p>
                    </a>
                </li>
            <?php next($item); endforeach; endif; ?>
        </ul>
    </aside>
</div>
