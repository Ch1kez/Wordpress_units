<?php
$member_type = get_current_member_type();
$fields = get_fields();
$content_key = 'side_bar_katalog';
$content = $fields[$content_key];
$item = $content['knopki_sidebar_2'];
if (empty($content)) return;
?>
<div class="col-md-12 col-lg-3">
    <aside class="aside-faq sidebar-bytype">
        <?php get_template_part('templates/aside-header') ?>
        <ul class="aside-faq__list">
            <?php if (!empty($content['knopki_sidebar_2'])) :
                reset($item);
                foreach ($item as $el):
            ?>
                <li class="aside-faq__list-item">
                    <a class="aside-faq__list-link" href="<?php echo esc_url($el['bokovye_knopki']['url']); ?>">
                        <p class="aside-faq__list-item-title h3">
                            <?php echo $el['bokovye_knopki']['title']; ?>
                        </p>
                    </a>
                </li>
            <?php next($item); endforeach; endif; ?>
        </ul>
    </aside>
</div>
