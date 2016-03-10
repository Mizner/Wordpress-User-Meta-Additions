<?php
/*
Plugin Name: User Meta Additions
*/

/*
 * Show Fields on Add New User in Dashboard
 */


function user_meta_additions($user)
{
    if (is_object($user))
        $company = esc_attr(get_the_author_meta('company', $user->ID));
    else
        $company = null;
    if (is_object($user))
        $companyAddress = esc_attr(get_the_author_meta('companyAddress', $user->ID));
    else
        $company = null;
    ?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="company">Company Name</label></th>
            <td>
                <input type="text" class="regular-text" name="company" value="<?php echo $company ?>"
                       id="company"/><br/>
            </td>
        </tr>
        <tr>
            <th><label for="companyAddress">Company Address</label></th>
            <td>
                <input type="text" class="regular-text" name="companyAddress" value="<?php echo $companyAddress ?>"
                       id="companyAddress"/><br/>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'user_meta_additions');
add_action('edit_user_profile', 'user_meta_additions');
add_action('user_new_form', 'user_meta_additions');

function save_user_meta_additions($user_id) {
    # again do this only if you can
    if (!current_user_can('manage_options'))
        return false;
    # save my custom field
    update_user_meta($user_id, 'company', $_POST['company']);
    update_user_meta($user_id, 'companyAddress', $_POST['companyAddress']);
}

add_action('user_register', 'save_user_meta_additions');
add_action('profile_update', 'save_user_meta_additions');