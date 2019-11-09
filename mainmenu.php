<div class="ui relaxed divided list">
    <?php
    $data = showusers($dbh);
    foreach ($data as $key => $value) { ?>
        <div class="item">
            <div class="content">
                <p>
                    <?php echo $value['name'] . ' ' . $value['lastname']; ?>
                    <a class="show" style="float: right;" >show</a>
                    <a class="hide" style="float: right;"  hidden="true">hide</a>
                </p>
            </div>
        </div>

        <div class="item" hidden="true">
            <div class="ui segment" hidden="true" id="userdata">
            <table>
                <tr>
                    <td valign="top" width="40%">
                        <table>
                            <thead>
                            <tr>
                                <th class="tabletxt" align="left">CONTACT</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="ttxt">
                                        <?php echo $value["street"]; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ttxt">
                                        <?php echo $value["city"]; ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="ttxt">
                                        <?php echo $value["country"]; ?>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" width="30%">
                        <table>
                            <thead>
                            <tr>
                                <th class="tabletxt" align="left">PHONE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $phone = showuserphone($dbh, $value['id']);
                            foreach ($phone as $number) {
                                ?>
                                <tr>
                                <td>
                                    <p class="ttxt"><?php echo $number['phone']; ?></p>
                                </td>
                                </tr><?php } ?>
                            </tbody>
                        </table>
                    </td>
                    <td valign="top" width="10%">
                        <table >
                            <thead>
                            <tr>
                                <th class="tabletxt" align="left">EMAIL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $email = showuseremail($dbh, $value['id']);
                            foreach ($email as $mails) {
                                ?>
                                <tr>
                                <td>
                                    <p class="ttxt"><?php echo $mails['email']; ?> </p>
                                </td>
                                </tr><?php } ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    <?php } ?>
</div>
