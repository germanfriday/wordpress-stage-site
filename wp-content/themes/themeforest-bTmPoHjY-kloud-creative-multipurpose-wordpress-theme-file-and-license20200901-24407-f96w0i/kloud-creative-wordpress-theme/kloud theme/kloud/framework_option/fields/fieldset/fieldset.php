<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Fieldset
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class CSFramework_Option_fieldset extends CSFramework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output() {

    echo wp_kses_post($this->element_before());

    echo '<div class="cs-inner">';

    foreach ( $this->field['fields'] as $field ) {

      $field_id    = ( isset( $field['id'] ) ) ? $field['id'] : '';
      $field_value = ( isset( $this->value[$field_id] ) ) ? $this->value[$field_id] : '';
      $unique_id   = $this->unique .'['. $this->field['id'] .']';

      if ( ! empty( $this->field['un_array'] ) ) {
        echo cs_add_element( $field, cs_get_option( $field_id ), $this->unique );
      } else {
        echo cs_add_element( $field, $field_value, $unique_id );
      }

    }

    echo '</div>';

    echo wp_kses_post($this->element_after());

  }

}
