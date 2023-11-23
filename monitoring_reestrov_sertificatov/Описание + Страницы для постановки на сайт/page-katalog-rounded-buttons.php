<?php
$member_type = get_current_member_type();
$fields = get_fields();
$content_key = 'zakruglennye_knopki_kataloga';
$content = $fields[$content_key];
$item = $content['blok_knopok_centre'];
if (empty($content)) return;
?>
<?php if (!empty($content['blok_knopok_centre'])) :
    reset($item);
    foreach ($item as $el):
        ?>

        <a href="<?php echo esc_url($el['zakruglennaya_knopka']['url']); ?>"
           class="rounded-button"><?php echo $el['zakruglennaya_knopka']['title']; ?></a>

        <?php next($item); endforeach; endif; ?>

