<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;
use Carbon_Fields\Container;

function signature_block() {
    Block::make( __( 'Example block' ) )
//        block picto
        ->set_icon( 'carrot' )
//        block fields
        ->add_fields( array(
            Field::make( 'text', 'r1-block-signature-pseudo', __( 'Pseudo' ) ),
            Field::make( 'color', 'r1-block-signature-color', __('Background color' )),
//                ->set_palette( array( '#FF0000', '#00FF00', '#0000FF' ) ),
            Field::make( 'image', 'r1-block-signature-photo', __( 'Photo' ) ),
            Field::make( 'rich_text', 'r1-block-signature-sentence', __( 'sentence' ) ),
        ) )


//        Callback to display fields in a block
        ->set_render_callback( function ( $block) {
// Create class attribute allowing for custom "className" and "align" values.
            $className = 'r1-carbon-example';
            if( !empty($block['className']) ) {
                $className .= ' ' . $block['className'];
            }
            if( !empty($block['align']) ) {
                $className .= ' align' . $block['align'];
            }

            $title = $block['r1-block-signature-pseudo'];
            $color = $block['r1-block-signature-color'];
            $image = wp_get_attachment_image( $block['r1-block-signature-photo'], 'middle' );
            $content = $block['r1-block-signature-sentence'];
            ?>

            <div class="block-<?php echo $className ?>" style="background-color: <?php echo $color ?>">

                <div class="<?php echo $className ?>-title">
                    <h3><?php echo esc_html( $title); ?></h3>
                </div><!-- /.block__heading -->

                <div class="<?php echo $className ?>-image">
                    <?php echo  $image ;?>
                </div><!-- /.block__image -->

                <div class="<?php echo $className ?>-sentence">
                    <?php
                          echo wpautop($content);
                    ?>

                </div><!-- /.block__content -->
            </div><!-- /.block -->

            <?php
        } );
}
