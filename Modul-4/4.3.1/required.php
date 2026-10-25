<?php


{

$pattern = "/^[a-zA-Z'-]+$/"; // format surname
(alfabet) if (!isset($field_list[$field_name]) ||
empty($field_list[$field_name]))
$errors[$field_name] = 'required';
else if (!preg_match($pattern, $field_list[$field_name]))
$errors[$field_name] = 'invalid';

}
function validateName($field_list, $field_name)
{
if (!isset($field_list[$field_name]))
return false;
$pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
if (!preg_match($pattern, $field_list[$field_name]))
return false;
return true;
}
?>