<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';
require_once 'class/class.email.php';

require_once 'action/action.forgot.php';

include_once 'include/include.header.php';

if(isset($validHash)) {
    include_once 'include/include.reset.form.php';
} else {
    include_once 'include/include.forgot.form.php';
}

include_once 'include/include.footer.php';