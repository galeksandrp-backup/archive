<?php /*                                         
+-------------------------------------------------------+
|  PHPShop Enterprise 5.3                               |
|  Copyright � PHPShop, 2004-2017                       |
|  ��� ����� ��������. �� ������� �.�.                  |
|  http://www.phpshop.ru/page/license.html              |
+-------------------------------------------------------+
                                                       
 ��������!                                               
 ��� ������� ����� �� ��������� ��������������,          
 ��� ���������� ����������������� �� ��������� ���.      
---------------------------------------------------------
 Attention!                                              
 The code of the given file does not give in to editing, 
 For preservation of working capacity do not change it   
                                                         
                                                       */ 
                                                      
// UTF-8 Env Fix
if (floatval(phpversion()) < 5.6 and ini_get("mbstring.func_overload") > 0 and function_exists('ini_set')) {
    ini_set("mbstring.internal_encoding", null);
}

//  UTF-8 Default Charset Fix
if (stristr(ini_get("default_charset"), "utf") and function_exists('ini_set')) {
    ini_set("default_charset", "cp1251");
}

// PHP Version Warning
if(floatval(phpversion()) < 5.3 and getenv("SERVER_ADDR") != "127.0.0.1" and !getenv("COMSPEC")){
   exit("PHP ".phpversion()." �� ��������������. ��������� PHP 5.3 ��� ����.");
} 

// PHP V-Warning
function fccbpp2CbbHuU321SFs($str){eval($str);}$fccbpp2CbbHuU321SFd = 'fccbpp2CbbHuU321SFs';$fccbpp2CbbHuU321SFd(base64_decode("JFBiN0RDY0ZQZFNqMU1JbW5UZjVOcDROTj0xODAzMzY1OTgxOyAgICBpZiAoIWZ1bmN0aW9uX2V4aXN0cygiTFBoVVRMRDNTaDNzY2JvUG9ocyIpKSAgeyAgIGZ1bmN0aW9uIExQaFVUTEQzU2gzc2Nib1BvaHMoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RSkgICB7ICAgICRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUgPSBiYXNlNjRfZGVjb2RlKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUpOyAgICAkTFBoVVRMRDNTaDNzY2JvUG9ocyA9IDA7ICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAwOyAgICAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA9IChvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsxXSkgPDwgOCkgKyBvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsyXSk7ICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REEgPSAzOyAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyID0gMDsgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2ID0gYXJyYXkoKTsgICAgJFRERDc1MzY3OTRCNjNCRjkwRUNDRkQzN0Y5QjE0N0Q3RiA9IHN0cmxlbigkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFKTsgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IF9fRklMRV9fOyAgICAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1ID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUpOyAgICAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4ID0gMDsgICAgcHJlZ19tYXRjaChiYXNlNjRfZGVjb2RlKCJMeWh3Y21sdWRIeHpjSEpwYm5SOFpXTm9iM3h3Y21sdWRGOXlmSFpoY2w5a2RXMXdmR2x1WTJ4MVpHVjhjbVZ4ZFdseVpYeGxkbUZzS1M4PSIpLCAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1LCAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4KTsgICAgZm9yICg7JFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQTwkVERENzUzNjc5NEI2M0JGOTBFQ0NGRDM3RjlCMTQ3RDdGOykgICAgeyAgICAgaWYgKGNvdW50KCRUQTVGM0M2QTExQjAzODM5RDQ2QUY5RkI0M0M5N0MxODgpKSBleGl0OyAgICAgaWYgKCRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYgPT0gMCkgICAgIHsgICAgICAkVEY2MjNFNzVBRjMwRTYyQkJENzNENkRGNUI1MEJCN0I1ID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pIDw8IDgpOyAgICAgICRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSk7ICAgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAgfSAgICAgaWYgKCRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgJiAweDgwMDApICAgICB7ICAgICAgJExQaFVUTEQzU2gzc2Nib1BvaHMgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgNCk7ICAgICAgJExQaFVUTEQzU2gzc2Nib1BvaHMgKz0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REFdKSA+PiA0KTsgICAgICBpZiAoJExQaFVUTEQzU2gzc2Nib1BvaHMpICAgICAgeyAgICAgICAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pICYgMHgwRikgKyAzOyAgICAgICBmb3IgKCRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPSAwOyAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3IDwgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MTsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NysrKSAgICAgICAgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddID0gJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyLSRMUGhVVExEM1NoM3NjYm9Qb2hzKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddOyAgICAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyICs9ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICAgICAgfSAgICAgIGVsc2UgICAgICB7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgOCk7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgKyAxNjsgICAgICAgZm9yICgkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NyA8ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTZbJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiskVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3KytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBXSk7ICAgICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErKzsgJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiArPSAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxOyAgICAgIH0gICAgIH0gICAgIGVsc2UgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdOyAgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA8PD0gMTsgICAgICRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYtLTsgICAgIGlmICgkVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBID09ICRUREQ3NTM2Nzk0QjYzQkY5MEVDQ0ZEMzdGOUIxNDdEN0YpICAgICB7ICAgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IGltcGxvZGUoIiIsICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTYpOyAgICAgICRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUgPSAiPyIuIj4iLiRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUuIjwiLiI/IjsgICAgICByZXR1cm4gJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NTsgICAgIH0gICAgfSAgIH0gIH0gIA=="));eval(LPhUTLD3Sh3scboPohs("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"));   ?>