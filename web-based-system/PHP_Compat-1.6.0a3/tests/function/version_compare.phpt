--TEST--
Function -- version_compare
--FILE--
<?php
require_once 'PHP/Compat/Function/version_compare.php';

// Basic
print "testing basic\n";
test('1', '2');
test('10', '2');
test('1.0', '1.1');
test('1.2', '1.0.1');
test('1.2.p3', '1.2.4');
test('1.2.y', '1.2.z');

// Comparisons
print "testing compare\n";
$special_forms = array("-dev", "a1", "b1", "RC1", "", "pl1");
$operators = array(
    "lt", "<",
    "le", "<=",
    "gt", ">",
    "ge", ">=",
    "eq", "=", "==",
    "ne", "<>", "!="
);

foreach ($special_forms as $f1) {
    foreach ($special_forms as $f2) {
	test("1.0$f1", "1.0$f2");
    }
}

// Operators
print "testing operators\n";
foreach ($special_forms as $f1) {
    foreach ($special_forms as $f2) {
        foreach ($operators as $op) {
            $v1 = "1.0$f1";
            $v2 = "1.0$f2";
            $test = php_compat_version_compare($v1, $v2, $op) ? "true" : "false";
            printf("%7s %2s %-7s : %s\n", $v1, $op, $v2, $test);
        }
    }
}

function test($v1, $v2) {
    $compare = php_compat_version_compare($v1, $v2);
    switch ($compare) {
	case -1:
	    print "$v1 < $v2\n";
	    break;
	case 1:
	    print "$v1 > $v2\n";
	    break;
	case 0:
	default:
	    print "$v1 = $v2\n";
	    break;
    }
}

?>
--EXPECT--
testing basic
1 < 2
10 > 2
1.0 < 1.1
1.2 > 1.0.1
1.2.p3 > 1.2.4
1.2.y = 1.2.z
testing compare
1.0-dev = 1.0-dev
1.0-dev < 1.0a1
1.0-dev < 1.0b1
1.0-dev < 1.0RC1
1.0-dev < 1.0
1.0-dev < 1.0pl1
1.0a1 > 1.0-dev
1.0a1 = 1.0a1
1.0a1 < 1.0b1
1.0a1 < 1.0RC1
1.0a1 < 1.0
1.0a1 < 1.0pl1
1.0b1 > 1.0-dev
1.0b1 > 1.0a1
1.0b1 = 1.0b1
1.0b1 < 1.0RC1
1.0b1 < 1.0
1.0b1 < 1.0pl1
1.0RC1 > 1.0-dev
1.0RC1 > 1.0a1
1.0RC1 > 1.0b1
1.0RC1 = 1.0RC1
1.0RC1 < 1.0
1.0RC1 < 1.0pl1
1.0 > 1.0-dev
1.0 > 1.0a1
1.0 > 1.0b1
1.0 > 1.0RC1
1.0 = 1.0
1.0 < 1.0pl1
1.0pl1 > 1.0-dev
1.0pl1 > 1.0a1
1.0pl1 > 1.0b1
1.0pl1 > 1.0RC1
1.0pl1 > 1.0
1.0pl1 = 1.0pl1
testing operators
1.0-dev lt 1.0-dev : false
1.0-dev  < 1.0-dev : false
1.0-dev le 1.0-dev : true
1.0-dev <= 1.0-dev : true
1.0-dev gt 1.0-dev : false
1.0-dev  > 1.0-dev : false
1.0-dev ge 1.0-dev : true
1.0-dev >= 1.0-dev : true
1.0-dev eq 1.0-dev : true
1.0-dev  = 1.0-dev : true
1.0-dev == 1.0-dev : true
1.0-dev ne 1.0-dev : false
1.0-dev <> 1.0-dev : false
1.0-dev != 1.0-dev : false
1.0-dev lt 1.0a1   : true
1.0-dev  < 1.0a1   : true
1.0-dev le 1.0a1   : true
1.0-dev <= 1.0a1   : true
1.0-dev gt 1.0a1   : false
1.0-dev  > 1.0a1   : false
1.0-dev ge 1.0a1   : false
1.0-dev >= 1.0a1   : false
1.0-dev eq 1.0a1   : false
1.0-dev  = 1.0a1   : false
1.0-dev == 1.0a1   : false
1.0-dev ne 1.0a1   : true
1.0-dev <> 1.0a1   : true
1.0-dev != 1.0a1   : true
1.0-dev lt 1.0b1   : true
1.0-dev  < 1.0b1   : true
1.0-dev le 1.0b1   : true
1.0-dev <= 1.0b1   : true
1.0-dev gt 1.0b1   : false
1.0-dev  > 1.0b1   : false
1.0-dev ge 1.0b1   : false
1.0-dev >= 1.0b1   : false
1.0-dev eq 1.0b1   : false
1.0-dev  = 1.0b1   : false
1.0-dev == 1.0b1   : false
1.0-dev ne 1.0b1   : true
1.0-dev <> 1.0b1   : true
1.0-dev != 1.0b1   : true
1.0-dev lt 1.0RC1  : true
1.0-dev  < 1.0RC1  : true
1.0-dev le 1.0RC1  : true
1.0-dev <= 1.0RC1  : true
1.0-dev gt 1.0RC1  : false
1.0-dev  > 1.0RC1  : false
1.0-dev ge 1.0RC1  : false
1.0-dev >= 1.0RC1  : false
1.0-dev eq 1.0RC1  : false
1.0-dev  = 1.0RC1  : false
1.0-dev == 1.0RC1  : false
1.0-dev ne 1.0RC1  : true
1.0-dev <> 1.0RC1  : true
1.0-dev != 1.0RC1  : true
1.0-dev lt 1.0     : true
1.0-dev  < 1.0     : true
1.0-dev le 1.0     : true
1.0-dev <= 1.0     : true
1.0-dev gt 1.0     : false
1.0-dev  > 1.0     : false
1.0-dev ge 1.0     : false
1.0-dev >= 1.0     : false
1.0-dev eq 1.0     : false
1.0-dev  = 1.0     : false
1.0-dev == 1.0     : false
1.0-dev ne 1.0     : true
1.0-dev <> 1.0     : true
1.0-dev != 1.0     : true
1.0-dev lt 1.0pl1  : true
1.0-dev  < 1.0pl1  : true
1.0-dev le 1.0pl1  : true
1.0-dev <= 1.0pl1  : true
1.0-dev gt 1.0pl1  : false
1.0-dev  > 1.0pl1  : false
1.0-dev ge 1.0pl1  : false
1.0-dev >= 1.0pl1  : false
1.0-dev eq 1.0pl1  : false
1.0-dev  = 1.0pl1  : false
1.0-dev == 1.0pl1  : false
1.0-dev ne 1.0pl1  : true
1.0-dev <> 1.0pl1  : true
1.0-dev != 1.0pl1  : true
  1.0a1 lt 1.0-dev : false
  1.0a1  < 1.0-dev : false
  1.0a1 le 1.0-dev : false
  1.0a1 <= 1.0-dev : false
  1.0a1 gt 1.0-dev : true
  1.0a1  > 1.0-dev : true
  1.0a1 ge 1.0-dev : true
  1.0a1 >= 1.0-dev : true
  1.0a1 eq 1.0-dev : false
  1.0a1  = 1.0-dev : false
  1.0a1 == 1.0-dev : false
  1.0a1 ne 1.0-dev : true
  1.0a1 <> 1.0-dev : true
  1.0a1 != 1.0-dev : true
  1.0a1 lt 1.0a1   : false
  1.0a1  < 1.0a1   : false
  1.0a1 le 1.0a1   : true
  1.0a1 <= 1.0a1   : true
  1.0a1 gt 1.0a1   : false
  1.0a1  > 1.0a1   : false
  1.0a1 ge 1.0a1   : true
  1.0a1 >= 1.0a1   : true
  1.0a1 eq 1.0a1   : true
  1.0a1  = 1.0a1   : true
  1.0a1 == 1.0a1   : true
  1.0a1 ne 1.0a1   : false
  1.0a1 <> 1.0a1   : false
  1.0a1 != 1.0a1   : false
  1.0a1 lt 1.0b1   : true
  1.0a1  < 1.0b1   : true
  1.0a1 le 1.0b1   : true
  1.0a1 <= 1.0b1   : true
  1.0a1 gt 1.0b1   : false
  1.0a1  > 1.0b1   : false
  1.0a1 ge 1.0b1   : false
  1.0a1 >= 1.0b1   : false
  1.0a1 eq 1.0b1   : false
  1.0a1  = 1.0b1   : false
  1.0a1 == 1.0b1   : false
  1.0a1 ne 1.0b1   : true
  1.0a1 <> 1.0b1   : true
  1.0a1 != 1.0b1   : true
  1.0a1 lt 1.0RC1  : true
  1.0a1  < 1.0RC1  : true
  1.0a1 le 1.0RC1  : true
  1.0a1 <= 1.0RC1  : true
  1.0a1 gt 1.0RC1  : false
  1.0a1  > 1.0RC1  : false
  1.0a1 ge 1.0RC1  : false
  1.0a1 >= 1.0RC1  : false
  1.0a1 eq 1.0RC1  : false
  1.0a1  = 1.0RC1  : false
  1.0a1 == 1.0RC1  : false
  1.0a1 ne 1.0RC1  : true
  1.0a1 <> 1.0RC1  : true
  1.0a1 != 1.0RC1  : true
  1.0a1 lt 1.0     : true
  1.0a1  < 1.0     : true
  1.0a1 le 1.0     : true
  1.0a1 <= 1.0     : true
  1.0a1 gt 1.0     : false
  1.0a1  > 1.0     : false
  1.0a1 ge 1.0     : false
  1.0a1 >= 1.0     : false
  1.0a1 eq 1.0     : false
  1.0a1  = 1.0     : false
  1.0a1 == 1.0     : false
  1.0a1 ne 1.0     : true
  1.0a1 <> 1.0     : true
  1.0a1 != 1.0     : true
  1.0a1 lt 1.0pl1  : true
  1.0a1  < 1.0pl1  : true
  1.0a1 le 1.0pl1  : true
  1.0a1 <= 1.0pl1  : true
  1.0a1 gt 1.0pl1  : false
  1.0a1  > 1.0pl1  : false
  1.0a1 ge 1.0pl1  : false
  1.0a1 >= 1.0pl1  : false
  1.0a1 eq 1.0pl1  : false
  1.0a1  = 1.0pl1  : false
  1.0a1 == 1.0pl1  : false
  1.0a1 ne 1.0pl1  : true
  1.0a1 <> 1.0pl1  : true
  1.0a1 != 1.0pl1  : true
  1.0b1 lt 1.0-dev : false
  1.0b1  < 1.0-dev : false
  1.0b1 le 1.0-dev : false
  1.0b1 <= 1.0-dev : false
  1.0b1 gt 1.0-dev : true
  1.0b1  > 1.0-dev : true
  1.0b1 ge 1.0-dev : true
  1.0b1 >= 1.0-dev : true
  1.0b1 eq 1.0-dev : false
  1.0b1  = 1.0-dev : false
  1.0b1 == 1.0-dev : false
  1.0b1 ne 1.0-dev : true
  1.0b1 <> 1.0-dev : true
  1.0b1 != 1.0-dev : true
  1.0b1 lt 1.0a1   : false
  1.0b1  < 1.0a1   : false
  1.0b1 le 1.0a1   : false
  1.0b1 <= 1.0a1   : false
  1.0b1 gt 1.0a1   : true
  1.0b1  > 1.0a1   : true
  1.0b1 ge 1.0a1   : true
  1.0b1 >= 1.0a1   : true
  1.0b1 eq 1.0a1   : false
  1.0b1  = 1.0a1   : false
  1.0b1 == 1.0a1   : false
  1.0b1 ne 1.0a1   : true
  1.0b1 <> 1.0a1   : true
  1.0b1 != 1.0a1   : true
  1.0b1 lt 1.0b1   : false
  1.0b1  < 1.0b1   : false
  1.0b1 le 1.0b1   : true
  1.0b1 <= 1.0b1   : true
  1.0b1 gt 1.0b1   : false
  1.0b1  > 1.0b1   : false
  1.0b1 ge 1.0b1   : true
  1.0b1 >= 1.0b1   : true
  1.0b1 eq 1.0b1   : true
  1.0b1  = 1.0b1   : true
  1.0b1 == 1.0b1   : true
  1.0b1 ne 1.0b1   : false
  1.0b1 <> 1.0b1   : false
  1.0b1 != 1.0b1   : false
  1.0b1 lt 1.0RC1  : true
  1.0b1  < 1.0RC1  : true
  1.0b1 le 1.0RC1  : true
  1.0b1 <= 1.0RC1  : true
  1.0b1 gt 1.0RC1  : false
  1.0b1  > 1.0RC1  : false
  1.0b1 ge 1.0RC1  : false
  1.0b1 >= 1.0RC1  : false
  1.0b1 eq 1.0RC1  : false
  1.0b1  = 1.0RC1  : false
  1.0b1 == 1.0RC1  : false
  1.0b1 ne 1.0RC1  : true
  1.0b1 <> 1.0RC1  : true
  1.0b1 != 1.0RC1  : true
  1.0b1 lt 1.0     : true
  1.0b1  < 1.0     : true
  1.0b1 le 1.0     : true
  1.0b1 <= 1.0     : true
  1.0b1 gt 1.0     : false
  1.0b1  > 1.0     : false
  1.0b1 ge 1.0     : false
  1.0b1 >= 1.0     : false
  1.0b1 eq 1.0     : false
  1.0b1  = 1.0     : false
  1.0b1 == 1.0     : false
  1.0b1 ne 1.0     : true
  1.0b1 <> 1.0     : true
  1.0b1 != 1.0     : true
  1.0b1 lt 1.0pl1  : true
  1.0b1  < 1.0pl1  : true
  1.0b1 le 1.0pl1  : true
  1.0b1 <= 1.0pl1  : true
  1.0b1 gt 1.0pl1  : false
  1.0b1  > 1.0pl1  : false
  1.0b1 ge 1.0pl1  : false
  1.0b1 >= 1.0pl1  : false
  1.0b1 eq 1.0pl1  : false
  1.0b1  = 1.0pl1  : false
  1.0b1 == 1.0pl1  : false
  1.0b1 ne 1.0pl1  : true
  1.0b1 <> 1.0pl1  : true
  1.0b1 != 1.0pl1  : true
 1.0RC1 lt 1.0-dev : false
 1.0RC1  < 1.0-dev : false
 1.0RC1 le 1.0-dev : false
 1.0RC1 <= 1.0-dev : false
 1.0RC1 gt 1.0-dev : true
 1.0RC1  > 1.0-dev : true
 1.0RC1 ge 1.0-dev : true
 1.0RC1 >= 1.0-dev : true
 1.0RC1 eq 1.0-dev : false
 1.0RC1  = 1.0-dev : false
 1.0RC1 == 1.0-dev : false
 1.0RC1 ne 1.0-dev : true
 1.0RC1 <> 1.0-dev : true
 1.0RC1 != 1.0-dev : true
 1.0RC1 lt 1.0a1   : false
 1.0RC1  < 1.0a1   : false
 1.0RC1 le 1.0a1   : false
 1.0RC1 <= 1.0a1   : false
 1.0RC1 gt 1.0a1   : true
 1.0RC1  > 1.0a1   : true
 1.0RC1 ge 1.0a1   : true
 1.0RC1 >= 1.0a1   : true
 1.0RC1 eq 1.0a1   : false
 1.0RC1  = 1.0a1   : false
 1.0RC1 == 1.0a1   : false
 1.0RC1 ne 1.0a1   : true
 1.0RC1 <> 1.0a1   : true
 1.0RC1 != 1.0a1   : true
 1.0RC1 lt 1.0b1   : false
 1.0RC1  < 1.0b1   : false
 1.0RC1 le 1.0b1   : false
 1.0RC1 <= 1.0b1   : false
 1.0RC1 gt 1.0b1   : true
 1.0RC1  > 1.0b1   : true
 1.0RC1 ge 1.0b1   : true
 1.0RC1 >= 1.0b1   : true
 1.0RC1 eq 1.0b1   : false
 1.0RC1  = 1.0b1   : false
 1.0RC1 == 1.0b1   : false
 1.0RC1 ne 1.0b1   : true
 1.0RC1 <> 1.0b1   : true
 1.0RC1 != 1.0b1   : true
 1.0RC1 lt 1.0RC1  : false
 1.0RC1  < 1.0RC1  : false
 1.0RC1 le 1.0RC1  : true
 1.0RC1 <= 1.0RC1  : true
 1.0RC1 gt 1.0RC1  : false
 1.0RC1  > 1.0RC1  : false
 1.0RC1 ge 1.0RC1  : true
 1.0RC1 >= 1.0RC1  : true
 1.0RC1 eq 1.0RC1  : true
 1.0RC1  = 1.0RC1  : true
 1.0RC1 == 1.0RC1  : true
 1.0RC1 ne 1.0RC1  : false
 1.0RC1 <> 1.0RC1  : false
 1.0RC1 != 1.0RC1  : false
 1.0RC1 lt 1.0     : true
 1.0RC1  < 1.0     : true
 1.0RC1 le 1.0     : true
 1.0RC1 <= 1.0     : true
 1.0RC1 gt 1.0     : false
 1.0RC1  > 1.0     : false
 1.0RC1 ge 1.0     : false
 1.0RC1 >= 1.0     : false
 1.0RC1 eq 1.0     : false
 1.0RC1  = 1.0     : false
 1.0RC1 == 1.0     : false
 1.0RC1 ne 1.0     : true
 1.0RC1 <> 1.0     : true
 1.0RC1 != 1.0     : true
 1.0RC1 lt 1.0pl1  : true
 1.0RC1  < 1.0pl1  : true
 1.0RC1 le 1.0pl1  : true
 1.0RC1 <= 1.0pl1  : true
 1.0RC1 gt 1.0pl1  : false
 1.0RC1  > 1.0pl1  : false
 1.0RC1 ge 1.0pl1  : false
 1.0RC1 >= 1.0pl1  : false
 1.0RC1 eq 1.0pl1  : false
 1.0RC1  = 1.0pl1  : false
 1.0RC1 == 1.0pl1  : false
 1.0RC1 ne 1.0pl1  : true
 1.0RC1 <> 1.0pl1  : true
 1.0RC1 != 1.0pl1  : true
    1.0 lt 1.0-dev : false
    1.0  < 1.0-dev : false
    1.0 le 1.0-dev : false
    1.0 <= 1.0-dev : false
    1.0 gt 1.0-dev : true
    1.0  > 1.0-dev : true
    1.0 ge 1.0-dev : true
    1.0 >= 1.0-dev : true
    1.0 eq 1.0-dev : false
    1.0  = 1.0-dev : false
    1.0 == 1.0-dev : false
    1.0 ne 1.0-dev : true
    1.0 <> 1.0-dev : true
    1.0 != 1.0-dev : true
    1.0 lt 1.0a1   : false
    1.0  < 1.0a1   : false
    1.0 le 1.0a1   : false
    1.0 <= 1.0a1   : false
    1.0 gt 1.0a1   : true
    1.0  > 1.0a1   : true
    1.0 ge 1.0a1   : true
    1.0 >= 1.0a1   : true
    1.0 eq 1.0a1   : false
    1.0  = 1.0a1   : false
    1.0 == 1.0a1   : false
    1.0 ne 1.0a1   : true
    1.0 <> 1.0a1   : true
    1.0 != 1.0a1   : true
    1.0 lt 1.0b1   : false
    1.0  < 1.0b1   : false
    1.0 le 1.0b1   : false
    1.0 <= 1.0b1   : false
    1.0 gt 1.0b1   : true
    1.0  > 1.0b1   : true
    1.0 ge 1.0b1   : true
    1.0 >= 1.0b1   : true
    1.0 eq 1.0b1   : false
    1.0  = 1.0b1   : false
    1.0 == 1.0b1   : false
    1.0 ne 1.0b1   : true
    1.0 <> 1.0b1   : true
    1.0 != 1.0b1   : true
    1.0 lt 1.0RC1  : false
    1.0  < 1.0RC1  : false
    1.0 le 1.0RC1  : false
    1.0 <= 1.0RC1  : false
    1.0 gt 1.0RC1  : true
    1.0  > 1.0RC1  : true
    1.0 ge 1.0RC1  : true
    1.0 >= 1.0RC1  : true
    1.0 eq 1.0RC1  : false
    1.0  = 1.0RC1  : false
    1.0 == 1.0RC1  : false
    1.0 ne 1.0RC1  : true
    1.0 <> 1.0RC1  : true
    1.0 != 1.0RC1  : true
    1.0 lt 1.0     : false
    1.0  < 1.0     : false
    1.0 le 1.0     : true
    1.0 <= 1.0     : true
    1.0 gt 1.0     : false
    1.0  > 1.0     : false
    1.0 ge 1.0     : true
    1.0 >= 1.0     : true
    1.0 eq 1.0     : true
    1.0  = 1.0     : true
    1.0 == 1.0     : true
    1.0 ne 1.0     : false
    1.0 <> 1.0     : false
    1.0 != 1.0     : false
    1.0 lt 1.0pl1  : true
    1.0  < 1.0pl1  : true
    1.0 le 1.0pl1  : true
    1.0 <= 1.0pl1  : true
    1.0 gt 1.0pl1  : false
    1.0  > 1.0pl1  : false
    1.0 ge 1.0pl1  : false
    1.0 >= 1.0pl1  : false
    1.0 eq 1.0pl1  : false
    1.0  = 1.0pl1  : false
    1.0 == 1.0pl1  : false
    1.0 ne 1.0pl1  : true
    1.0 <> 1.0pl1  : true
    1.0 != 1.0pl1  : true
 1.0pl1 lt 1.0-dev : false
 1.0pl1  < 1.0-dev : false
 1.0pl1 le 1.0-dev : false
 1.0pl1 <= 1.0-dev : false
 1.0pl1 gt 1.0-dev : true
 1.0pl1  > 1.0-dev : true
 1.0pl1 ge 1.0-dev : true
 1.0pl1 >= 1.0-dev : true
 1.0pl1 eq 1.0-dev : false
 1.0pl1  = 1.0-dev : false
 1.0pl1 == 1.0-dev : false
 1.0pl1 ne 1.0-dev : true
 1.0pl1 <> 1.0-dev : true
 1.0pl1 != 1.0-dev : true
 1.0pl1 lt 1.0a1   : false
 1.0pl1  < 1.0a1   : false
 1.0pl1 le 1.0a1   : false
 1.0pl1 <= 1.0a1   : false
 1.0pl1 gt 1.0a1   : true
 1.0pl1  > 1.0a1   : true
 1.0pl1 ge 1.0a1   : true
 1.0pl1 >= 1.0a1   : true
 1.0pl1 eq 1.0a1   : false
 1.0pl1  = 1.0a1   : false
 1.0pl1 == 1.0a1   : false
 1.0pl1 ne 1.0a1   : true
 1.0pl1 <> 1.0a1   : true
 1.0pl1 != 1.0a1   : true
 1.0pl1 lt 1.0b1   : false
 1.0pl1  < 1.0b1   : false
 1.0pl1 le 1.0b1   : false
 1.0pl1 <= 1.0b1   : false
 1.0pl1 gt 1.0b1   : true
 1.0pl1  > 1.0b1   : true
 1.0pl1 ge 1.0b1   : true
 1.0pl1 >= 1.0b1   : true
 1.0pl1 eq 1.0b1   : false
 1.0pl1  = 1.0b1   : false
 1.0pl1 == 1.0b1   : false
 1.0pl1 ne 1.0b1   : true
 1.0pl1 <> 1.0b1   : true
 1.0pl1 != 1.0b1   : true
 1.0pl1 lt 1.0RC1  : false
 1.0pl1  < 1.0RC1  : false
 1.0pl1 le 1.0RC1  : false
 1.0pl1 <= 1.0RC1  : false
 1.0pl1 gt 1.0RC1  : true
 1.0pl1  > 1.0RC1  : true
 1.0pl1 ge 1.0RC1  : true
 1.0pl1 >= 1.0RC1  : true
 1.0pl1 eq 1.0RC1  : false
 1.0pl1  = 1.0RC1  : false
 1.0pl1 == 1.0RC1  : false
 1.0pl1 ne 1.0RC1  : true
 1.0pl1 <> 1.0RC1  : true
 1.0pl1 != 1.0RC1  : true
 1.0pl1 lt 1.0     : false
 1.0pl1  < 1.0     : false
 1.0pl1 le 1.0     : false
 1.0pl1 <= 1.0     : false
 1.0pl1 gt 1.0     : true
 1.0pl1  > 1.0     : true
 1.0pl1 ge 1.0     : true
 1.0pl1 >= 1.0     : true
 1.0pl1 eq 1.0     : false
 1.0pl1  = 1.0     : false
 1.0pl1 == 1.0     : false
 1.0pl1 ne 1.0     : true
 1.0pl1 <> 1.0     : true
 1.0pl1 != 1.0     : true
 1.0pl1 lt 1.0pl1  : false
 1.0pl1  < 1.0pl1  : false
 1.0pl1 le 1.0pl1  : true
 1.0pl1 <= 1.0pl1  : true
 1.0pl1 gt 1.0pl1  : false
 1.0pl1  > 1.0pl1  : false
 1.0pl1 ge 1.0pl1  : true
 1.0pl1 >= 1.0pl1  : true
 1.0pl1 eq 1.0pl1  : true
 1.0pl1  = 1.0pl1  : true
 1.0pl1 == 1.0pl1  : true
 1.0pl1 ne 1.0pl1  : false
 1.0pl1 <> 1.0pl1  : false
 1.0pl1 != 1.0pl1  : false