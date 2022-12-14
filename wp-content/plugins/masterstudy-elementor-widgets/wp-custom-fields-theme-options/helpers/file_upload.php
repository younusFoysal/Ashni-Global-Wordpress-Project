<?php

new STM_WPCFTO_FILE_UPLOAD;

class STM_WPCFTO_FILE_UPLOAD
{

    public function __construct()
    {
        add_action('wp_ajax_wpcfto_upload_file', array($this, 'upload_file'));
    }

    function upload_file()
    {
        check_ajax_referer('wpcfto_upload_file', 'nonce');

        $this->create_folder();

        $r = array(
            'error' => esc_html__('Error occurred, please try again', 'masterstudy-elementor-widgets'),
            'path' => '',
            'url' => ''
        );

        if (empty($_POST['field'])) wp_send_json($r);

        $field = sanitize_text_field($_POST['field']);

        /*is_repeater?*/
        if(!empty($_POST['field_native_name']) and !empty($_POST['field_native_name_inner'])) {
            $field = sanitize_text_field($_POST['field_native_name']);
            $field_inner = sanitize_text_field($_POST['field_native_name_inner']);
        }

        $field_data = $this->get_field_data($field);

        if(!empty($field_inner) and !empty($field_data) and !empty($field_data['fields']) and !empty($field_data['fields'][$field_inner])) {
            $field_data = $field_data['fields'][$field_inner];
        }

        if(empty($field_data)) wp_send_json($r);

        $allowed_extensions = $field_data['mimes'];

        if (empty($_FILES['file'])) {
            wp_send_json(array(
                'error' => esc_html__('Please, select file', 'masterstudy-elementor-widgets'),
            ));
        };

        $file = $_FILES['file'];
        $path = $file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        if (!in_array($ext, $allowed_extensions)) {
            wp_send_json(array(
                'error' => true,
                'message' => esc_html__('Invalid file extension', 'masterstudy-elementor-widgets')
            ));
        }

        $filename = md5(time()) . basename($path);
        $upload_file = wp_upload_bits($filename, null, file_get_contents($file['tmp_name']));

        if ($upload_file['error']) {
            $r['error'] = $upload_file['error'];
            wp_send_json($r);
        }

        rename($upload_file['file'], $this->get_file_path($filename));

        $file_data = $this->get_file_data($filename);
        $r['error'] = '';
        $r['path'] = $file_data['path'];
        $r['url'] = $file_data['url'];

        if(apply_filters("wpcfto_modify_file_{$field}", false)) {
            $r = apply_filters("wpcfto_modified_{$field}", $r, $filename);
        }

        wp_send_json($r);
    }

    function get_file_path($filename) {
        return $this->upload_dir() . '/' . $filename;
    }

    function get_file_url($filename) {
        return $this->upload_url() . '/' . $filename;
    }

    function get_file_data($filename) {
        return array(
            'path' =>  $this->get_file_path($filename),
            'url' =>  $this->get_file_url($filename),
        );
    }

    function get_field_data($name)
    {
        $boxes = apply_filters('stm_wpcfto_fields', array());

        foreach ($boxes as $box) {
            foreach ($box as $section) {
                foreach ($section['fields'] as $field_key => $field) {
                    if ($field_key === $name) return $field;
                }
            }
        }

        return false;
    }


    static function upload_url() {
        $upload = wp_upload_dir();
        $upload_dir = $upload['baseurl'];
        $upload_dir = $upload_dir . '/wpcfto_files';

        return $upload_dir;
    }

    static function upload_dir() {
        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/wpcfto_files';

        return $upload_dir;
    }

    function create_folder() {

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $upload_dir = $this->upload_dir();

        if (!$wp_filesystem->is_dir($upload_dir)) {
            wp_mkdir_p($upload_dir);
        }
    }

}