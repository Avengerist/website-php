<?php
function emptyInputs($username,$password,$repeat_password,$email)
{
    if (empty($username) || empty($password) || empty($repeat_password) || empty($email))
    {
        return true;
    }
    return false;
}
function passwordMismatch($password,$repeat_password)
{
    if ($password !=$repeat_password)
    {
        return true;
    }
    return false;
}
function hashPassword($password){
    return password_hash($password,PASSWORD_DEFAULT);
}
function createUser($connection,$username,$password,$email){
    $password=hashPassword($password);
    $sql="INSERT INTO accounts (username,password,email) VALUES (?,?,?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"sss",$username,$password,$email);
    mysqli_stmt_execute($stmt);

    $sql="SELECT * FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $account_id=$row["account_id"];


    $sql="INSERT INTO personal_data (account_id) VALUES(?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"d",$account_id);
    mysqli_stmt_execute($stmt);

    
}
function usernameTaken($connection,$username){
    $sql="SELECT username FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($result)){
        return true;
    }
    return false;
}
function emailTaken($connection,$email){
    $sql="SELECT email FROM accounts WHERE email=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($result)){
        return true;
    }
    return false;
}
function isAuthorized($connection,$username,$password){
    $sql="SELECT * FROM accounts WHERE username=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)){ 
        if (password_verify($password,$row["password"])){
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["account_id"] = $row["account_id"];
            return true;
        }
    }
    return false;
}

function GetPersonalData($connection,$account_id){
    $sql="SELECT * FROM personal_data WHERE account_id=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"d",$account_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $data=array("Firstname","Lastname","PersonalCode","Phone","City","Sex","Avatar");
    $lengthData=count($data);
    for ($i=0;$i < $lengthData;$i++){
        if (isset($row[$data[$i]])){
            $_SESSION[strtolower($data[$i])]=$row[$data[$i]]; 
        }
    }
    
}
function SetPersonalData($connection,$firstname,$lastname,$account_id){
    $sql="UPDATE personal_data SET Firstname = (?), Lastname = (?) WHERE account_id=(?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssd",$firstname,$lastname,$account_id);
    mysqli_stmt_execute($stmt);

    $sql="SELECT * FROM personal_data WHERE account_id=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"d",$account_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["firstname"] = $firstname;
    $_SESSION["lastname"] = $lastname;
}
function UploadImage($connection,$account_id,$target_file){
    $target_file=substr($target_file,3);
    $sql="UPDATE personal_data SET Avatar=? WHERE account_id=?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"sd",$target_file,$account_id);
    mysqli_stmt_execute($stmt);
}
function UploadBook($connection,$author,$title,$publisher,$target_file){
    $target_file=substr($target_file,3);
    $sql="INSERT INTO books (Author, Title, Publisher, book_image) VALUES (?,?,?,?)"; 
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ssss",$author,$title,$publisher,$target_file);
    if (mysqli_stmt_execute($stmt)){
        return true;
    }
    return false;
}
function GetBooks($connection){
    $sql="SELECT * FROM books";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

?> 
