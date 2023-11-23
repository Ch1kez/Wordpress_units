<?php
$member_type = get_current_member_type();
$fields = get_fields();
$content_key = 'tablicza_programm';
$content = $fields[$content_key];

if (empty($content) || empty($content['giperssylkiknopki_sidebar'])) {
    return;
}

$item = $content['giperssylkiknopki_sidebar'];

if (is_array($item) && !empty($item)) {
    foreach ($item as $el) {
        if (isset($el['naimenovanie_programmy']['url']) && isset($el['naimenovanie_programmy']['title']) && isset($el['pole_prodolzhitelnost_programmy'])) {
            ?>
            <div class="row">
                <div class="cell cell-left"><a
                            href="<?php echo esc_url($el['naimenovanie_programmy']['url']); ?>"><?php echo $el['naimenovanie_programmy']['title']; ?></a>
                </div>
                <div class="cell cell-right">
                    <?php echo esc_html($el['pole_prodolzhitelnost_programmy']); ?>
                    <br>
                    <?php echo esc_html($el['kol-vo_modulej']); ?></div>
            </div>
            <?php
        }
    }
}
?>
