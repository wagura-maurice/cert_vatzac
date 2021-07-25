<?php
include('../inc/dbcon.php');

if ($userClass->loggedIn() == true) {
    if ($userClass->Controller('Administrator') == false) {
        $userClass->Redirect("".SITEURL."/logout");
    } else {
        $username = $userClass->Insession('username');
    }
} else {
    $userClass->Redirect("".SITEURL."/login");
}

if (isset($_POST['editAccount'])) {

    $fname = $userClass->CleanEntries($_POST['fname']);
    $lname = $userClass->CleanEntries($_POST['lname']);
    $email = $userClass->CleanEntries($_POST['email']);
    $phone = $userClass->CleanEntries($_POST['phone']);

    $fData = ['fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone'=> $phone];
    // insert function
    $userClass->Redirect($userClass->updateProfile("users", $fData, "editAccount", "#tab_1_1", FALSE));

}

if (isset($_POST['changeAvatar'])) {

    $imgFile   = $_FILES['avatarImg']['name'];
    $tmpDIR    = $_FILES['avatarImg']['tmp_name'];
    $imgSize   = $_FILES['avatarImg']['size'];
    $uploadDIR = '../uploads/avatar/';
    $imgExt    = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
    $validExt  = array('jpeg', 'jpg', 'png');
    $avatar    = rand(10000,1000000)."-".$username.".jpg";
    if(in_array($imgExt, $validExt)) {   
        if($imgSize < 5000000) {
            move_uploaded_file($tmpDIR,$uploadDIR.$avatar);
        } else {
            die($userClass->Redirect("?changeAvatar=ImageError#tab_1_2"));
        }
    } else {
        die($userClass->Redirect("?changeAvatar=ImageError#tab_1_2"));
    }

    $fData = ['avatar' => $avatar];
    // insert function
    $userClass->Redirect($userClass->updateProfile("users", $fData, "changeAvatar", "#tab_1_2", FALSE));

}

if (isset($_POST['changePWD'])) {
    $password  = $_POST['password'];
    $passwordC = $_POST['passwordC'];

    if(strlen($password) < 6) {
        die($userClass->Redirect("?changePWD=pwdCheck#tab_1_3"));
    } elseif($password != $passwordC) {
        die($userClass->Redirect("?changePWD=pwdCheck#tab_1_3"));
    } else {
        $hashPWD = md5($password);
    }

    $fData = ['password' => $hashPWD];
    // insert function
    $userClass->Redirect($userClass->updateProfile("users", $fData, "changePWD", "#tab_1_3", TRUE));

}

include('inc/header.php');
?>
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-head">
<div class="page-title">
<h1><?= ucwords($_SESSION['occp']); ?> Profile | Account
<small>user account page</small>
</h1>
</div>
</div>
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active"><?= ucwords($userClass->Insession('username')); ?></span>
</li>
</ul>
<div class="row">
<div class="col-md-12">
<div class="profile-sidebar">
<div class="portlet light profile-sidebar-portlet bordered">
<div class="profile-userpic">
<img src="../uploads/avatar/<?= $userClass->Insession('avatar'); ?>" class="img-responsive" alt="<?= $userClass->Insession('username'); ?>"> </div>
<div class="profile-usertitle">
<div class="profile-usertitle-name"> <?= ucwords($userClass->Insession('username')); ?> </div>
<div class="profile-usertitle-job"> <?= ucwords($userClass->Insession('occp')); ?> </div>
</div>
</div>
</div>
<div class="profile-content">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title tabbable-line">
<div class="caption caption-md">
<i class="icon-globe theme-font hide"></i>
<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
</div>
<ul class="nav nav-tabs">
<li class="active">
<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
</li>
<li>
<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
</li>
<li>
<a href="#tab_1_3" data-toggle="tab">Change Password</a>
</li>
</ul>
</div>
<div class="portlet-body">
<div class="tab-content">
<div class="tab-pane active" id="tab_1_1">
<form role="form" method="POST" accept-charset="UTF-8">
<?php
if(isset($_GET['editAccount'])){
switch ($_GET['editAccount']) {
case 'Success':
echo "<div class=\"alert alert-success content-center\"><label>Updated Personal Info Successfully</label></div>";
break;
case 'Failed':
echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Updating Personal Info, Try Again</label></div>";
break;
}
}
?>
<div class="form-group">
<label class="control-label">First Name</label>
<input type="text" name="fname" id="fname" value="<?= ucwords($userClass->Insession('fname')); ?>" placeholder="John" class="form-control" requried/> </div>
<div class="form-group">
<label class="control-label">Last Name</label>
<input type="text" name="lname" id="lname" value="<?= ucwords($userClass->Insession('lname')); ?>" placeholder="Doe" class="form-control" requried/> </div>
<div class="form-group">
<label class="control-label">Email Address</label>
<input type="email" name="email" id="email" value="<?= $userClass->Insession('email'); ?>" placeholder="admin@system.com" class="form-control" requried/> </div>
<div class="form-group">
<label class="control-label">Mobile Number</label>
<input type="text" name="phone" id="phone" value="<?= $userClass->Insession('phone'); ?>" placeholder="+254 646 580 DEMO (6284)" class="form-control" requried/> </div>
<div class="form-group">
<label class="control-label">Occupation</label>
<input type="text" name="occupation" id="occupation" value="<?= ucwords($userClass->Insession('occp')); ?>" placeholder="Web Developer" class="form-control" disabled readonly requried /> </div>
<div class="margiv-top-10">
<button type="submit" name="editAccount" id="editAccount" class="btn green"> Save Changes </button>
<button type="button" class="btn default"> Cancel </button>
</div>
</form>
</div>
<div class="tab-pane" id="tab_1_2">
<form role="form" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
<?php
if(isset($_GET['changeAvatar'])){
switch ($_GET['changeAvatar']) {
case 'Success':
echo "<div class=\"alert alert-success content-center\"><label>Updated Image File Successfully</label></div>";
break;
case 'Failed':
echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Updating Image File, Try Again.</label></div>";
break;
case 'ImageError':
echo "<div class=\"alert alert-warning content-center\"><label>Image File Not A Valid Extension Or Above The 5Mb Size Limit, Try Again</label></div>";
break;
}
}
?>
<div class="form-group">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="../uploads/avatar/<?= $userClass->Insession('avatar'); ?>" alt="<?= $userClass->Insession('username'); ?>" /> </div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
<div>
<span class="btn default btn-file">
<span class="fileinput-new"> Select image </span>
<span class="fileinput-exists"> Change </span>
<input type="file" name="avatarImg" id="avatarImg"> </span>
<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
</div>
</div>
<div class="clearfix margin-top-10"></div>
</div>
<div class="margin-top-10">
<button type="submit" name="changeAvatar" id="changeAvatar" class="btn green"> Submit </button>
<button type="button" class="btn default"> Cancel </button>
</div>
</form>
</div>
<div class="tab-pane" id="tab_1_3">
<form role="form" method="POST" accept-charset="UTF-8">
<?php
if(isset($_GET['changePWD'])){
switch ($_GET['changePWD']) {
case 'Failed':
echo "<div class=\"alert alert-danger content-center\"><label>An Unexpected Error Occurred While Updating Password, Please try again.</label></div>";
break;
case 'pwdCheck':
echo "<div class=\"alert alert-warning content-center\"><label>Passwords not matching or less than 6 characters in length, please try again.</label></div>";
break;
}
}
?>
<div class="form-group">
<label class="control-label">New Password</label>
<input type="password" name="password" id="password" class="form-control" /> </div>
<div class="form-group">
<label class="control-label">Re-type New Password</label>
<input type="password" name="passwordC" id="passwordC" class="form-control" /> </div>
<div class="margin-top-10">
<button type="submit" name="changePWD" id="changePWD" class="btn green"> Change Password </button>
<button type="button" class="btn default"> Cancel </button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('inc/footer.php'); ?>