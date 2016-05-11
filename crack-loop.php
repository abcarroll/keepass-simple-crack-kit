<?php
/**
 * A.B. Carroll <ben@hl9.net>
 * See: https://github.com/abcarroll/keepass-crack-kit
 */

// Which dictionary file to use:
$fp = fopen('dict.txt', 'r');

$attemptCount = 0;
while(!feof($fp)) {
    // be careful with the trim(), if your password contains trailing spaces, this will screw you up.
    $l = trim(fgets($fp));
    if(empty($l)) {
        continue;
    }
    
    // crack.pl will read password.txt for the file.  argv was not used as to not to worry with escaping.
    file_put_contents('password.txt', $l);
    
    // runs under a shell and redirects stderr to stdout.
    $result = shell_exec("./crack.pl 2>&1");
    
    // check output
    if(strpos($result, 'The database key appears invalid') === false) {
        echo "Attempt " . (++$attemptCount) . " succeeded!  Today was a good day.\n";
        echo "Check password.txt for the result.\n";
        exit;
    } else {
        echo "Attempt " . (++$attemptCount) . " failed.\n";
    }
}

echo "Done with dictionary with no success: $attemptCount attempts\n\n";