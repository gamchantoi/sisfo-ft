<?php
class ExportToExcel
    {
      function exportWithPage($php_page,$excel_file_name)
      {
        $this->setHeader($excel_file_name);
        echo $php_page;
        
      }
      
      function setHeader($excel_file_name)
      {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$excel_file_name");
        header("Pragma: no-cache");
        header("Expires: 0");
      }
    }
?>