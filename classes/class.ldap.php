<?php
class ldap {
	static function verifierLoginPassword($username, $password, $tConnexionLDAP) {
		$adServer = $tConnexionLDAP["host"];
		$domain = $tConnexionLDAP["domain"];
		$ldap = ldap_connect($adServer);
		$ldaprdn = $domain . "\\" . $username;
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
		return @ldap_bind($ldap, $ldaprdn, $password);
	}
}
?>