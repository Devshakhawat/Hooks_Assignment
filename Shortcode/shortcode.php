<?php
/** 
Plugin Name: Shortcode
Plugin URI: thisistest.me
Description: this shortcode is made for assignment purpose
Author: Shakhawat
Author URI: https://devshakhawat.me
version: 1.0.0
License: gplv2
Text Domain: sh-test
**/
if (!defined('ABSPATH')) {
    exit;
}
/***
* We made a nested shortcode to display
* a contact form
*
* @Since 1.0.0
*
* @param null
*
* @Return void
***/
class Shortcode {
    public function __construct() {
        add_shortcode('contact-form', [$this, 'contact_form_fields']);
        add_shortcode('contact-form-heading', [$this, 'contact_form_heading']);
        add_shortcode('special_form', [$this, 'select_radio_checkbox']);
    }
    /***
    * added a shotcode to display select, radio
    * and checkbox infos in contact form
    *
    * @Since 1.0.0
    *
    * @param $infos
    *
    * @Return array
    ***/
    public function select_radio_checkbox( $infos ) {
         
        //added default values
        $default = array ( 
            'name'      => '',
            'type'      => '',
            'label'     => 'Wedevs car description',
            'options'   => '',
        );
        //replacing default values with user inputs
        $infos = shortcode_atts( $default, $infos );

        $allinfo = array(
            'checkbox',
            'radio'
        );

        $var2    = $infos['type'];
        if(in_array($infos['type'], $allinfo)) {
            $var2 = 'key2';
        }
        
        switch($var2) {

             case 'key2':
                
                ob_start();
               
                $options2 = explode( "|", $infos['options'] );
                    
                   //error_log( print_r( $infos['label'] , 1));
                ?>
                        <br><br><label for="vehicle1"> <?php echo "Select a {$infos['label']}" ?></label><br>
                <?php foreach($options2 as $soption):  ?>
                    
                    <?php echo '<br>'.$soption; ?>
                <br><input type="<?php echo $infos['type'] ?>"  id="vehicle1" name="vehicle1" value="Bike">
                <?php endforeach; ?>
    
                <?php
                $value = ob_get_clean();
                return $value;

            case 'select':
                ob_start();
                $options3 = explode( "|", $infos['options'] );
                    
                ?>
                <select name="cars" id="cars">
                    <option value="volv" selected>Select A Car</option>
                    <?php foreach ($options3 as $option4): ?>
                    <option name="<?php $infos['name']; ?>" value="volvo"><?php echo $option4; ?></option>
                    <?php endforeach; ?>
                </select>
    
                <?php
                $value = ob_get_clean();
                return '<br>'.$value.'<br>';
 
        }


    }
    /***
    * created this shortcode to display regular 
    * regular fields inside our contact form
    *
    * @Since 1.0.0
    *
    * @param $attr
    *
    * @Return array
    ***/
    public function contact_form_fields($attr) {

        $default = array(
            'type' => 'text',
            'name' => 'fname',
            'placeholder' => 'Write here'
        );

        $code_replace = shortcode_atts( $default, $attr, 'contact-form' );


        $check = $code_replace['type'];

        //error_log( print_r( $check , 1));

        $input_type = array (
            'text',
            'number',
            'password',
            'number',
            'tel',
            'file',
            'email',
            'url',

        );

        if(in_array( $code_replace['type'], $input_type )) {
            $check = 'key';
        }

        switch ( $check ) {

            case 'key':
                $value = "<br><input type='{$code_replace['type']}' name='{$code_replace['name']}' ><br>";
                return $value; 

            case 'textarea':
                $value = "<br><textarea name='{$code_replace['name']}' rows='4' cols='50'> </textarea><br/>";
                return $value;


            case 'button':
                ob_start();
                ?>
                <button type="button">CLICK HERE</button>

                <?php
                $value = ob_get_clean();
                return $value;

        }

    }
    /***
    * I created this finction to display title of contact 
    * form and execute other shortcodes inside it
    *
    * @Since 1.0.0
    *
    * @param $attributes @values
    *
    * @Return array
    ***/


    public function contact_form_heading( $attributes, $values ) {

        return do_shortcode($values);
    }

}
new Shortcode();
