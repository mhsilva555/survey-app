<?php

namespace Survey\App;

require_once(ABSPATH . 'wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

class MediaUpload
{
    public function push($file, $parent = false)
    {
        if (empty($file)) {
            return null;
        }

        $upload = wp_handle_upload(
            $file,
            array('test_form' => false)
        );

        if (!empty($upload['error'])) {
            return null;
        }

        $attachment_id = wp_insert_attachment(
            array(
                'guid'           => $upload['url'],
                'post_mime_type' => $upload['type'],
                'post_title'     => basename($upload['file']),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ),
            $upload['file'],
            $parent
        );

        if (is_wp_error($attachment_id) || !$attachment_id) {
            return null;
        }

        wp_update_attachment_metadata(
            $attachment_id,
            wp_generate_attachment_metadata($attachment_id, $upload['file'])
        );

        return (object) [
            'attachment_id' => $attachment_id,
            'url' => $upload['url']
        ];
    }
}