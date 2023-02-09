<?php

function mediclf_pagination($mediclf_query = '', $return = false) {

    global $wp_query;

    $mediclf_big = 999999999; // need an unlikely integer

    $mediclf_cus_query = $wp_query;

    if (!empty($mediclf_query)) {
        $mediclf_cus_query = $mediclf_query;
    }

    $mediclf_pagination = paginate_links(array(
        'base' => str_replace($mediclf_big, '%#%', esc_url(get_pagenum_link($mediclf_big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $mediclf_cus_query->max_num_pages,
        'prev_text' => '<i class="fa fa-angle-double-left"></i> <span>' . esc_html__('Prev', 'mediclf') . '</span>',
        'next_text' => '<span>' . esc_html__('Next', 'mediclf') . '</span> <i class="fa fa-angle-double-right"></i>',
        'type' => 'array'
    ));


    if (is_array($mediclf_pagination) && sizeof($mediclf_pagination) > 0) {
        $mediclf_html = '<nav class="medicll-pagination">';
        $mediclf_html .= '<ul>';
        foreach ($mediclf_pagination as $mediclf_link) {
            if (strpos($mediclf_link, 'current') !== false) {
                $mediclf_html .= '<li class="active"><a>' . preg_replace("/[^0-9]/", "", $mediclf_link) . '</a></li>';
            } else {
                $mediclf_html .= '<li>' . $mediclf_link . '</li>';
            }
        }
        $mediclf_html .= '</ul>';

        $mediclf_html .= '</nav>';

        if ($return === false) {
            echo ($mediclf_html);
        } else {
            return $mediclf_html;
        }
    }
}
