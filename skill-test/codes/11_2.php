<?php
if (isUserAdmin ()) {
	$isAdmin = true;
}
$data = validate_and_return_input ( $data );
switch ($action) {
	case 'add' :
		addSomething ( $data );
		break;
	case 'delete' :
		if ($isAdmin) {
			deleteSomething ( $data );
		}
		break;
	case 'edit' :
		if ($isAdmin) {
			editSomething ( $data );
		}
		break;
	default :
		print �
		Action . �;
}
?> 