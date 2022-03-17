<?php

class WP_Widget_Noticias extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'widget_noticias',
            'description' => __('Noticias'),
            'customize_selective_refresh' => true,
        );
        parent::__construct('noticias', __('Noticias'), $widget_ops);
        $this->alt_option_name = 'widget_noticias';
    }

    public function widget($args, $instance) {
        $noticias = get_posts(array('post_type' => 'noticias', 'post_status' => 'publish', 'numberposts' => 4));
        $output = '<div class="container"><div class="row"><h3 class="center-align">Últimas noticias</h3>';
        $i = 1;
     
        if (count($noticias) > 0) {
            foreach ($noticias as $noticia) {
                // if ($i == 1) $output .= '<div class="row">';
                $s = get_post($noticia);
                $image = get_the_post_thumbnail_url($s, 'medium');
                $introText = get_post_meta($s->ID, 'intro-text', true);
                $output .= '<div class="col s12 m6 l3">
                <div class="card card-servicio">
                    <div class = "card-image">
                        <img src = "' . $image . '">
                    </div>
                    <div class="card-title">' . $s->post_title . '</div>
                    <div class="card-content">
                        <div class="servicio-desc">' . $introText . '</div>
                    </div>
                    <div class="card-action">
                        <div class="row linea-naranja">
                            <div class="col s6"><div class="linea">&nbsp;</div></div>
                            <div class="col s6 enlace"><a href="' . get_permalink($noticia->ID) . '">&nbsp;Ver más</a></div>
                        </div>
                    </div>
                 </div>';

                $output .= '</div>';
                if ($i == 4) {
                    //   $output .= '</div>';
                    $i = 1;
                } else {
                    $i++;
                }
            }
        }
        $output .= '</div></div>';
        echo $output;
    }

    /**
     * Handles updating settings for the current Recent Comments widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Comments widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form($instance) {
        
    }

    /**
     * Flushes the Recent Comments widget cache.
     *
     * @since 2.8.0
     *
     * @deprecated 4.4.0 Fragment caching was removed in favor of split queries.
     */
    public function flush_widget_cache() {
        _deprecated_function(__METHOD__, '4.4.0');
    }

}
