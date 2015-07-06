<?php
add_filter( 'rwmb_meta_boxes', 'fab_register_meta_boxes' );

function fab_register_meta_boxes( $meta_boxes )
{
    $prefix = 'rw_';

    // 1st meta box
    $meta_boxes[] = array(
        'id'       => 'port_image',
        'title'    => 'Portfolio project items',
        'pages'    => array( 'portfolio' ),
        'context'  => 'normal',
        'priority' => 'high',

        'fields' => array(

            array(
                'name'  => 'Image project',
                'desc'  => 'Add the image items in your portfolio here.',
                'id'    => $prefix . 'gallery',
                'type'  => 'plupload_image',
                'max_file_uploads' => 15,
            ),

            array(
                'name'  => 'Video project',
                'desc'  => 'Add the video item for your portfolio',
                'id'    => $prefix . 'video',
                'type'  => 'oembed',
            ),

            array(
                'name'  => 'Project url',
                'desc'  => 'Add the url to your project.',
                'id'    => $prefix . 'url',
                'type'  => 'text',
            ),
        )
    );




    return $meta_boxes;
}