<?php  return '$input = $modx->fromJSON($input);
$output = array();
if (!$input || empty($tpl)) return \'нет шаблона вывода!\';
foreach ($input as $row) {
  $output[] = $modx->getChunk($tpl, $row);
}
return implode("\\n", $output);
return;
';