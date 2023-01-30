<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Admin Page</title>
</head>
<body>
<?php
    include 'includes/header.inc.php'; 
?>

<form id="bookForm" method="POST" action="includes/admin.inc.php" enctype="multipart/form-data">
    <h1> Add new book</h1>
    <input required class="bookInput" name="Author" placeholder="Enter Author">
    <input required class="bookInput" name="Title" placeholder="Enter Title">
    <input required class="bookInput" name="Publisher" placeholder="Enter Publisher">
    <input required class="bookInput" type="file" name="bookToUpload">
    <input required class="bookInput" type="submit" value="Upload Book" name="submitBook">
</form>