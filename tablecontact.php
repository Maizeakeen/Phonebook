<form method="post" action="phonebook.php">
    <table>
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td valign="top">
                <table width="33%">
                    <thead>
                    <tr>
                        <th class="tabletxt" align="left">CONTACT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="ui label">
                                First name
                            </div>
                            <input style="margin-top: 4px" type="text" name="name" value="<?php echo $user->name; ?>">

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ui label">
                                Last name
                            </div>
                            <input style="margin-top: 4px" type="text" name="lastname"
                                   value="<?php echo $user->lastname; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ui label">
                                Street
                            </div>
                            <input style="margin-top: 4px" type="text" name="street"
                                   value="<?php echo $user->street; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ui label">
                                City
                            </div>
                            <input style="margin-top: 4px" type="text" name="city" value="<?php echo $user->city; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="ui label">
                                Country
                            </div>
                            <select style="margin-top: 4px" type="text" name="country">
                                <?php $countries = showcountries($dbh);
                                foreach ($countries as $key => $country) { ?>
                                    <option value="<?php echo $country['name'] ?>"
                                        <? if ($country['name'] == $user->country) {
                                            echo 'selected';
                                        } ?>><?php echo $country['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td valign="top">
                <table width="33%">
                    <thead>
                    <tr>
                        <th class="tabletxt" align="left">PHONE</th>
                    </tr>
                    </thead>
                    <tbody id="phonetable">
                    <?php
                    if (!empty($user->phone[0])) {                       //Поля ввода телефонов
                        foreach ($user->phone as $value) {
                            ?>
                            <tr>
                            <td>
                                <div class="inline field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="flagp[]" value="1" tabindex="0" class="hidden"
                                            <?php if ($value['flag'] == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <label>Publish field</label>
                                    </div>
                                </div>
                                <input style="margin-top: 5px" type="text" name="phone[]"
                                       value="<?php echo $value['phone']; ?>">
                            </td>
                            </tr><?php }
                    } else {
                        ?>
                        <tr>
                            <td>
                                <div class="inline field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="flagp[]" value="1" tabindex="0" class="hidden">
                                        <label>Publish field</label>
                                    </div>
                                </div>
                                <input style="margin-top: 5px" type="text" name="phone[]">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <a id="addp">+Add</a>
            </td>

            <td valign="top">
                <table width="33%">
                    <thead>
                    <tr>
                        <th class="tabletxt" align="left">EMAIL</th>
                    </tr>
                    </thead>
                    <tbody id="emailtable">
                    <?php
                    if (!empty($user->email[0])) {           //Поля ввода почты
                        foreach ($user->email as $value) {
                            ?>
                            <tr>
                            <td>
                                <div class="inline field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="flage[]" value="1" tabindex="0" class="hidden"
                                            <?php if ($value['flag'] == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <label>Publish field</label>
                                    </div>
                                </div>
                                <input style="margin-top: 5px" type="text" name="email[]"
                                       value="<?php echo $value['email']; ?>">
                            </td>
                            </tr><?php }
                    } else {
                        ?>
                        <tr>
                            <td>
                                <div class="inline field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="flage[]" value="1" tabindex="0" class="hidden">
                                        <label>Publish field</label>
                                    </div>
                                </div>
                                <input style="margin-top: 5px" type="text" name="email[]">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <a id="adde">+Add</a>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <button class="ui inverted red button">Save</button>
</form>