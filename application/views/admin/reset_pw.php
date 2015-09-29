<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url();?>assets/admin/template/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!--<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link href="<?=base_url();?>assets/admin/template/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <!--<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Your Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?=base_url();?>login/reset_pw_validation">
                            
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="password" type="password" autofocus>
                                    <?php
                                        if($this->session->pass_error!=null){
                                            echo $this->session->pass_error;
                                            $this->session->pass_error = null;
                                        }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Retype Your Password" name="cpassword" type="password">
                                    <?php
                                        if($this->session->pass_error!=null){
                                            echo $this->session->cpass_error;
                                            $this->session->cpass_error = null;
                                        }
                                    ?>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Reset My Password">
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!--<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>-->

    <!-- Metis Menu Plugin JavaScript -->
    <!--<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <!--<script src="../dist/js/sb-admin-2.js"></script>-->

</body>

</html>
