<?php
$wrapper_attributes = get_block_wrapper_attributes( array(
    'class' => 'grid grid-cols-1 md:grid-cols-3 gap-8'
) );
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php echo $content; ?>
</div>