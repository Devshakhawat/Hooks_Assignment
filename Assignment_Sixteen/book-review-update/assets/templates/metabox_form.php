<table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="author"><?php echo esc_html__( 'Author', 'bookreviewed' ); ?></label>
                    </th>
                    <td>
                        <input name="book_author" id="author" type="text" value="<?php echo esc_attr( $author ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="publishdate"><?php echo esc_html__( 'Publish date', 'bookreviewed' ); ?></label>
                    </th>
                    <td>
                        <input name="book_publish_date" id="publishdate" type="date" value="<?php echo esc_attr( $publish_date ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="edition"><?php echo esc_html__( 'Edition', 'bookreviewed' ); ?></label>
                    </th>
                    <td>
                        <input name="book_edition" id="edition" type="text" value="<?php echo esc_attr( $edition ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="isbn"><?php echo esc_html__( 'ISBN', 'bookreviewed' ); ?></label>
                    </th>
                    <td>
                        <input name="book_isbn" id="isbn" type="text" value="<?php echo esc_attr( $isbn ); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="format"><?php echo esc_html__( 'Format', 'bookreviewed' ); ?></label>
                    </th>
                    <td>
                        <input name="book_format" id="format" type="text" value="<?php echo esc_attr( $format ); ?>" class="regular-text" />
                    </td>
                </tr>
            </tbody>
        </table>