<?php
/**
 * A.B. Carroll <ben@hl9.net>
 * See: https://github.com/abcarroll/keepass-crack-kit
 */

$partOne = [
    // your password chunks
    'foo',
    'test'
];

$partTwo = [
    // your password chunks
    '',
    '-ing'
];

// Could also do ex. -- or a million other syntax's and ways.
for($x = 'a'; $x < 'z'; $x++) {
    $partTwo[] = $x;
}

$partThree = [
    // Hmm, did we use a !, !!, @, or @@?
    '',
    '!',
    '!!',
    '@',
    '@@'
];

// This isn't even pretty.
foreach($partOne as $p1) {
    foreach($partTwo as $p2) {
        foreach($partThree as $p3) {
            echo "$p1$p2$p3\n";
        }
    }
}

// Remember you may need to uniq your data once you're done, i.e.
// cat dict.txt | sort -u > dict-sorted.txt && mv dict-sorted.txt dict.txt