--TEST--
Bug #74022 PHP Fast CGI crashes when reading from a pfx file with valid password, multiple extra certs
--SKIPIF--
<?php
if (!extension_loaded("openssl")) die("skip");
?>
--FILE--
<?php
function test($p12_contents, $password) {
	openssl_pkcs12_read($p12_contents, $cert_data, $password);
	openssl_error_string();
	var_dump(count($cert_data['extracerts']));
}

$p12_base64 = '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';

$p12 = base64_decode($p12_base64);

test($p12, 'qwerty');
?>
===DONE===
--EXPECT--
int(2)
===DONE===
