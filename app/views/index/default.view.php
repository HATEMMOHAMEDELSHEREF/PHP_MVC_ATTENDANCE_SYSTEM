<div id="LOADDATAHERE">
<h1 class="text-danger">Hello Statistics-Dahboard</h1>

</div>

<?php
echo '<pre>';
var_dump($_SESSION['user_auth']);
//extract($this->Data['Data']);

echo "</pre>";
echo $_SESSION['user_auth']['Data']->instructor_role;
?>