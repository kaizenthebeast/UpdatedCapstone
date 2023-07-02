<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the PDF file path from the AJAX request
  $pdfPath = $_POST['pdfPath'];

  // Add any necessary validation or security checks here

  // Set the appropriate headers to force the browser to download the file
  header('Content-Type: application/pdf');
  header('Content-Disposition: inline; filename="' . basename($pdfPath) . '"');
  header('Content-Length: ' . filesize($pdfPath));

  // Read the file contents and echo them to the response
  readfile($pdfPath);
}
?>