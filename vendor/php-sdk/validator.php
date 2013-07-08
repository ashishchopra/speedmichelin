<?php
function isEmail($email)
{
if (preg_match("/^(\w+((-\w+)|(\w.\w+))*)\@(\w+((\.|-)\w+)*\.\w+$)/",$email))
{
return true;
}
else 
{
return false;
}
}
?>