<a class="item" id="clickmain">
    Public phonebook
</a>
<?php if (empty($_SESSION['userid'])) { ?>
    <a class="item" id="clicklogin">
        Login
    </a>
<?php } else { ?>
    <a class="item" id="clickcontact">
        My contact
    </a>
<?php } ?>
