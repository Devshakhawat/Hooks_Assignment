<?php
namespace Student\Info;

/**
 * Student Information class
 *
 */
class Student_Information {
    //Declared constructor
    public function __construct() {
        add_shortcode( 'collect-student-info', [ $this, 'get_student_information' ] );
        add_shortcode( 'display-student-data', [ $this, 'display_data' ] );
    }

    /**
     * Collect student information
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return string
     */
    public function get_student_information() {
        ob_start();
            include_once __DIR__ . '/templates/student_info_form.php';
        $template = ob_get_clean();
        
            $fname = isset( $_REQUEST['fname'] ) ? sanitize_text_field( $_REQUEST['fname'] ) : '';
            $lname = isset( $_REQUEST['lname'] ) ? sanitize_text_field( $_REQUEST['lname'] ) : '';
            $class = isset( $_REQUEST['class'] ) ? sanitize_text_field( $_REQUEST['class'] ) : '';
            $roll  = isset( $_REQUEST['roll'] ) ? sanitize_text_field( $_REQUEST['roll'] ) : '';
            $reg   = isset( $_REQUEST['reg'] ) ? sanitize_text_field( $_REQUEST['reg'] ) : '';

            $value['bangla_marks']  = isset ( $_REQUEST['bangla'] ) ? sanitize_text_field( $_REQUEST['bangla'] ) : '';
            $value['english_marks'] = isset ( $_REQUEST['english'] ) ? sanitize_text_field( $_REQUEST['english'] ) : '';
            $value['math_marks']    = isset ( $_REQUEST['math'] ) ? sanitize_text_field( $_REQUEST['math'] ) : '';

            $args = [
                'first_name' => $fname,
                'last_name'  => $lname,
                'class'      => $class,
                'roll'       => $roll,
                'reg_no'     =>  $reg,
            ];
        
           $id = insert_student_info( $args );

           update_student_meta( $id, 'student_info', $value );
           get_student_info( $args );

           return $template;
    }

    /**
     * Display students data
     *
     * @return void
     */
    public function display_data() {
        $paged         = ! empty( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $offset        = ( $paged - 1 ) * 2;
        $args          = array( 'offset' => $offset, 'number' => 2 );
        $student_infos = get_student_info( $args );

        foreach( $student_infos as $student ) {
?>
    <table>
        <tr>
            <th><?php echo __( 'Student Name', 'wemeta' ); ?></th>
            <th><?php echo __( 'Class ', 'wemeta' ); ?></th>
            <th><?php echo __( 'Roll', 'wemeta' ); ?></th>
            <th><?php echo __( 'Reg No', 'wemeta' ); ?></th>
            <th><?php echo __( 'Bangla Marks', 'wemeta' ); ?></th>
            <th><?php echo __( 'English Marks', 'wemeta' ); ?></th>
            <th><?php echo __( 'Math Marks', 'wemeta' ); ?></th>
        </tr>
        <tr>
            <th><?php echo $student->first_name . " ". $student->last_name; ?></th>
            <th><?php echo $student->class; ?></th>
            <th><?php echo $student->roll; ?></th>
            <th><?php echo $student->reg_no; ?></th>
            <?php $marks = get_student_meta( $student->id, 'student_info', false )[0]; ?>
            <th><?php echo $marks['bangla_marks']; ?></th>
            <th><?php echo $marks['english_marks']; ?></th>
            <th><?php echo $marks['math_marks']; ?></th>
        </tr>
  </table>
<?php
        }

        /**
         * Added pagination 
         *
         * @return void
         */
        echo paginate_links( 
            [
                'format'  => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total'   => ceil( wd_ac_address_count()/2 )
            ]
                );
    }
}
