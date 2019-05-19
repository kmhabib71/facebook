<?php 

include 'connect/login.php';
include 'core/load.php';


$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;
    echo 'User find';
    header('Location: index.php');
}




if (isset($_POST["first-name"]) && !empty($_POST["first-name"])){
    $upFirst = $_POST["first-name"];
    $upLast = $_POST["last-name"];
    $upEmailMobile = $_POST["email-mobile"];
    $upPassword = $_POST["up-password"];
    $birthMOnth = $_POST["birth-month"];
    $birthDay = $_POST["bith-day"];
    $birthYear = $_POST["birth-year"];
    $upgen = $_POST["gen"];
    $birth = ''.$birthYear.'-'.$birthMOnth.'-'.$birthDay.'';
    
    
     if(empty($upFirst) or empty($upLast) or empty($upEmailMobile) or empty($upPassword) or empty($upgen)){
        $errorb = 'All feilds are required';
    }else {
        $first_name = $loadFromUser->checkInput($upFirst);
        $last_name = $loadFromUser->checkInput($upLast);
        $screenName = ''.$first_name.'_'.$last_name.'';
        $email_mobile = $loadFromUser->checkInput($upEmailMobile);
        $password = $loadFromUser->checkInput($upPassword);
       if(DB::query('SELECT screenName FROM users where screenName=:screenName', array(':screenName'=>$screenName))){
           $screenRand = rand();
       $userLink =''.$screenName.''.$screenRand.'';
                    
                } else {
           $userLink= $screenName;
       }
         if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email_mobile))
         {
//          if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
          if(!preg_match("^[0-9]{11}$^",$email_mobile))
          {
              $errorb = 'Email Or Phone number is not correct. Please try again.';
          }else{
            
        //////////////////.......................///////////////////////
           
             
//        if(!filter_var($email)){
//            $errorb = 'Invalid email format';
//        } else 4
//        $mobile = settype($mobilee, "string");
        $mobilee = strlen((string)$email_mobile);
        
        echo $mobilee;
        
            if($mobilee < 11){
            $errorb = 'Mobile number is not valid';
        }else if (strlen($password) < 5 && strlen($password) <=60){
            $errorb = 'Password is too short';
        } else {

//            if((filter_var($email,FILTER_VALIDATE_EMAIL)) && $getFromU->checkEmail($email) === true){
//                $errorb = 'Email is already in use!';
//            }else{
                if(DB::query('SELECT mobile FROM users where mobile=:mobile', array(':mobile'=>$email_mobile))){
                    $errorb = 'mobile number is already in use!';
                    
                } else {
                // $getFromU->register($email, $screenName, $password);
                // header('Location: home.php');
                $userid=$loadFromUser->create('users', array('first_name' => $first_name,'last_name' => $last_name,'mobile' => $email_mobile, 'password' =>password_hash($password,PASSWORD_BCRYPT), 'screenName' => $screenName, 'userLink'=>$userLink,  'birthday' => $birth, 'gender' => $upgen));
                    
//                $_SESSION['user_id'] = $user_id;
//                    echo $user_id;
                // header('Location: includes/signup.php?step=1');
                $cstrong = true;
                $token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                //select userid from databse
                $user_id=DB::query('SELECT user_id FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))[0]['user_id'];
                    $loadFromUser->create('profile', array('userId' => $user_id,'birthday' => $birth,'firstName' => $first_name,'lastName' => $last_name, 'profilePic' => 'assets/images/defaultProfile.png', 'coverPic' => 'assets/images/defaultCover.png', 'gender' => $upgen));
//                $id = rand();  
//                    echo $id;
//                    echo sha1($token);
//                    echo $user_id;
                $loadFromUser->create('token', array('id'=>'','token'=>sha1($token),'user_id'=>$user_id));
                //put token and userid in databse
//            DB::query('INSERT INTO login_tokens VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
            
            // set cookies to commputer for logged in snid=cookies name, $token = cookie token, time=how much time cookie active for login, 2nd NULL = cause we dont have ssl, if have then use true, true=for crose site scripting.

            //set cookie valid for 7 days
            setcookie('FBID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
            //set cookie valid for 3 days and goto index page for config
            setcookie('FBID_', $token, time()+60*60*24*3,'/',NULL, NULL, true);
            
                header('Location: index.php');
            }
//            }
        }  
              
              
              ////////////....................//////////////////
              
              
        
              
              
              
              
          }
             
         }else{
         
        if(!filter_var($email_mobile)){
            $errorb = 'Invalid email format';
        } else if(strlen($first_name) > 20){
            $errorb = 'Name must be between in 2-20 character';
        }else if (strlen($password) < 5 && strlen($password) >= 60){
            $errorb = 'Password is too short';
        } else {

            if((filter_var($email_mobile,FILTER_VALIDATE_EMAIL)) && $loadFromUser->checkEmail($email_mobile) === true){
                $errorb = 'Email is already in use!';
            }else{
               
                $userid=$loadFromUser->create('users', array('first_name' => $first_name,'last_name' => $last_name,'email' => $email_mobile, 'password' =>password_hash($password,PASSWORD_BCRYPT), 'screenName' => $screenName, 'userLink'=>$userLink,  'birthday' => $birth, 'gender' => $upgen  ));
                
             
                $user_id=DB::query('SELECT user_id FROM users WHERE email=:email', array(':email'=>$email_mobile))[0]['user_id'];
                   $_SESSION['user_id'] = $user_id;
                $cstrong = true;
                $token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                $loadFromUser->create('profile', array('userId' => $user_id,'birthday' => $birth,'firstName' => $first_name,'lastName' => $last_name,'profilePic' => 'assets/images/defaultProfile.png', 'coverPic' => 'assets/images/defaultCover.png', 'gender' => $upgen));
            DB::query('INSERT INTO token VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
            // set cookies to computer for logged in snid=cookies name, $token = cookie token, time=how much time cookie active for login, 2nd NULL = cause we dont have ssl, if have then use true, true=for crose site scripting.
//echo $user_id;
            //set cookie valid for 7 days
            setcookie('FBID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
            //set cookie valid for 3 days and goto index page for config
            setcookie('FBID_', $token, time()+60*60*24*3,'/',NULL, NULL, true);
            
                header('Location: index.php');
            }
            }
         
         }
         
        }
    }else{
        $errorb = '';
    echo $errorb;
}


if (isset($_POST["in_email_mobile"]) && !empty($_POST["in_email_mobile"])){
    
    $email_mobile = $_POST["in_email_mobile"];
    $in_pass = $_POST["in_pass"];
    
  if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email_mobile))
  {
      if(!preg_match("^[0-9]{11}$^",$email_mobile))
          {
              $errorb = 'Email Or Phone number is not correct. Please try again.';
          }else{
           if(DB::query('SELECT mobile FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))){

if(DB::query('SELECT mobile FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))){
    
		if(password_verify($in_pass, DB::query('SELECT password FROM users WHERE mobile=:mobile',array(':mobile'=>$email_mobile))[0]['password'])){
//			echo'logged in!';
			// token part
			//creating or generate token
				$cstrong = true;
				$token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				//select userid from databse
				$user_id=DB::query('SELECT user_id FROM users WHERE mobile=:mobile', array(':mobile'=>$email_mobile))[0]['user_id'];
				//put token and userid in databse
			DB::query('INSERT INTO token VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
			// set cookies to computer for logged in snid=cookies name, $token = cookie token, time=how much time cookie active for login, 2nd NULL = cause we dont have ssl, if have then use true, true=for crose site scripting.

			//set cookie valid for 7 days
			setcookie('FBID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
			//set cookie valid for 3 days and goto index page for config
			setcookie('FBID', $token, time()+60*60*24*3,'/',NULL, NULL, true);

            header('Location: index.php');
		}
		
		else{
 $error_msg = '<p>ইউজার পাওয়া যায়নি।</p>';
		}

}else{
	$error_msg = '<p style="color: red;
    vertical-align: middle;
    text-align: center;">ইউজার পাওয়া যায়নি।</p>';
}
    }else{
        $errorb = 'Mobile number is not found';
    }
      }
  }else{
      
      
    if(DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email_mobile))){

if(DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email_mobile))){
    
		if(password_verify($in_pass, DB::query('SELECT password FROM users WHERE email=:email',array(':email'=>$email_mobile))[0]['password'])){
//			echo'logged in!';
			// token part
			//creating or generate token
				$cstrong = true;
				$token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				//select userid from databse
				$user_id=DB::query('SELECT user_id FROM users WHERE email=:email', array(':email'=>$email_mobile))[0]['user_id'];
				//put token and userid in databse
			DB::query('INSERT INTO token VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
			// set cookies to computer for logged in snid=cookies name, $token = cookie token, time=how much time cookie active for login, 2nd NULL = cause we dont have ssl, if have then use true, true=for crose site scripting.

			//set cookie valid for 7 days
			setcookie('FBID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
			//set cookie valid for 3 days and goto index page for config
			setcookie('FBID', $token, time()+60*60*24*3,'/',NULL, NULL, true);
		     header('Location: index.php');
            
		}
		
		else{
 $error_msg = '<p>ইউজার পাওয়া যায়নি।</p>';
		}

}else{
	$error_msg = '<p style="color: red;
    vertical-align: middle;
    text-align: center;">ইউজার পাওয়া যায়নি।</p>';
}
    }else{
        $errorb = 'Email is not found';
    }  
  }  
    
    
    
}




?>


<!DOCTYPE html>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>facebook</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="header">
        <div class="logo">facebook</div>
        <form action="sign.php" method="post">
            <div class="sign-in-form">
                <div class="mobile-input">
                    <div class="input-text">Email or Phone</div>
                    <input type="text" name="in_email_mobile" id="email-mobile" class="input-text-field">
                </div>
                <div class="password-input" style="margin-top:20px; margin-right:1rem;">
                    <div style="font-size:12px; padding-bottom:5px;">Password</div>
                    <input type="password" name="in_pass" id="in-password" class="input-text-field">
                    <div class="forgotten-acc">Forgotten account</div>
                </div>
                <div class="login-button">
                    <input type="submit" class="sign-in login" value="Log in">
                    <!--                    <button class="login">Log in</button>-->
                </div>
            </div>
        </form>
    </div>
    <div class="main">
        <div class="left-side" style="display:flex;justify-content:center; align-items:center;">
            <img src="assets/images/facebook%20Signin%20image.png" alt="">
        </div>
        <div class="right-side">
            <h1 style="color:#212121;">Create an account</h1>
            <div style="color:red; font-size:18px;">
                <?php echo $errorb; ?>
            </div>
            <div style="font-size:20px; color:#212121;">It's free and always will be</div>
            <form name="new user" method="post" action="sign.php">
                <div class="sign-up-form">
                    <div class="sign-up-name">
                        <input type="text" name="first-name" id="first-name" class="text-field" placeholder="First Name">
                        <input type="text" name="last-name" id="last-name" class="text-field" placeholder="Last Name">
                    </div>
                    <div class="sign-up-mobile">
                        <input type="text" name="email-mobile" id="up-email" placeholder="Mobile number or email address" class="text-input">
                    </div>
                    <div class="sign-up-password">
                        <input type="password" name="up-password" placeholder="New password" id="up-password" class="text-input">
                    </div>
                    <div class="sign-up-birthday">
                        <div class="form-birthday">
                            <div class="bday">Birthday</div>
                            <div class="form-birthday">
                                <span data-type="selectors"></span>
                                <select name="birth-month" title="Month" class="select-body">
                                <option value="0" selected="1">Month</option> <option value="1" selected="2">Jan</option><option value="2" selected="3">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option>
                            </select>
                                <select name="bith-day" title="Day" class="select-body">
                                <option value="0" selected="1">Day</option><option value="1" selected="2">1</option><option value="2" selected="3">2</option>
                                <option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                            </select>
                                <select name="birth-year" title="Year" class="select-body">
                                <option value="0" selected="1">
                                    Year
                                </option>
                                <option value="2019" selected="2">
                                    2019
                                </option><option value="2018" selected="2">
                                    2018
                                </option><option value="2017" selected="2">
                                    2017
                                </option><option value="2016" selected="2">
                                    2016
                                </option>
                                <option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="gender-wrap"><span data-type="radio" class="spanpad">
                    <input type="radio" name="gen" id="fem" class="m0" value="female">
                    <label for="fem" class="gender">Female</label>
                    <input type="radio" name="gen" value="male" id="male" class="m0">
                    <label for="male" class="gender">Male</label>
                    </span>
                    </div>
                    <div class="term">
                        By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time.
                    </div>
                    <input type="submit" class="sign-up" value="Sign Up">
                    <!--                    <button class="sign-up">Sign Up</button>-->
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            //            $(".sign_up").on('click', )
        })

    </script>
</body>

</html>
