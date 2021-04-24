<form>
    <label for="jobname">Job Type:</label>
    <input type="text" class="regular-text" name="jname" id="jobname"><br>
    <label for="location">Location:</label>
    <input type="text" class="regular-text" name="area" id="location"><br>
    <input type="submit" class="button button-primary" value="submit">
    <?php wp_verify_nonce( 'github_template' ); ?>
</form>