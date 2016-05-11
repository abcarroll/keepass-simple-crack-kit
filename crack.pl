#!/usr/bin/perl

#
# A.B. Carroll <ben@hl9.net>
# See: https://github.com/abcarroll/keepass-crack-kit
#

use File::KeePass;

my $file = "my-passwords.kdbx";
my $passwordFile = "password.txt";

my $master_pass;
open( my $fh, '<', $passwordFile ) or die "cannot open file $passwordFile"; {
    local $/;
    $master_pass = <$fh>;
}

close( $fh );

my $k = File::KeePass->new;

# read a version 1 or version 2 database
$k->load_db( $file, $master_pass );
$k->unlock;

print "WORKED: ".$k->header->{'generator'};