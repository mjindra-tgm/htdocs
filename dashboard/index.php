<?php
/**
 * Created by Joe of ExchangeCore.com
 */

# Die Session muss immer zuerst gestartet werden, bevor 
# eine Ausgabe an den Browser erfolgt !!! 
SESSION_START(); 

$bind=false;
if(isset($_POST['username']) && isset($_POST['password'])){
	$_SESSION["username"] =  $_POST['username'];
	$_SESSION["password"] =  $_POST['password'];
    $adServer = "ldap://dc-01.tgm.ac.at:389";
	
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = '$username'+'@tgm.ac.at';
	
	$_SESSION["ldap"] =  $ldap;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $_SESSION["bind"] = @ldap_bind($ldap, $username, $password);

	
    if ($_SESSION["bind"]) {
		header ( 'Location:all.php' );
        // $filter="(sAMAccountName=$username)";
        // $result = ldap_search($ldap,"dc=tgm,dc=ac,dc=at",$filter);
        // $info = ldap_get_entries($ldap, $result);
        // for ($i=0; $i<$info["count"]; $i++)
        // {
            // if($info['count'] > 1)
                // break;
            // echo "<p>You are accessing <strong> " . $info[$i]["givenname"][0] ."</strong><br /> </p>\n";
        // }
        // @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
	}
}
?>
    <form action="#" method="POST">
        <label for="username">Username: </label><input id="username" type="text" name="username" /> 
        <label for="password">Password: </label><input id="password" type="password" name="password" />        
		<input type="submit" name="submit" value="Submit" />
    </form>
<?php ?> 