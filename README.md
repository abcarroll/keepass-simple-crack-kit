# keepass-crack-kit
A cobble of Perl and PHP scripts to SLOWLY brute force KeePass 1.x and 2.x databases

**If you are planning on running over 10,000 - 50,000 passwords, this will not suit your needs without substantial modification, if at all.**

keepass-crack-kit is a simple example that I used to crack my own KeePass database generated from the TAILS KeePassX.  I already *approximately* knew my 
password and only had to run through a few thousand keys.  If this sounds like your scenario, read on.  If you are unable to hand-modify perl and PHP scripts,
you will need to find something else.  If you can, read on.

### Setting up

There is no `dict.txt` or `password.txt` distributed with this repository, these files are absolutely required.  There is little to no error handling within
these scripts, so you will need to figure out any error situations on your own.  

    git clone https://github.com/abcarroll/keepass-crack-kit.git
    chmod -R 000 keepass-crack-kit; 
    chmod -R u+rwX keepass-crack-kit;
    cd keepass-crack kit;
    touch dict.txt;
    touch password.txt;
    
You may also need libfile-keepass-perl (provides `File::KeePass`).  It should be available in Debian 7, 8 and Ubuntu 10.04:

    sudo apt-get install libfile-keepass-perl
    
You're almost ready.  You'll need a dictionary, `dict.txt`.  I provided the actual script I used, `generate-dict.php` just as a short example.  Once you have
it generated, you will need to edit `crack.pl` which is the actual script to do the cracking.  You should provide the location of your `.kdbx` file there as
the string `$passwordFile`.

Moving on, just run `crack-loop.php` under a PHP 5.6+ interpreter and it will use `crack.pl` and `dict.txt` to try all possible keys until the output of 
 `crack.pl` looks correct.   If this happens, it will exit, and `password.txt` will contain your correct password.
 
### Short overview

`crack-loop.php` reads `dict.txt` line-by-line , writes the line to `password.txt` and then `shell_exec()`'s `crack.pl`.  It checks the output and either
moves on, or stops if it thinks it gets the password correct .

`crack.pl` reads `password.txt` and runs it against the `File::KeyPass` module, and outputs text accordingly.

`generate-dict.php` is a short stub of a script to give you a general idea of how one might generate a personalized dictionary.

It could be greatly improved by moving the PHP code into perl, however I was in a great rush and it's been nearly a decade since I did any sort of 
serious perl development.  The script worked for me, and I do apologize it isn't better optimized, or cleaner.   I am releasing it in hopes that it might
help someone save the nearly 3 hours it took for me figure out `File::KeePass` is basically the only way to read a KeePass 2.x database in an automated way
(on Linux), to my knowledge.

### Far more sophisticated, related projects and links:

 - https://raw.githubusercontent.com/qprotex/Keepass-Self-Bruteforce/master/KeePass-SB.py - Python tool that will run a windows .exe against dict (probably
   faster, but requires windows)
 - https://github.com/brettviren/python-keepass/ - Reads KeePass 3.x databases (only)
 - https://github.com/brettviren/python-keepass/issues/5 - Discussion regarding KeePass Database files
 - http://perltricks.com/article/79/2014/3/24/Secure-your-passwords-with-KeePass-and-Perl/
 - **http://kpcli.sourceforge.net/** - Where I got the idea to use `File::KeePass`, a very nice full featured cli tool
 
### License

keepass-crack-kit was thrown together by A.B. Carroll <ben@hl9.net>.  It is released under public domain, or the MIT license, whichever you prefer and is 
legally applicable.