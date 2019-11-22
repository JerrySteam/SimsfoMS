<?php

  require_once('dbconnect.php');
  require_once("HmsSessionHandler.php");

  $dbh = try_db_connect(true);
  //$sessionHandler = new HmsSessionHandler();


  $app['default']['root_folder'] = "simsfo";
  ini_set("date.timezone", "Africa/Lagos");
  ini_set("display_errors", "On");
  //include_once('global_constants.php');


  function site_url($scriptFile = "")
  {
    global $app;

    $baseUrl = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
    $t = "/" . $app['default']['root_folder'] . "/" . $scriptFile;
    $t = str_replace('//', '/', $t);

    $r = $baseUrl . $t;

    return $r;
  }

  /***Page HTML Helper Functions***/
  function getHTMLHeader($path, $pageTitle)
  {
    echo '
      <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It\'s fully customizable and modular.">
      <!-- Twitter meta-->
      <meta property="twitter:card" content="summary_large_image">
      <meta property="twitter:site" content="@pratikborsadiya">
      <meta property="twitter:creator" content="@pratikborsadiya">
      <!-- Open Graph Meta-->
      <meta property="og:type" content="website">
      <meta property="og:site_name" content="Vali Admin">
      <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
      <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
      <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
      <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It\'s fully customizable and modular.">
      <title>'.$pageTitle.' - Simsfo Marketing LTD, Nigeria</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Main CSS-->
      <link rel="stylesheet" type="text/css" href="'.$path.'@assets/css/main.css">
      <link rel="stylesheet" type="text/css" href="'.$path.'@assets/css/plugins/jquery.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="'.$path.'@assets/css/plugins/buttons.dataTables.min.css">

      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="'.$path.'@assets/css/plugins/select2.min.css">
      <style type="text/css">
          .select2-container--default .select2-selection--single{
              width: 100%;   
          }
      </style>

      <!-- Font-icon css
      <link rel="stylesheet" type="text/css" href="'.$path.'@assets/css/font-awesome/css/fontawesome.min.css">
      <link rel="stylesheet" type="text/css" href="'.$path.'@assets/css/font-awesome/css/all.css">-->
    ';
  }

  function getNavbar($path, $pageTitle)
  {
    echo '
      <header class="app-header"><a class="app-header__logo" href="index.html">Simsfo</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
          <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
          </li>
          <!--Notification Menu-->
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
              <li class="app-notification__title">You have 4 new notifications.</li>
              <div class="app-notification__content">
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Lisa sent you a mail</p>
                      <p class="app-notification__meta">2 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Mail server not working</p>
                      <p class="app-notification__meta">5 min ago</p>
                    </div></a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Transaction complete</p>
                      <p class="app-notification__meta">2 days ago</p>
                    </div></a></li>
                <div class="app-notification__content">
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Lisa sent you a mail</p>
                        <p class="app-notification__meta">2 min ago</p>
                      </div></a></li>
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Mail server not working</p>
                        <p class="app-notification__meta">5 min ago</p>
                      </div></a></li>
                  <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message">Transaction complete</p>
                        <p class="app-notification__meta">2 days ago</p>
                      </div></a></li>
                </div>
              </div>
              <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
            </ul>
          </li>
          <!-- User Menu-->
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
              <!--<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>-->
              <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-sm"></i> Profile</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa fa-key fa-sm"></i> Change Password</a></li>
              <li><a class="dropdown-item" href="'.$path.'logout"><i class="fa fa-sign-out fa-sm"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </header>
    ';
  }

  function getSidebar($path, $login_user = 0, $activePage = "" )
  {
    echo '
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="'.$path.'@assets/images/user-image.jpg" alt="User Image">
          <div>
            <p class="app-sidebar__user-name">'.getUserSessions()[2].'</p>
            <p class="app-sidebar__user-designation">Admin</p>
          </div>
        </div>
        <ul class="app-menu">          
          '.getUserMenu($path, $login_user).'
        </ul>
      </aside>
    ';
  }

  function getUserMenu($path, $login_user)
  {
    $result = '';
    $menucategory = getUserPrivilegeCategory($login_user);

    //print_r($menucategory);

    if($menucategory == false){
      $result = '';
    }else{
      $result .= '<li><a class="app-menu__item active" href="'.$path.'dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>';
      for ($row = 0; $row < count($menucategory); $row++) {
          $result .= '
                <li class="treeview">
                  <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">'.$menucategory[$row][1].'</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                  </a>
                      <ul class="treeview-menu">
              ';

          $userpriv = getUserPrivilege($login_user, $menucategory[$row][0]);

          for ($col = 0; $col < count($userpriv); $col++) {
            $result .= '<li><a class="treeview-item" href="'.$path.''.$menucategory[$row][2].'/'.$userpriv[$col][3].'/">'.$userpriv[$col][1].'</a></li>';
          }

          $result .= '  </ul>
                  </li>
                ';
      }
    }
    return $result;
  }

  function getUserPrivilege($login_user, $privcatid)
  {
    global $dbh;

    try {
      $query = "SELECT p.privilegeid, p.privilege, p.privcatid, p.path
            FROM tblroleprivilege AS up 
            INNER JOIN tbluser As ur
            INNER JOIN tblprivilege As p 
            INNER JOIN tblprivilegecategory AS pc
            ON up.privilegeid = p.privilegeid 
            AND up.roleid = ur.roleid
            AND p.privcatid = pc.categoryid 
            WHERE ur.employeeid = '".$login_user."' 
            AND ur.status = 'Active'
            AND pc.categoryid = '".$privcatid."'
            AND ur.datemodified IS NULL
            ORDER BY p.privilege ASC";
      $prepared_query = $dbh->prepare($query);
      $prepared_query->execute();
      $count = $prepared_query->rowCount();
      if($count > 0){
        $result = array();

        while($row = $prepared_query->fetch(PDO::FETCH_ASSOC)){
          array_push(
            $result,
            array($row['privilegeid'], $row['privilege'], $row['privcatid'], $row['path'])
          );
        }
        return $result;
      }else{
        return false;
      }
    } catch (Exception $e) {
      return false;
      //return $e->getMessage();
    }
  }

  function getUserPrivilegeCategory($login_user)
  {
    global $dbh;

    try {
      $query = "SELECT pc.categoryid, pc.category, pc.path
            FROM tblroleprivilege AS up 
            INNER JOIN tblprivilege As p 
            INNER JOIN tbluser As ur
            INNER JOIN tblprivilegecategory AS pc
            ON up.privilegeid = p.privilegeid 
            AND up.roleid = ur.roleid
            AND p.privcatid = pc.categoryid 
            WHERE ur.employeeid = '".$login_user."' 
            AND ur.status = 'Active'
            AND ur.datemodified IS NULL
            GROUP BY pc.categoryid
            ORDER BY pc.category ASC";
      //return $query;
      $prepared_query = $dbh->prepare($query);
      $prepared_query->execute();
      $count = $prepared_query->rowCount();
      if($count > 0){
        $result = array();

        while($row = $prepared_query->fetch(PDO::FETCH_ASSOC)){
          array_push(
            $result,
            array($row['categoryid'], $row['category'], $row['path'])
          );
        }
        return $result;
      }else{
        return false;
      }
    } catch (Exception $e) {
      return false;
      //return $e->getMessage();
    }
  }

  /**the template has no footer yet, we may add one if need be*/
  function getHTMLFooter()
  {
    echo '
        <footer class="footer">
          <div class="container-fluid">
            <nav class="float-left">

              <!--
              <ul>
                <li>
                  <a href="https://www.creative-tim.com">
                    Creative Tim
                  </a>
                </li>
                <li>
                  <a href="https://creative-tim.com/presentation">
                    About Us
                  </a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com">
                    Blog
                  </a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license">
                    Licenses
                  </a>
                </li>
              </ul>
              -->
            </nav>
            <div class="copyright float-right">
              Foki Royal International Nig. LTD 
              &copy;
              <script>
                document.write(new Date().getFullYear())
              </script>. All Rights Reserved.
            </div>
          </div>
        </footer>
        <!-- Modal -->
        <div class="modal fade" id="alertmodal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alertmodaltitle"></h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body" id="alertmodalbody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    ';
  }

  function getCoreJSFiles($path)
  {
    echo '
      <script src="'.$path.'@assets/js/jquery-3.2.1.min.js"></script>
      <script src="'.$path.'@assets/js/popper.min.js"></script>
      <script src="'.$path.'@assets/js/bootstrap.min.js"></script>
      <script src="'.$path.'@assets/js/main.js"></script>
      <script src="'.$path.'@assets/js/plugins/sweetalert2.js"></script>
      <script src="'.$path.'@assets/js/custom.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/sweetalert.min.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/buttons.print.min.js"></script>
      <script type="text/javascript" src="'.$path.'@assets/js/plugins/buttons.html5.min.js"></script>
      <!-- The javascript plugin to display page loading on top-->
      <script src="'.$path.'@assets/js/plugins/pace.min.js"></script>  
      <script src="'.$path.'@assets/js/plugins/select2.min.js" type="text/javascript"></script>
       <script>
          $(document).ready(function() {
              $(".sel2").select2();
          });
      </script>    
    ';
  }
  /***End Page HTML Helper Functions***/

  /***Other Helper Functions***/
  function redirectTo($url)
  {
    if(headers_sent()){
      return "<script>window.location ='".$url."'</script>";
    }
    return header('LOCATION:' . $url);
  }

  function isUserLoggedIn2()
  {
    if (isset($_SESSION["login_user"])) {
      return true;
    }else{
      return false;
    }
  }

  function isUserLoggedIn($path = './')
  {
    $sessionHandler = new HmsSessionHandler();

    if($sessionHandler->sessionExist('login_user')){

    }else{
      $sessionHandler->destroyAllSession();
      redirectTo($path.'logout');
    }
  }

  //Gets Logged in User Sessions
  function getUserSessions()
  {
    $sessionHandler = new HmsSessionHandler();

    try {
      $result = array();

      $usersn = $sessionHandler->getSessionData('login_user');
      $userid = $sessionHandler->getSessionData('staff_id');
      $userfullname = $sessionHandler->getSessionData('full_name');
      $useremail = $sessionHandler->getSessionData('email_address');

      array_push(
        $result,
        $usersn, $userid, $userfullname, $useremail
      );

      return $result;

    } catch (Exception $e) {
      return false;
      //return $e->getMessage();
    }
  }

  function get_countries($id="")
  {
    global $dbh;

    if (!empty($id)) {
      $cArray = "";
      $wArray = array('row_id'=>$id);
      $rArray = $dbh->select('tbl_countries', $cArray, $wArray)->results();
    } else {
      $cArray = "";
      $wArray = "";
      $rArray = $dbh->select('tbl_countries', $cArray, $wArray)->results();
    }
    if (count($rArray) > 0) {
      return $rArray;
    }else{
      return "No Country Found";
    }
  }

  function getCustomersList()
  {
    global $dbh;
    $e = "";
    $cArray = "";
    $wArray = "";
    $rArray = $dbh->select('tbl_customer', $cArray, $wArray)->results();

    if (count($rArray) > 0) {
      return $rArray;
    }else{
      return "No record found";
    }
  }

  function varPad($var)
  {
    return str_pad($var, 4, '0', STR_PAD_LEFT);
  }

  function getModal($mId = '', $mTitle = '', $mContent = '', $mFooterButton = '')
  {
    return "
      <!-- Modal -->
      <div class='modal fade' id='".$mId."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        aria-hidden='true'>
        <div class='modal-dialog modal-lg' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='modaltitle'>".$mTitle."</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body' id='modalbody'>
              ".$mContent."
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
              ".$mFooterButton."
            </div>
          </div>
        </div>
      </div>
    ";
  }

  function encrypt_decrypt($action, $string) 
  {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
  }

  function getCustomerTransactions($cusid)
  {
    global $dbh;
    $cArray = "";
    $wArray = array('cust_id'=>$cusid);
    $aResults = $dbh->select('tbl_sales', $cArray, $wArray)->results();
    if (count($aResults) > 0) {
      $r = $aResults;
    }else{
      $r = '<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                No Transaction Record Found.
              </div>';
    }

    return $r;
  }

  /***End Other Helper Functions***/


  /******other functions from another project. 
  You could check some of the function to see how to write 
  normal SQL queries with the PDO wrapper*******/
  function get_salutations()
  {
  	$sql = "SELECT * FROM tbl_salutations";
  	global $dbh;
  	return $dbh->pdoQuery($sql)->results();
  }

  function get_footer()
  {
    $s = site_url();
    echo '
      <!--Main Footer-->
      <footer class="main-footer">
        <div class="small-container text-center">
              <div class="footer-logo">
                  <figure>
                      <a href="'.$s.'"><img src="images/logo-2.png" alt=""></a>
                  </figure>
              </div>
              <ul class="links-menu">
                  <li><a href="'.$s.'">Home</a></li>
                  <li><a href="'.$s.'speakers">Speakers</a></li>
                  <li><a href="'.$s.'schedule">Schedule</a></li>
                  <li><a href="'.$s.'">Sponsors</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="'.$s.'contact-us">Contact</a></li>
              </ul><!--
              <ul class="social-links">
                  <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
              </ul>      -->
          </div>
          <!--Footer Bottom-->
          <div class="footer-bottom">
            <div class="container">
                  <div class="text-center footer-text"><p>Copyright &copy; <?php echo date("Y")?>, Ahmadu Bello University, Zaria &bull; Powered by <a href="https://iaiict.abu.edu.ng" target="_blank">Web Management Unit @IAIICT</a> &bull; All Right Reserved.</p></div>
              </div>            
          </div>         
      </footer>
      <!--Main Footer-->
    ';
  }

  function format_db_date_time($dbdate)
  {
    $time = strtotime($dbdate);

    $r = date("M d, Y", $time);

    if (strlen($dbdate) > 10) {
        $r = date("M d, Y @g:i:sa", $time);
    }

    return $r;
  }

  function format_display_date($dbdate)
  {
    $time = strtotime($dbdate);

    $r = date("M d, Y", $time);

    if (strlen($dbdate) > 10) {
        $r = date("M d, Y", $time);
    }

    return $r;
  }

  function send_feedback_autoresponse($userDataArray)
  {
    $eml = $userDataArray['user_email'];
    $name = $userDataArray['user_name'];
    
    $hlp_eml = ABU_EMAIL;
    $hlp_phone = ABU_CONTACT;
    $msgBody = file_get_contents(site_url('@server/email_templates/feedback_auto_response.html'));
    $msgBody = str_replace('{{PARAM_SENDER_NAME}}', $name, $msgBody);
    $msgBody = str_replace('{{PARAM_WEBSITE}}', site_url(), $msgBody);
    $msgBody = str_replace('{{PARAM_ABU_EMAIL}}', ABU_EMAIL, $msgBody);
    $msgBody = str_replace('{{PARAM_ABU_GSM}}', ABU_CONTACT, $msgBody);
    $msgBody = str_replace('{{PARAM_EMAIL_YEAR}}', date('Y'), $msgBody);

    $to = $eml;
    $subject = "ABU Website: Your message was received";
    $headers = 'From: ABU Website Admin<' . ABU_EMAIL . ">\r\n" .
    'Reply-To: ' . ABU_EMAIL . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $headers .= "\n";
    
    $mailSent = mail($to, $subject, $msgBody, $headers);
    return $mailSent;
  }

  function cc_feedback_msg($userDataArray, $to)
  {
    $eml = $userDataArray['user_email'];
    $name = $userDataArray['user_name'];
    $msg = $userDataArray['user_message'];
    $gsm = $userDataArray['user_phone'];
    $dt = date('Y-m-d H:i:s');

    $msgBody = file_get_contents(site_url('@site_assets/email_templates/feedback_auto_response_cc.html'));
    $msgBody = str_replace('{{PARAM_MSG_SENDER}}', $name, $msgBody);
    $msgBody = str_replace('{{PARAM_MSG}}', $msg, $msgBody);
    $msgBody = str_replace('{{PARAM_MSG_DATE}}', $dt, $msgBody);
    $msgBody = str_replace('{{PARAM_SENDER_CONTACT}}', $gsm . " &nbsp; " . $eml, $msgBody);
    $msgBody = str_replace('{{PARAM_EMAIL_YEAR}}', date('Y'), $msgBody);

    $subject = "ABU Website: New Feedback Message";
    $headers = 'From: '. $name ."<" . $eml . ">\r\n" .
    'Reply-To: ' . $eml . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Type: text/html; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $headers .= "\n";
    
    $mailSent = mail($to, $subject, $msgBody, $headers);
    return $mailSent;
  }

  function get_featured_promo($staff_tag="",$call_for_submissions=false)
  {
    global $dbh;
    $sql = "SELECT row_id, rank, person_name, specialty, department, message, preferred_url
    FROM tbl_featured_promos WHERE (featured_status = '1') ORDER BY RAND() LIMIT 1";

     if(strlen($staff_tag)>=6 && strlen($staff_tag)<=8){
        $sql = "SELECT row_id, rank, person_name, specialty, department, message, preferred_url
        FROM tbl_featured_promos WHERE (featured_status = '1') AND (tag_code = ?)";

          $bindParam = array();
          $bindParam[]=$staff_tag;

          //$rs = $dbh->pdoQuery($q, $bindParam)->showQuery();die;
          $rs = $dbh->pdoQuery($sql, $bindParam)->results();
     }else{
        $rs = $dbh->pdoQuery($sql)->results();
     }

    
    //in case they tried to tweak the url parameter:
    if(count($rs)==0){
      $sql = "SELECT row_id, rank, person_name, specialty, department, message, preferred_url
    FROM tbl_featured_promos WHERE (featured_status = '1') ORDER BY RAND() LIMIT 1";
    
      $rs = $dbh->pdoQuery($sql)->results();
    }

    $intro = "Hi, I am " . $rs[0]['person_name'] . ", " . $rs[0]['rank'] . " specialising in " . $rs[0]['specialty'] . " at the " . $rs[0]['department'];

    $bg_img = site_url("featured-promos/") .$rs[0]['row_id'] . ".jpg";
    $bg_img_sm = site_url("featured-promos/") .$rs[0]['row_id'] . "s.jpg";
    echo
    '<div id="featured-staff">
    <div class="gdlr-core-pbf-wrapper " id="div_1dd7_21">
        <div class="gdlr-core-pbf-background-wrap">
            <div class="gdlr-core-pbf-background gdlr-core-parallax gdlr-core-js" id="div_1dd7_22" data-parallax-speed="0.2" 
              style="background-image: url('.$bg_img.') ;background-size: cover ;background-position: center;"></div>
        </div>
        <div class="gdlr-core-pbf-wrapper-content gdlr-core-js ">
            <div class="gdlr-core-pbf-wrapper-container clearfix gdlr-core-container">
                <div class="gdlr-core-pbf-column gdlr-core-column-20 gdlr-core-column-first">
                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                        <!--
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-image-item gdlr-core-item-pdlr gdlr-core-item-pdb  gdlr-core-left-align" id="div_1dd7_23">
                                    <div class="gdlr-core-image-item-wrap gdlr-core-media-image  gdlr-core-image-item-style-rectangle" id="div_1dd7_24"><img src="'.site_url("upload/logo-white.png").'" alt="" width="262" height="35" title="logo-white" /></div>
                                </div>
                            </div>
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-bottom gdlr-core-item-pdlr" id="div_1dd7_25">
                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                     <h3 class="gdlr-core-title-item-title gdlr-core-skin-title shaded_text" id="h3_1dd7_5">Featured Staff</h3></div>
                                    </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="gdlr-core-pbf-column gdlr-core-column-40">
                    <div class="gdlr-core-pbf-column-content-margin gdlr-core-js ">
                        <div class="gdlr-core-pbf-column-content clearfix gdlr-core-js ">
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" id="div_1dd7_26">
                                    <div class="gdlr-core-title-item-title-wrap clearfix">
                                      <h3 class="gdlr-core-title-item-title gdlr-core-skin-title shaded_text" id="h3_1dd7_5">Featured Staff</h3>
                                    </div>
                                    
                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_27">
                                        <p class="shaded_text">' .$intro. '.</p> 
                                    </div>
                                </div>
                            </div>

                            <div class="row featured-promos-sm">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"><center>
                                <img src="'.$bg_img_sm.'" width="350" height="440" alt="'.$rs[0]['person_name'].'" title="'.$rs[0]['person_name'].'" class="img-responsive img-thumbnail" /></center>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align" id="div_1dd7_28">
                                    <div class="gdlr-core-text-box-item-content" id="div_1dd7_29">
                                        <p class="shaded_text">'.$rs[0]['message'].'</p>
                                    </div>
                                </div>
                            </div>';

                            $join_us = '
                            <div class="gdlr-core-pbf-element">
                                <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-right-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" style="background-color:#cf0000" href="admissions" id="a_1dd7_0"><span class="gdlr-core-content" >Join Us Now!</span></a>
                                </div>
                            </div>';

                            if(strlen($rs[0]['preferred_url'])>0){
                              $join_us = '
                              <div class="gdlr-core-pbf-element">
                                  <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-right-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" style="background-color:#cf0000" href="'.$rs[0]['preferred_url'].'" target="_blank" id="a_1dd7_0"><span class="gdlr-core-content" >Explore More!</span></a>
                                  </div>
                              </div>';

                            }
                            echo $join_us;
                            if($call_for_submissions){
                              /*
                              echo '
                              <p style="color:rgb(216, 227, 251); font-size:1.2em;border:none !important" class="shaded_text"><u>ANNOUNCEMENT:</u> &nbsp;All Staff of ABU are encouraged to kindly submit their profiles to be featured here.<br />
    <div class="gdlr-core-button-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-right-align"><a class="gdlr-core-button  gdlr-core-button-solid gdlr-core-button-no-border" style="background-color:#272" href="'.site_url("featured-staff-request/").'" id="a_1dd7_0"><span class="gdlr-core-content" >Submit Yours Now!</span></a>
                                  </div>';*/
                              }
                              echo '
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div></div>';
  }

  function get_programme_stats()
  {
    $pg=0; $phd = 0; $mph = 0; $msc = 0; $pgd = 0; $ug=0;global $dbh;
    
    $q = "SELECT COUNT(programmeid) AS cnt_pg FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'PG'))";
      
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $pg = $rs[0]['cnt_pg'];
    }

    $q = "SELECT COUNT(programmeid) AS cnt_phd FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'PH'))";
      
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $phd = $rs[0]['cnt_phd'];
    }

    $q = "SELECT COUNT(programmeid) AS cnt_mph FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'MP'))";
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $mph = $rs[0]['cnt_mph'];
    }
    
    $q = "SELECT COUNT(programmeid) AS cnt_msc FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'MS'))";
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $msc = $rs[0]['cnt_msc'];
    }
    
    $q = "SELECT COUNT(programmeid) AS cnt_pgd FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'PG'))";
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $pgd = $rs[0]['cnt_pgd'];
    }


    $q = "SELECT COUNT(programmeid) AS cnt_ug FROM tblprogramme WHERE (programmetypeid IN (SELECT programmetypeid FROM tblprogrammetype WHERE progtypecode = 'UG'))";
      
    $rs = $dbh->pdoQuery($q)->results();
    $tot_recs_found = $dbh->affectedRows();
    if($tot_recs_found > 0){
      $ug = $rs[0]['cnt_ug'];
    }


    $ret_array = array('count_pg'=>$pg,'count_phd'=>$phd,'count_mphil'=>$mph,'count_msc'=>$msc,'count_pgd'=>$pgd,'count_ug'=>$ug);
    return $ret_array;
  }

  function is_logged_in()
  {
    return (isset($_SESSION['auth']) && ($_SESSION['auth'] > 0));
  }

  function check_permission($u_id, $perm_code) 
  {
    /*
      You can call this from the top of any page like this:

      if(check_permission($_SESSION['ADMIN_ROWID'], "publish_news"){
        //do some 
      }else{
        //redirect them to dashboard and dieplay access denied message there.
      }
    */

    $has_permission = false;
    
      if(is_logged_in()){
          $q = "SELECT u.row_id, p.perm_description
          FROM tbl_user_permissions AS u
          INNER JOIN tbl_permission_defs AS p ON u.perm_rowid = p.row_id  
          WHERE (u.user_id = $u_id) AND p.perm_code = '$perm_code'";
        
          global $dbh;
          $rs = $dbh->pdoQuery($q)->results();
          $tot_recs_found = $dbh->affectedRows();

          $has_permission = ($tot_recs_found > 0);
      }
      return $has_permission;
  }

  function fetch_programmes($programme_name)
  {
    $sql = "SELECT tblprogramme.name 
    FROM tblprogramme INNER JOIN tblprogrammetype ON tblprogramme.programmetypeid = tblprogrammetype.programmetypeid 
    WHERE tblprogrammetype.name = '".$programme_name."' ORDER BY tblprogramme.name ASC";
    global $dbh;
    $rs = $dbh->pdoQuery($sql)->results();
    $count = count($rs);
    $r = '
      <div class="gdlr-core-accordion-item-content-wrapper">
            <h4 class="gdlr-core-accordion-item-title gdlr-core-js ">'.$count.' '.$programme_name.' Programmes</h4>
            <div class="gdlr-core-accordion-item-content">
          <!--/Div for title-->
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-title-item gdlr-core-item-pdb clearfix  gdlr-core-left-align gdlr-core-title-item-caption-top gdlr-core-item-pdlr"
                        style="padding-bottom: 40px ;">
                        <div class="gdlr-core-title-item-title-wrap clearfix">
                            <h3 class="gdlr-core-title-item-title gdlr-core-skin-title "
                                style="font-size: 22px ;font-weight: 700 ;letter-spacing: 0px ;text-transform: none ;">
                                ABU '.$programme_name.' Programmes</h3>
                        </div>
                    </div>
                </div>

                <!--/div-->
                <div class="gdlr-core-pbf-element">
                    <div class="gdlr-core-text-box-item gdlr-core-item-pdlr gdlr-core-item-pdb gdlr-core-left-align"
                        style="padding-bottom: 40px ;">
                        <div class="gdlr-core-text-box-item-content" style="text-transform: none;">
                            <div style="overflow-x: auto;">
                                <table class = "programme-list" style="min-width: 600px; text-align: left;">
                                    <thead>
                                      <tr>
                                            <th>S/No</th>
                                            <th>Programmes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ';
                                        $i = 1;
                                        foreach ($rs as $programmes => $programme) {
                                          $r .= '
                                            <tr>
                                                <td>'.$i.'</td>
                                                <td>'.$programme["name"].'</td>
                                            </tr>';
                                         $i++;
                                        }
                                        
                                     $r .= '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';

    return $r;
  }

  function get_comments_rs($stry_id)
  {
    $q = "SELECT row_id, user_name, user_phone, user_location, user_comment, date_posted
    FROM tbl_stories_comments WHERE (story_id = $stry_id) ORDER BY date_posted DESC";

    global $dbh;
    return $dbh->pdoQuery($q)->results();
  }

  function is_exist_item($item_value, $item_value_is_num, $column_name, $table_name)
  {
    //for this function to work, the target table must have a column called "row_id"
    $r = 0;
    $param_item_value=trim($item_value);
    $param_column_name=trim($column_name);
    $param_table_name=trim($table_name);
    
    global $dbh;
    $selectFields = array('row_id');
    $whereConditions = array($param_column_name=>$param_item_value);
    $rs = $dbh->select($param_table_name, $selectFields, $whereConditions)->results();
    
    if(count($rs) > 0){
      $r = $rs[0]['row_id'];
    }
    
    return $r;
  }

  function get_random_edquote()
  {
    $quote = '
      <div class="gdlr-core-blockquote-item-content gdlr-core-skin-content" style="font-size: 24px ;font-weight: 600 ;letter-spacing: 1px ;">
          <p class="shaded_text" style="color: #708090">When a teacher calls a student by his/her entire name, it means trouble!</p>
      </div>
      <div class="gdlr-core-blockquote-item-author gdlr-core-skin-caption" style="font-size: 18px ;font-weight: 600 ;">&ndash; Mark Twain
      </div>';

    global $dbh;
    $sql = "SELECT row_id, quote, quote_source, source_url
    FROM tbl_edquotes ORDER BY RAND() LIMIT 1";
    $rs = $dbh->pdoQuery($sql)->results();

    $src= $rs[0]['quote_source'];
    $url= $rs[0]['source_url'];

    if(strlen($url) > 0){
      $src .= " <a class='btn  btn-warning' href='".$url."' target='_blank'>Read More</a>";
    }

    $quote = '
      <div class="gdlr-core-blockquote-item-content gdlr-core-skin-content" style="font-size: 28px ;font-weight: lighter;letter-spacing: 1px ;">
          <p class="shaded_text" style="color: #708090"><em>'.$rs[0]['quote'].'</em></p>
      </div>
      <div class="gdlr-core-blockquote-item-author gdlr-core-skin-caption" style="font-size: 18px ;font-weight: 600 ;">&ndash; '.$src.'
          </div>

      <form action="">
        <input type="button" class="btn btn-success pull-right" value="Get Another Quote" onclick="getNewQuote()">
      </form>';

    $r = $rs[0]['row_id'];
    $q = "UPDATE tbl_edquotes SET serve_count = (serve_count + 1) WHERE row_id = $r";
    $dbh->pdoQuery($q);

    return $quote;
  }

?>